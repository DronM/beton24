<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');

class ContactDetailFullList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contact_detail_full_list");
		
		$f_head_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"head_type"
		,array(
		
			'id'=>"head_type"
				
		
		));
		$this->addField($f_head_type);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_contact_detail_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_id"
		,array(
		
			'id'=>"contact_detail_id"
				
		
		));
		$this->addField($f_contact_detail_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_contact_detail_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
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

		$f_contact_description=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_description"
		,array(
		
			'id'=>"contact_description"
				
		
		));
		$this->addField($f_contact_description);

		
		
		
	}

}
?>
