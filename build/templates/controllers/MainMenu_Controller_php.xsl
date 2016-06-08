<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'MainMenu'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>

require_once('models/MainMenu_Model_owner.php');
require_once('models/MainMenu_Model_boss.php');
require_once('models/MainMenu_Model_operator.php');
require_once('models/MainMenu_Model_manager.php');
require_once('models/MainMenu_Model_dispatcher.php');
require_once('models/MainMenu_Model_accountant.php');
require_once('models/MainMenu_Model_lab_worker.php');
require_once('models/MainMenu_Model_supplies.php');
require_once('models/MainMenu_Model_sales.php');
require_once('models/MainMenu_Model_plant_director.php');
require_once('models/MainMenu_Model_supervisor.php');

class <xsl:value-of select="@id"/>_Controller extends Controller{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function get_list($pm){
		if (isset($_SESSION['role_id'])){
			$menu_class = 'MainMenu_Model_'.$_SESSION['role_id'];
			$this->addModel(new $menu_class(array('id'=>'MainMenu_Model')));
		}

	}
</xsl:template>

</xsl:stylesheet>