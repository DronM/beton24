<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class DestinationDialog_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("destination_dialog_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_distance=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"distance"
		,array(
		
			'id'=>"distance"
				
		
		));
		$this->addField($f_distance);

		$f_time_route_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"time_route_descr"
		,array(
		
			'id'=>"time_route_descr"
				
		
		));
		$this->addField($f_time_route_descr);

		$f_price_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"price_descr"
		,array(
		
			'id'=>"price_descr"
				
		
		));
		$this->addField($f_price_descr);

		$f_zone_str=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"zone_str"
		,array(
		
			'id'=>"zone_str"
				
		
		));
		$this->addField($f_zone_str);

		$f_zone_center_str=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"zone_center_str"
		,array(
		
			'id'=>"zone_center_str"
				
		
		));
		$this->addField($f_zone_center_str);

		
		
		
	}

}
?>
