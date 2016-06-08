<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class VehicleScheduleState_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_schedule_states");
		
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

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		'required'=>TRUE,
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_state=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state"
		,array(
		'required'=>TRUE,
			'alias'=>"Состояние"
		,
			'id'=>"state"
				
		
		));
		$this->addField($f_state);

		$f_schedule_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"schedule_id"
		,array(
		
			'alias'=>"Расписание"
		,
			'id'=>"schedule_id"
				
		
		));
		$this->addField($f_schedule_id);

		$f_shipment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipment_id"
		,array(
		
			'alias'=>"Отгрузка"
		,
			'id'=>"shipment_id"
				
		
		));
		$this->addField($f_shipment_id);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		
		
		
	}

}
?>
