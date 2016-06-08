<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'Shift'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelVars.php');
class <xsl:value-of select="@id"/>_Controller extends <xsl:value-of select="@parentId"/>{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}
	
	public function get_open_shift(){
		$ar = $this->getDbLink()->query_first(
			"SELECT date8_descr(date) AS date,
			get_shift_descr(date) AS shift_descr
			FROM shifts ORDER BY date DESC LIMIT 1");
		$date = ($ar)? $ar['date']:'';
		$shift_descr = ($ar)? $ar['shift_descr']:'';
		$this->addModel(new ModelVars(
			array('id'=>'Shift',
				'values'=>array(
					new Field('date',DT_STRING,
						array('value'=>$date)),
					new Field('shift_descr',DT_STRING,
						array('value'=>$shift_descr)),						
				)
			)
		));		
	}
	
	public function close_shift(){
		$pm = $this->getPublicMethod("close_shift");
		$date_db = null;
		FieldSQLDate::formatForDb($pm->getParamValue('date'),$date_db);
		
		$this->getDbLinkMaster()->query(sprintf(
			"UPDATE shifts
			SET closed=true
			WHERE date=%s",$date_db));
	}
	
}
<![CDATA[?>]]>
</xsl:template>

</xsl:stylesheet>