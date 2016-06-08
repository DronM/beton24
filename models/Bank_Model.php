<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class Bank_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("banks");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_bik=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"bik"
		,array(
		
			'alias'=>"БИК"
		,
			'length'=>9,
			'id'=>"bik"
				
		
		));
		$this->addField($f_bik);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'alias'=>"Наименование"
		,
			'length'=>100,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_account=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"account"
		,array(
		
			'alias'=>"Кор.счет"
		,
			'length'=>20,
			'id'=>"account"
				
		
		));
		$this->addField($f_account);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_name);

		
		
		
	}

}
?>
