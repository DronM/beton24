<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'UIStorage'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>

require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
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
	public function set($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT ui_storage_set(ROW(%s,%d,%s)::ui_storages)",
		$p->getDbVal('ui_id'),
		$_SESSION['user_id'],
		$p->getDbVal('data')
		));
	}
	public function get($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$id_list = $p->getVal('ui_id_list');
		$id_db_list = '';
		$q = '';
		if (isset($id_list)){
			$ids = explode(',',$id_list);
			foreach($ids as $id) {
				$id_db = NULL;
				FieldSQLString::formatForDb($this->getDbLink(),$id,$id_db);
				$id_db_list.= ($id_db_list)? ',':'';
				$id_db_list.= $id_db;
			}
			$q = sprintf(" AND ui_id IN (%s)",$id_db_list);
		}
		$this->addNewModel(sprintf(
		"SELECT ui_id,data
		FROM ui_storages
		WHERE user_id=%d%s",
		$_SESSION['user_id'],
		$q
		),
		'UIStorageList_Model');		
		
	}
	public function delete($pm){
		$pm->setParamValue('user_id',$_SESSION['user_id']);
		parent::delete($pm);
		/*
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$this->getDbLinkMaster()->query(sprintf(
		"DELETE FROM ui_storages
		WHERE user_id=%d AND ui_id = %s",
		$_SESSION['user_id'],
		$p->getDbVal('ui_id')
		));
		*/
	}
</xsl:template>

</xsl:stylesheet>