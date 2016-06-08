<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class ContactList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contacts_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_first_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"first_name"
		,array(
		
			'id'=>"first_name"
				
		
		));
		$this->addField($f_first_name);

		$f_middle_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"middle_name"
		,array(
		
			'id'=>"middle_name"
				
		
		));
		$this->addField($f_middle_name);

		$f_last_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"last_name"
		,array(
		
			'id'=>"last_name"
				
		
		));
		$this->addField($f_last_name);

		$f_post=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"post"
		,array(
		
			'id'=>"post"
				
		
		));
		$this->addField($f_post);

		$f_description=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"description"
		,array(
		
			'id'=>"description"
				
		
		));
		$this->addField($f_description);

		$f_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_name"
		,array(
		
			'id'=>"tel_name"
				
		
		));
		$this->addField($f_tel_name);

		$f_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_value"
		,array(
		
			'id'=>"tel_value"
				
		
		));
		$this->addField($f_tel_value);

		$f_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_name"
		,array(
		
			'id'=>"email_name"
				
		
		));
		$this->addField($f_email_name);

		$f_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_value"
		,array(
		
			'id'=>"email_value"
				
		
		));
		$this->addField($f_email_value);

		
		
		
	}

}
?>
