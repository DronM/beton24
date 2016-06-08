<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class ClientWithDetailsList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_with_details_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'alias'=>"Наименование"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_main=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
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

		$f_client_come_from_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_id"
		,array(
		
			'id'=>"client_come_from_id"
				
		
		));
		$this->addField($f_client_come_from_id);

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
