<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class ClientContactList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_contacts_list");
		
		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_first_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"first_name"
		,array(
		
			'id'=>"first_name"
				
		
		));
		$this->addField($f_first_name);

		$f_last_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"last_name"
		,array(
		
			'id'=>"last_name"
				
		
		));
		$this->addField($f_last_name);

		$f_middle_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"middle_name"
		,array(
		
			'id'=>"middle_name"
				
		
		));
		$this->addField($f_middle_name);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

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

		
		
		
	}

}
?>
