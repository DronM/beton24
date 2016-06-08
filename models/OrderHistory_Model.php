<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class OrderHistory_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("");
		
		$f_order_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_id"
		,array(
		
			'id'=>"order_id"
				
		
		));
		$this->addField($f_order_id);

		$f_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_user_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_descr"
		,array(
		
			'id'=>"user_descr"
				
		
		));
		$this->addField($f_user_descr);

		$f_order_event=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_event"
		,array(
		
			'id'=>"order_event"
				
		
		));
		$this->addField($f_order_event);

		
		
		
	}

}
?>
