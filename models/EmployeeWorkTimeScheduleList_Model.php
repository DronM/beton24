<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class EmployeeWorkTimeScheduleList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("employee_work_time_schedules_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'id'=>"id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_id);

		$f_employee_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"employee_id"
		,array(
		
			'id'=>"employee_id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_employee_id);

		$f_employee_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"employee_descr"
		,array(
		
			'alias'=>"Сотрудник"
		,
			'id'=>"employee_descr"
				
		
		));
		$this->addField($f_employee_descr);

		$f_day=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day"
		,array(
		
			'id'=>"day"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_day);

		$f_day_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day_descr"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"day_descr"
				
		
		));
		$this->addField($f_day_descr);

		$f_hours=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"hours"
		,array(
		
			'alias'=>"Часы"
		,
			'id'=>"hours"
				
		
		));
		$this->addField($f_hours);

		
		
		
	}

}
?>
