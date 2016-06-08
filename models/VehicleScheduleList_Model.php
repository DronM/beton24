<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class VehicleScheduleList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_schedule_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_schedule_date=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"schedule_date"
		,array(
		
			'id'=>"schedule_date"
				
		
		));
		$this->addField($f_schedule_date);

		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_vh_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_plate"
		,array(
		
			'id'=>"vh_plate"
				
		
		));
		$this->addField($f_vh_plate);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_vh_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_descr"
		,array(
		
			'id'=>"vh_driver_descr"
				
		
		));
		$this->addField($f_vh_driver_descr);

		$f_vh_driver_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_tel_name"
		,array(
		
			'id'=>"vh_driver_tel_name"
				
		
		));
		$this->addField($f_vh_driver_tel_name);

		$f_vh_driver_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_tel_value"
		,array(
		
			'id'=>"vh_driver_tel_value"
				
		
		));
		$this->addField($f_vh_driver_tel_value);

		$f_vh_driver_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_email_name"
		,array(
		
			'id'=>"vh_driver_email_name"
				
		
		));
		$this->addField($f_vh_driver_email_name);

		$f_vh_driver_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_email_value"
		,array(
		
			'id'=>"vh_driver_email_value"
				
		
		));
		$this->addField($f_vh_driver_email_value);

		$f_vh_owner_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_id"
		,array(
		
			'id'=>"vh_owner_id"
				
		
		));
		$this->addField($f_vh_owner_id);

		$f_vh_owner_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_descr"
		,array(
		
			'id'=>"vh_owner_descr"
				
		
		));
		$this->addField($f_vh_owner_descr);

		$f_state=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state"
		,array(
		
			'id'=>"state"
				
		
		));
		$this->addField($f_state);

		$f_load_capacity=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"load_capacity"
		,array(
		
			'id'=>"load_capacity"
				
		
		));
		$this->addField($f_load_capacity);

		$f_out_comment=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"out_comment"
		,array(
		
			'id'=>"out_comment"
				
		
		));
		$this->addField($f_out_comment);

		$f_on_shift=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"on_shift"
		,array(
		
			'id'=>"on_shift"
				
		
		));
		$this->addField($f_on_shift);

		
		
		
	}

}
?>
