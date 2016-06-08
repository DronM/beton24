<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class ContactDetail_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contact_details");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_contact_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_type"
		,array(
		
			'length'=>50,
			'id'=>"contact_type"
				
		
		));
		$this->addField($f_contact_type);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'length'=>100,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"value"
		,array(
		
			'length'=>100,
			'id'=>"value"
				
		
		));
		$this->addField($f_value);

		
		
		
	}

}
?>
