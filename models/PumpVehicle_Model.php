<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');

class PumpVehicle_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("pump_vehicles");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_pump_price_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_price_id"
		,array(
		
			'id'=>"pump_price_id"
				
		
		));
		$this->addField($f_pump_price_id);

		$f_phone_cel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"phone_cel"
		,array(
		
			'length'=>15,
			'id'=>"phone_cel"
				
		
		));
		$this->addField($f_phone_cel);

		$f_unload_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_type"
		,array(
		'required'=>TRUE,
			'id'=>"unload_type"
				
		
		));
		$this->addField($f_unload_type);

		
		
		
	}

}
?>
