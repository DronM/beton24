<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class GPSDataAll_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("");
		
		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_vehicle_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_plate"
		,array(
		
			'id'=>"vehicle_plate"
				
		
		));
		$this->addField($f_vehicle_plate);

		$f_vehicle_owner=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_owner"
		,array(
		
			'id'=>"vehicle_owner"
				
		
		));
		$this->addField($f_vehicle_owner);

		$f_vehicle_make=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_make"
		,array(
		
			'id'=>"vehicle_make"
				
		
		));
		$this->addField($f_vehicle_make);

		$f_period=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"period"
		,array(
		
			'id'=>"period"
				
		
		));
		$this->addField($f_period);

		$f_lon_str=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lon_str"
		,array(
		
			'id'=>"lon_str"
				
		
		));
		$this->addField($f_lon_str);

		$f_lat_str=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lat_str"
		,array(
		
			'id'=>"lat_str"
				
		
		));
		$this->addField($f_lat_str);

		$f_speed=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"speed"
		,array(
		
			'id'=>"speed"
				
		
		));
		$this->addField($f_speed);

		$f_ns=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ns"
		,array(
		
			'id'=>"ns"
				
		
		));
		$this->addField($f_ns);

		$f_ew=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ew"
		,array(
		
			'id'=>"ew"
				
		
		));
		$this->addField($f_ew);

		$f_received_dt=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"received_dt"
		,array(
		
			'id'=>"received_dt"
				
		
		));
		$this->addField($f_received_dt);

		$f_odometer=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"odometer"
		,array(
		
			'id'=>"odometer"
				
		
		));
		$this->addField($f_odometer);

		$f_engine_on=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"engine_on"
		,array(
		
			'id'=>"engine_on"
				
		
		));
		$this->addField($f_engine_on);

		$f_voltage=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"voltage"
		,array(
		
			'id'=>"voltage"
				
		
		));
		$this->addField($f_voltage);

		$f_heading=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"heading"
		,array(
		
			'id'=>"heading"
				
		
		));
		$this->addField($f_heading);

		$f_lon=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lon"
		,array(
		
			'id'=>"lon"
				
		
		));
		$this->addField($f_lon);

		$f_lat=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lat"
		,array(
		
			'id'=>"lat"
				
		
		));
		$this->addField($f_lat);

		
		
		
	}

}
?>
