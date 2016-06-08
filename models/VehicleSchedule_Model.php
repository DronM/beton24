<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class VehicleSchedule_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_schedules");
		
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

		$f_schedule_date=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"schedule_date"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"schedule_date"
				
		
		));
		$this->addField($f_schedule_date);

		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Автомобиль"
		,
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Водитель"
		,
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		
		
		
	}

}
?>
