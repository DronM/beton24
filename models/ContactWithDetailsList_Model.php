<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class ContactWithDetailsList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("contact_with_details_list");
		
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

		$f_main=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"main"
		,array(
		
			'id'=>"main"
				
		
		));
		$this->addField($f_main);

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

		$f_contact_detail_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_type"
		,array(
		
			'id'=>"contact_detail_type"
				
		
		));
		$this->addField($f_contact_detail_type);

		
		
		
	}

}
?>
