<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class PumpVehicleList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("pump_vehicles_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_pump_price_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_price_id"
		,array(
		
			'id'=>"pump_price_id"
				
		
		));
		$this->addField($f_pump_price_id);

		$f_pump_price_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_price_descr"
		,array(
		
			'id'=>"pump_price_descr"
				
		
		));
		$this->addField($f_pump_price_descr);

		$f_unload_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_type"
		,array(
		
			'id'=>"unload_type"
				
		
		));
		$this->addField($f_unload_type);

		$f_vh_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_id"
		,array(
		
			'id'=>"vh_id"
				
		
		));
		$this->addField($f_vh_id);

		$f_vh_owner_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_id"
		,array(
		
			'id'=>"vh_owner_id"
				
		
		));
		$this->addField($f_vh_owner_id);

		$f_vh_owner_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_tel_name"
		,array(
		
			'id'=>"vh_owner_tel_name"
				
		
		));
		$this->addField($f_vh_owner_tel_name);

		$f_vh_owner_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_tel_value"
		,array(
		
			'id'=>"vh_owner_tel_value"
				
		
		));
		$this->addField($f_vh_owner_tel_value);

		$f_vh_owner_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_email_name"
		,array(
		
			'id'=>"vh_owner_email_name"
				
		
		));
		$this->addField($f_vh_owner_email_name);

		$f_vh_owner_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner_email_value"
		,array(
		
			'id'=>"vh_owner_email_value"
				
		
		));
		$this->addField($f_vh_owner_email_value);

		$f_vh_driver_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_tel_name"
		,array(
		
			'id'=>"vh_driver_tel_name"
				
		
		));
		$this->addField($f_vh_driver_tel_name);

		$f_vh_driver_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_tel_value"
		,array(
		
			'id'=>"vh_driver_tel_value"
				
		
		));
		$this->addField($f_vh_driver_tel_value);

		$f_vh_driver_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_email_name"
		,array(
		
			'id'=>"vh_driver_email_name"
				
		
		));
		$this->addField($f_vh_driver_email_name);

		$f_vh_driver_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_driver_email_value"
		,array(
		
			'id'=>"vh_driver_email_value"
				
		
		));
		$this->addField($f_vh_driver_email_value);

		
		
		
	}

}
?>
