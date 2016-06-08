<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'SpecialistRequest'"/>
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
require_once("common/SMSService.php");

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function set_viewed($pm){
		$par = new ParamsSQL($pm,$this->getDbLink());
		$par->add('doc_id',DT_INT,$pm->getParamValue('doc_id'));
		$this->getDbLinkMaster()->query(sprintf(
		"UPDATE specialist_requests
		SET viewed=TRUE
		WHERE id=%d",
		$par->getParamById('doc_id')
		));	
	}
	public function update($pm){
		$pm->setParamValue('viewed','true');
		parent::update($pm);
	}
	public function insert($pm){
		$pm->setParamValue('viewed','true');
		parent::insert($pm);
		
		$par = new ParamsSQL($pm,$this->getDbLink());
		$par->addAll();
		
		//sms ответственному
		$ph_ar = explode(',',PHONES_FOR_NEW_PUMP_ORDER);
		$sms = new SMSService(SMS_LOGIN,SMS_PWD);				
		foreach ($ph_ar as $ph){
			$t = sprintf("Заявка на спец.%s,%s,%s,%s",
				date('d/m H:i',$par->getVal('date_time')),
				$par->getVal('name'),
				$par->getVal('tel'),
				$par->getVal('comment')
			);				
			$sms->send($ph,$t,SMS_SIGN);			
		}
		
	}
	
</xsl:template>

</xsl:stylesheet>