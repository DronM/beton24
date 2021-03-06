<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class ContactContactDetail_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contact_contact_details");
		
		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_contact_detail_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"contact_detail_id"
				
		
		));
		$this->addField($f_contact_detail_id);

		$f_main=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"main"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"main"
				
		
		));
		$this->addField($f_main);

		
		
		
	}

}
?>
