<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class ContactContactDetailList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contact_contact_details_list");
		
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

		$f_main=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"main"
		,array(
		
			'id'=>"main"
				
		
		));
		$this->addField($f_main);

		$f_contact_detail_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_type"
		,array(
		
			'id'=>"contact_detail_type"
				
		
		));
		$this->addField($f_contact_detail_type);

		$f_contact_detail_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_name"
		,array(
		
			'id'=>"contact_detail_name"
				
		
		));
		$this->addField($f_contact_detail_name);

		$f_contact_detail_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_value"
		,array(
		
			'id'=>"contact_detail_value"
				
		
		));
		$this->addField($f_contact_detail_value);

		
		
		
	}

}
?>
