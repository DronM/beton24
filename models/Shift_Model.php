<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class Shift_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shifts");
		
		$f_date=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'alias'=>"Дата"
		,
			'id'=>"date"
				
		
		));
		$this->addField($f_date);

		$f_closed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"closed"
		,array(
		'required'=>FALSE,
			'primaryKey'=>FALSE,
			'autoInc'=>FALSE,
			'alias'=>"Закрыта"
		,
			'id'=>"closed"
				
		
		));
		$this->addField($f_closed);

		$f_close_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"close_date_time"
		,array(
		'required'=>FALSE,
			'primaryKey'=>FALSE,
			'autoInc'=>FALSE,
			'alias'=>"Дата закрытия"
		,
			'id'=>"close_date_time"
				
		
		));
		$this->addField($f_close_date_time);

		
		
		
	}

}
?>
