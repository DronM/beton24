<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class OrderCountList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("orders_count_on_period");
		
		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_cnt=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"cnt"
		,array(
		
			'id'=>"cnt"
				
		
		));
		$this->addField($f_cnt);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_period=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"period"
		,array(
		
			'id'=>"period"
				
		
		));
		$this->addField($f_period);

		
		
		
	}

}
?>
