<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'Lang'"/>
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
require_once(FRAME_WORK_PATH.'basic_classes/ModelVars.php');

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	
	const ER_NO_LOCAL = 'Локаль не найдена.@1000';
	
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function get_locale($pm){
		$link = $this->getDbLink();		
		$p = new ParamsSQL($pm,$link);
		$p->addAll();
		if (!file_exists($file=LOCALE_PATH.$p->getVal('name'))){
			throw new Exception($this::ER_NO_LOCAL);
		}
		$this->addModel(new ModelVars(
			array('name'=>'Vars',
				'id'=>'Locale_Model',
				'values'=>array(
					new Field('value',DT_STRING,
						array('value'=>file_get_contents($file)))
				)
			)
		));
	}
</xsl:template>

</xsl:stylesheet>