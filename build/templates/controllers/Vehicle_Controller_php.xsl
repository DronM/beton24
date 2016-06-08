<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'Vehicle'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');
require_once('common/SMSService.php');
class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}
	
	public function complete_owners($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->setValidated('owner',DT_STRING);
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_owner_list_view
			WHERE lower(owner) LIKE %s||'%%'",
			$params->getArray()),
			'VehicleOwnerList_Model'
		);
	}
	public function complete_features($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->setValidated('feature',DT_STRING);
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_feature_list_view
			WHERE lower(feature) LIKE %s||'%%'",
			$params->getArray()),
			'VehicleFeatureList_Model'
		);	
	}
	public function complete_makes($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->setValidated('make',DT_STRING);
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_make_list_view
			WHERE lower(make) LIKE %s||'%%'",
			$params->getArray()),
			'VehicleMakeList_Model'
		);	
	}
	public function get_track($pm){
		$link = $this->getDbLink();
		$params = new ParamsSQL($pm,$link);
		$params->setValidated('id',DT_INT);
		$params->setValidated('dt_from',DT_DATETIME);
		$params->setValidated('dt_to',DT_DATETIME);
		$params->setValidated('stop_dur',DT_TIME);
		$this->addNewModel(
		vsprintf(
		"SELECT
			(SELECT
				replace(replace(st_astext(zone), 'POLYGON(('::text, ''::text), '))'::text, ''::text) AS coords
				FROM destinations
				WHERE id=constant_base_geo_zone_id()
			) AS base,
			NULL AS dest
		UNION ALL
		SELECT
			NULL AS base,
			replace(replace(st_astext(zone), 'POLYGON(('::text, ''::text), '))'::text, ''::text) AS dest
			FROM vehicle_schedule_states AS st
			LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
			LEFT JOIN vehicles AS v ON v.id=vs.vehicle_id
			LEFT JOIN destinations AS dest ON dest.id=st.destination_id
			WHERE v.id=%d
			AND st.date_time BETWEEN %s AND %s
			AND st.state='busy'::vehicle_states
		",
		$params->getArray()),
		'zones'
		);
		//track
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_track_with_stops(%d,%s,%s,%s)",
			$params->getArray()),
			'track_data'
		);				
	}
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function get_gps_all($pm){
		//zones
		$this->addNewModel(
		"SELECT * FROM destination_base_list",
		'ZoneList_Model');
		
		//position
		$this->addNewModel(
			"SELECT * FROM vehicle_current_pos_all",
			'GPSDataAll_Model'
		);		
	}
	public function get_gps_at_work($pm){
		//zones
		$this->addNewModel(
		"SELECT * FROM destination_at_work_list(now()::date)",
		'ZoneList_Model');
		
		//position
		$this->addNewModel(
			"SELECT * FROM vehicle_at_work_list(now()::date)",
			'GPSData_Model'
		);		
	}
	
</xsl:template>

</xsl:stylesheet>