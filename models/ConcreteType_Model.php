<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class ConcreteType_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("concrete_types");
		
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

		$f_code_1c=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"code_1c"
		,array(
		'required'=>TRUE,
			'alias'=>"Код 1С"
		,
			'length'=>11,
			'id'=>"code_1c"
				
		
		));
		$this->addField($f_code_1c);

		$f_pres_norm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pres_norm"
		,array(
		'required'=>TRUE,
			'alias'=>"Норма давл."
		,
			'length'=>15,
			'id'=>"pres_norm"
				
		
		));
		$this->addField($f_pres_norm);

		$f_mpa_ratio=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"mpa_ratio"
		,array(
		
			'alias'=>"Кф.МПА"
		,
			'length'=>19,
			'id'=>"mpa_ratio"
				
		
		));
		$this->addField($f_mpa_ratio);

		$f_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"price"
		,array(
		
			'alias'=>"Цена"
		,
			'length'=>15,
			'id'=>"price"
				
		
		));
		$this->addField($f_price);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_name);

		
		
		
	}

}
?>
