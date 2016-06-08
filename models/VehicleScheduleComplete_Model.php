<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class VehicleScheduleComplete_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_schedule_complete_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_vehicle_schedule_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_schedule_descr"
		,array(
		
			'id'=>"vehicle_schedule_descr"
				
		
		));
		$this->addField($f_vehicle_schedule_descr);

		
		
		
	}

}
?>
