<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class DriverList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("drivers_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Код"
		,
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

		$f_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_name"
		,array(
		
			'alias'=>"Наименование контактной информации с телефоном"
		,
			'id'=>"tel_name"
				
		
		));
		$this->addField($f_tel_name);

		$f_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_value"
		,array(
		
			'alias'=>"Значение контактной информации с телефоном"
		,
			'id'=>"tel_value"
				
		
		));
		$this->addField($f_tel_value);

		$f_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_name"
		,array(
		
			'alias'=>"Наименование контактной информации с email"
		,
			'id'=>"email_name"
				
		
		));
		$this->addField($f_email_name);

		$f_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_value"
		,array(
		
			'alias'=>"Значение контактной информации с email"
		,
			'id'=>"email_value"
				
		
		));
		$this->addField($f_email_value);

		
		
		
	}

}
?>
