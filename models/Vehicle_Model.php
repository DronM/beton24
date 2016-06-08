<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class Vehicle_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicles");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"plate"
		,array(
		'required'=>TRUE,
			'alias'=>"Номер"
		,
			'length'=>6,
			'id'=>"plate"
				
		
		));
		$this->addField($f_plate);

		$f_load_capacity=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"load_capacity"
		,array(
		'required'=>TRUE,
			'alias'=>"Грузоподъемность"
		,
			'length'=>15,
			'id'=>"load_capacity"
				
		
		));
		$this->addField($f_load_capacity);

		$f_vehicle_make_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_make_id"
		,array(
		'required'=>FALSE,
			'alias'=>"Марка"
		,
			'id'=>"vehicle_make_id"
				
		
		));
		$this->addField($f_vehicle_make_id);

		$f_vehicle_feature_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_feature_id"
		,array(
		'required'=>FALSE,
			'alias'=>"Свойства"
		,
			'id'=>"vehicle_feature_id"
				
		
		));
		$this->addField($f_vehicle_feature_id);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		'required'=>FALSE,
			'alias'=>"Водитель"
		,
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		'required'=>FALSE,
			'alias'=>"Владелец"
		,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_tracker_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tracker_id"
		,array(
		
			'alias'=>"Трэкер"
		,
			'length'=>15,
			'id'=>"tracker_id"
				
		
		));
		$this->addField($f_tracker_id);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_plate);

		
		
		
	}

}
?>
