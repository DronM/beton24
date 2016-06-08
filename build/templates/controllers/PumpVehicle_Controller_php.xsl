<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'PumpVehicle'"/>
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

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function get_price($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->add('pump_id',DT_INT,$pm->getParamValue('pump_id'));
		$p->add('quant',DT_FLOAT,$pm->getParamValue('quant'));
		
		$quant = $p->getParamById('quant');
		$pump_id = $p->getParamById('pump_id');
		
		/*поиск подходящей схемы для насоса
		и актуального тарифа от количества
		*/
		$this->addNewModel(sprintf(
		"SELECT
			CASE
				WHEN COALESCE(pprv.price_fixed)>0 THEN
					COALESCE(pprv.price_fixed)
				ELSE ROUND(COALESCE(pprv.price_m)*%f,2)
			END AS price
		FROM pump_prices_values pprv
		WHERE pprv.pump_price_id=(
			SELECT
				pv.pump_price_id
			FROM pump_vehicles AS pv
			WHERE pv.id=%d
			)
			AND (%f &gt; pprv.quant_from
				AND %f &lt;= pprv.quant_to)
		LIMIT 1",
		$quant,$pump_id,$quant,$quant
		),'get_price');
	}
</xsl:template>

</xsl:stylesheet>