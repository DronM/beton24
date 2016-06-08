<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class DestinationList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("destination_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'length'=>100,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_distance=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"distance"
		,array(
		
			'id'=>"distance"
				
		
		));
		$this->addField($f_distance);

		$f_time_route=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"time_route"
		,array(
		
			'id'=>"time_route"
				
		
		));
		$this->addField($f_time_route);

		$f_price=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"price"
		,array(
		
			'id'=>"price"
				
		
		));
		$this->addField($f_price);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_name);

		
		
		
	}

}
?>
