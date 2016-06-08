<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'Destination'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>
require_once('common/geo/yandex.php');
require_once(FRAME_WORK_PATH.'basic_classes/CondParamsSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}

	public function get_coords_on_name(){
		$pm = $this->getPublicMethod("get_coords_on_name");
		$addr = array();
		$inf = array();
		$addr['city'] = 'область+Тюменская,город+Тюмень,'.$pm->getParamValue('name');
		get_inf_on_address($addr,$inf);
		$model = new Model(array('id'=>'Coords_Model'));
		$model->addField(new Field('lon_lower',DT_STRING));
		$model->addField(new Field('lon_upper',DT_STRING));
		$model->addField(new Field('lat_lower',DT_STRING));
		$model->addField(new Field('lat_upper',DT_STRING));
		$model->insert();
		$model->lon_lower = $inf['lon_lower'];
		$model->lon_upper = $inf['lon_upper'];
		$model->lat_lower = $inf['lat_lower'];
		$model->lat_upper = $inf['lat_upper'];
		$this->addModel($model);
	}
	
	public function at_dest_avg_time($pm){
		$cond = new CondParamsSQL($pm,$this->getDbLink());
		$this->addNewModel(sprintf('SELECT * FROM at_dest_avg_time(%s,%s)',
		$cond->getValForDb('date_time','ge',DT_DATETIME),
		$cond->getValForDb('date_time','le',DT_DATETIME)),
		'at_dest_avg_time');
	}
	public function route_to_dest_avg_time($pm){
		$cond = new CondParamsSQL($pm,$this->getDbLink());
		$this->addNewModel(sprintf('SELECT * FROM route_to_dest_avg_time(%s,%s)',
		$cond->getValForDb('date_time','ge',DT_DATETIME),
		$cond->getValForDb('date_time','le',DT_DATETIME)),
		'route_to_dest_avg_time');
	}
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function find_by_coords($pm){
		$link = $this->getDbLink();
		$p = new ParamsSQL($pm,$link);
		$p->addAll();
		
		$this->addNewModel(sprintf(
		"SELECT
			dest.id,
			dest.name,
			dest.distance,
			dest.time_route,
			dest.price,
			replace(replace(st_astext(dest.zone),'POLYGON(('::text, ''::text), '))'::text, ''::text) AS zone_str,
			replace(replace(st_astext(st_centroid(dest.zone)), 'POINT('::text, ''::text), ')'::text, ''::text) AS zone_center_str
		FROM destinations AS dest
		WHERE St_Contains(dest.zone,ST_GeomFromText('POINT(%f %f)'))",
		$p->getDbVal('lon'),$p->getDbVal('lat')
		));		
	}
</xsl:template>

</xsl:stylesheet>