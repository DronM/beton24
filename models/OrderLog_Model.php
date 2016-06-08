<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class OrderLog_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("order_log");
		
		$f_order_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"order_id"
				
		
		));
		$this->addField($f_order_id);

		$f_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_order_event=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_event"
		,array(
		
			'id'=>"order_event"
				
		
		));
		$this->addField($f_order_event);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_date_time);

		
		
		
	}

}
?>
