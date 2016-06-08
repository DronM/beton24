<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class EmployeeWorkTimeSchedule_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("employee_work_time_schedules");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_employee_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"employee_id"
		,array(
		'required'=>TRUE,
			'id'=>"employee_id"
				
		
		));
		$this->addField($f_employee_id);

		$f_day=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day"
		,array(
		'required'=>TRUE,
			'id'=>"day"
				
		
		));
		$this->addField($f_day);

		$f_hours=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"hours"
		,array(
		'required'=>TRUE,
			'defaultValue'=>"0"
		,
			'id'=>"hours"
				
		
		));
		$this->addField($f_hours);

		
		
		
	}

}
?>
