<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class OrderMakeList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("orders_make_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_number=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"number"
		,array(
		
			'id'=>"number"
				
		
		));
		$this->addField($f_number);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		$f_destination_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_id"
		,array(
		
			'id'=>"destination_id"
				
		
		));
		$this->addField($f_destination_id);

		$f_destination_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_descr"
		,array(
		
			'id'=>"destination_descr"
				
		
		));
		$this->addField($f_destination_descr);

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
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

		$f_pump_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_vehicle_id"
		,array(
		
			'id'=>"pump_vehicle_id"
				
		
		));
		$this->addField($f_pump_vehicle_id);

		$f_vh_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_id"
		,array(
		
			'id'=>"vh_id"
				
		
		));
		$this->addField($f_vh_id);

		$f_address=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"address"
		,array(
		
			'id'=>"address"
				
		
		));
		$this->addField($f_address);

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

		$f_unload_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_type"
		,array(
		
			'id'=>"unload_type"
				
		
		));
		$this->addField($f_unload_type);

		$f_vh_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_client_id"
		,array(
		
			'id'=>"vh_client_id"
				
		
		));
		$this->addField($f_vh_client_id);

		$f_vh_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_client_descr"
		,array(
		
			'id'=>"vh_client_descr"
				
		
		));
		$this->addField($f_vh_client_descr);

		$f_vh_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_plate"
		,array(
		
			'id'=>"vh_plate"
				
		
		));
		$this->addField($f_vh_plate);

		$f_comment_text=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment_text"
		,array(
		
			'id'=>"comment_text"
				
		
		));
		$this->addField($f_comment_text);

		$f_unload_speed=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_speed"
		,array(
		
			'id'=>"unload_speed"
				
		
		));
		$this->addField($f_unload_speed);

		$f_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_date_time_to=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_to"
		,array(
		
			'id'=>"date_time_to"
				
		
		));
		$this->addField($f_date_time_to);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_quant_init=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_init"
		,array(
		
			'id'=>"quant_init"
				
		
		));
		$this->addField($f_quant_init);

		$f_quant_done=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_done"
		,array(
		
			'id'=>"quant_done"
				
		
		));
		$this->addField($f_quant_done);

		$f_no_ship_mark=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"no_ship_mark"
		,array(
		
			'id'=>"no_ship_mark"
				
		
		));
		$this->addField($f_no_ship_mark);

		$f_status=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"status"
		,array(
		
			'id'=>"status"
				
		
		));
		$this->addField($f_status);

		$f_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total"
		,array(
		
			'id'=>"total"
				
		
		));
		$this->addField($f_total);

		$f_total_edit=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total_edit"
		,array(
		
			'id'=>"total_edit"
				
		
		));
		$this->addField($f_total_edit);

		$f_under_control=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"under_control"
		,array(
		
			'id'=>"under_control"
				
		
		));
		$this->addField($f_under_control);

		$f_payed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"payed"
		,array(
		
			'id'=>"payed"
				
		
		));
		$this->addField($f_payed);

		$f_pay_cash=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pay_cash"
		,array(
		
			'id'=>"pay_cash"
				
		
		));
		$this->addField($f_pay_cash);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_order_edit=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_edit"
		,array(
		
			'id'=>"order_edit"
				
		
		));
		$this->addField($f_order_edit);

		
		
		
	}

}
?>
