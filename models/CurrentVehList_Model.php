<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class CurrentVehList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("pump_vehicles_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_vh_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_plate"
		,array(
		
			'id'=>"vh_plate"
				
		
		));
		$this->addField($f_vh_plate);

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

		$f_vh_owner_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_tel_name"
		,array(
		
			'id'=>"vh_owner_tel_name"
				
		
		));
		$this->addField($f_vh_owner_tel_name);

		$f_vh_owner_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_tel_value"
		,array(
		
			'id'=>"vh_owner_tel_value"
				
		
		));
		$this->addField($f_vh_owner_tel_value);

		$f_vh_owner_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_email_name"
		,array(
		
			'id'=>"vh_owner_email_name"
				
		
		));
		$this->addField($f_vh_owner_email_name);

		$f_vh_owner_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_email_value"
		,array(
		
			'id'=>"vh_owner_email_value"
				
		
		));
		$this->addField($f_vh_owner_email_value);

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

		$f_state=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state"
		,array(
		
			'id'=>"state"
				
		
		));
		$this->addField($f_state);

		$f_state_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state_date_time"
		,array(
		
			'id'=>"state_date_time"
				
		
		));
		$this->addField($f_state_date_time);

		$f_is_late=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"is_late"
		,array(
		
			'id'=>"is_late"
				
		
		));
		$this->addField($f_is_late);

		$f_is_late_at_dest=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"is_late_at_dest"
		,array(
		
			'id'=>"is_late_at_dest"
				
		
		));
		$this->addField($f_is_late_at_dest);

		$f_idle_time=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"idle_time"
		,array(
		
			'id'=>"idle_time"
				
		
		));
		$this->addField($f_idle_time);

		$f_waiting_time=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"waiting_time"
		,array(
		
			'id'=>"waiting_time"
				
		
		));
		$this->addField($f_waiting_time);

		$f_out_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"out_time"
		,array(
		
			'id'=>"out_time"
				
		
		));
		$this->addField($f_out_time);

		$f_load_capacity=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"load_capacity"
		,array(
		
			'length'=>15,
			'id'=>"load_capacity"
				
		
		));
		$this->addField($f_load_capacity);

		$f_runs=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"runs"
		,array(
		
			'id'=>"runs"
				
		
		));
		$this->addField($f_runs);

		$f_tracker_no_data=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tracker_no_data"
		,array(
		
			'id'=>"tracker_no_data"
				
		
		));
		$this->addField($f_tracker_no_data);

		$f_no_tracker=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"no_tracker"
		,array(
		
			'id'=>"no_tracker"
				
		
		));
		$this->addField($f_no_tracker);

		$f_schedule_date=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"schedule_date"
		,array(
		
			'id'=>"schedule_date"
				
		
		));
		$this->addField($f_schedule_date);

		$f_out_comment=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"out_comment"
		,array(
		
			'id'=>"out_comment"
				
		
		));
		$this->addField($f_out_comment);

		
		
		
	}

}
?>
