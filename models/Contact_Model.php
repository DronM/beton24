<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class Contact_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contacts");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_first_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"first_name"
		,array(
		'required'=>TRUE,
			'length'=>50,
			'id'=>"first_name"
				
		
		));
		$this->addField($f_first_name);

		$f_middle_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"middle_name"
		,array(
		
			'length'=>50,
			'id'=>"middle_name"
				
		
		));
		$this->addField($f_middle_name);

		$f_last_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"last_name"
		,array(
		
			'length'=>50,
			'id'=>"last_name"
				
		
		));
		$this->addField($f_last_name);

		$f_post=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"post"
		,array(
		
			'length'=>100,
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
