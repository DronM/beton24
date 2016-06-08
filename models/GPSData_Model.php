<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class GPSData_Model extends ModelSQL{
	
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

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_driver_descr=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_driver_tel=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_tel"
		,array(
		
			'id'=>"driver_tel"
				
		
		));
		$this->addField($f_driver_tel);

		$f_shipment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipment_id"
		,array(
		
			'id'=>"shipment_id"
				
		
		));
		$this->addField($f_shipment_id);

		$f_ship_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time"
		,array(
		
			'id'=>"ship_date_time"
				
		
		));
		$this->addField($f_ship_date_time);

		$f_ship_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_quant"
		,array(
		
			'id'=>"ship_quant"
				
		
		));
		$this->addField($f_ship_quant);

		$f_order_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_quant"
		,array(
		
			'id'=>"order_quant"
				
		
		));
		$this->addField($f_order_quant);

		$f_concrete_type_id=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_order_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_total"
		,array(
		
			'id'=>"order_total"
				
		
		));
		$this->addField($f_order_total);

		$f_order_payed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_payed"
		,array(
		
			'id'=>"order_payed"
				
		
		));
		$this->addField($f_order_payed);

		$f_order_under_control=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_under_control"
		,array(
		
			'id'=>"order_under_control"
				
		
		));
		$this->addField($f_order_under_control);

		$f_order_pay_cash=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_pay_cash"
		,array(
		
			'id'=>"order_pay_cash"
				
		
		));
		$this->addField($f_order_pay_cash);

		$f_order_number=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_number"
		,array(
		
			'id'=>"order_number"
				
		
		));
		$this->addField($f_order_number);

		$f_order_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_user_id"
		,array(
		
			'id'=>"order_user_id"
				
		
		));
		$this->addField($f_order_user_id);

		$f_order_user_descr=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_user_descr"
		,array(
		
			'id'=>"order_user_descr"
				
		
		));
		$this->addField($f_order_user_descr);

		$f_destination_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_id"
		,array(
		
			'id'=>"destination_id"
				
		
		));
		$this->addField($f_destination_id);

		$f_vehicle_tracker_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_tracker_id"
		,array(
		
			'id'=>"vehicle_tracker_id"
				
		
		));
		$this->addField($f_vehicle_tracker_id);

		$f_state=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state"
		,array(
		
			'id'=>"state"
				
		
		));
		$this->addField($f_state);

		
		
		
	}

}
?>
