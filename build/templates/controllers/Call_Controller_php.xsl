<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'Call'"/>
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
require_once 'common/Caller.php';
	
class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function set_comment($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"UPDATE calls SET manager_comment=%s
		WHERE unique_id=%s",		
		$p->getDbVal('value'),
		$p->getDbVal('id')
		));
	}
	public function dial($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->addAll();
		$caller = new Caller(AST_SERVER,AST_PORT,AST_USER,AST_PASSWORD);
		$caller->call($params->getVal('from'),$params->getVal('to'));	
	}
	public function get_active_call($pm){
		if ($_SESSION['tel_ext']){			
			$this->addNewModel(sprintf(
			"SELECT * FROM calls_active
			WHERE ext='%s'
			LIMIT 1",
			$_SESSION['tel_ext']
			),'CallActive_Model');
		}			
	}
	
</xsl:template>

</xsl:stylesheet>