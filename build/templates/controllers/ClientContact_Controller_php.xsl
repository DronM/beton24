<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'ClientContact'"/>
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
require_once(FRAME_WORK_PATH.'basic_classes/PublicMethod.php');
require_once(USER_CONTROLLERS_PATH.'Contact_Controller.php');

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	public function insert_contact($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{				
			$contr = new Contact_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('last_name',$pm->getParamValue('last_name'));
			$meth->setParamValue('first_name',$pm->getParamValue('first_name'));
			$meth->setParamValue('middle_name',$pm->getParamValue('middle_name'));
			$meth->setParamValue('post',$pm->getParamValue('post'));
			$meth->setParamValue('description',$pm->getParamValue('description'));
			$ar = $contr->insert($meth);
			
			$meth = $this->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('contact_id',$ar['id']);
			$meth->setParamValue('client_id',$pm->getParamValue('client_id'));
			$meth->setParamValue('main',$pm->getParamValue('main'));
			parent::insert($pm);
			
			if ($pm->getParamValue('ret_id')){
				$fields = array();
				array_push($fields,new Field('client_id',DT_STRING,array('value'=>$pm->getParamValue('client_id'))));
				array_push($fields,new Field('contact_id',DT_STRING,array('value'=>$ar['id'])));
				$this->addModel(new ModelVars(
					array('id'=>'LastIds',
						'values'=>$fields)
					)
				);				
			}
			
			$link->query("COMMIT");			
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			throw $e;
		}		
	}	
	public function set_main($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{
			$link->query(sprtinf(
			"UPDATE client_contacts
			SET main=FALSE
			WHERE client_id=%d
			AND main=TRUE",
			$p->getDbVal('client_id')
			));
			//new
			$link->query(sprtinf(
			"UPDATE client_contacts
			SET main=TRUE
			WHERE client_id=%d AND contact_id=%d",
			$p->getDbVal('client_id'),
			$p->getDbVal('contact_id')
			));			
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			throw $e;
		}			
	}
</xsl:template>

</xsl:stylesheet>