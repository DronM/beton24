<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class CallList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("calls_list");
		
		$f_unique_id=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unique_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"unique_id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_unique_id);

		$f_caller_id_num=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"caller_id_num"
		,array(
		
			'id'=>"caller_id_num"
				
		
		));
		$this->addField($f_caller_id_num);

		$f_ext=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ext"
		,array(
		
			'id'=>"ext"
				
		
		));
		$this->addField($f_ext);

		$f_call_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"call_type"
		,array(
		
			'id'=>"call_type"
				
		
		));
		$this->addField($f_call_type);

		$f_ring_time=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ring_time"
		,array(
		
			'id'=>"ring_time"
				
		
		));
		$this->addField($f_ring_time);

		$f_answer_time=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"answer_time"
		,array(
		
			'id'=>"answer_time"
				
		
		));
		$this->addField($f_answer_time);

		$f_hangup_time=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"hangup_time"
		,array(
		
			'id'=>"hangup_time"
				
		
		));
		$this->addField($f_hangup_time);

		$f_call_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"call_comment"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"call_comment"
				
		
		));
		$this->addField($f_call_comment);

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

		$f_client_type_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_id"
		,array(
		
			'id'=>"client_type_id"
				
		
		));
		$this->addField($f_client_type_id);

		$f_client_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_descr"
		,array(
		
			'id'=>"client_type_descr"
				
		
		));
		$this->addField($f_client_type_descr);

		$f_client_come_from_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_id"
		,array(
		
			'id'=>"client_come_from_id"
				
		
		));
		$this->addField($f_client_come_from_id);

		$f_client_come_from_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_descr"
		,array(
		
			'id'=>"client_come_from_descr"
				
		
		));
		$this->addField($f_client_come_from_descr);

		$f_client_kind=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_kind"
		,array(
		
			'id'=>"client_kind"
				
		
		));
		$this->addField($f_client_kind);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_user_descr=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_descr"
		,array(
		
			'id'=>"user_descr"
				
		
		));
		$this->addField($f_user_descr);

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

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_unload_speed=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_speed"
		,array(
		
			'id'=>"unload_speed"
				
		
		));
		$this->addField($f_unload_speed);

		$f_lang_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lang_id"
		,array(
		
			'id'=>"lang_id"
				
		
		));
		$this->addField($f_lang_id);

		$f_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total"
		,array(
		
			'id'=>"total"
				
		
		));
		$this->addField($f_total);

		$f_concrete_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_price"
		,array(
		
			'id'=>"concrete_price"
				
		
		));
		$this->addField($f_concrete_price);

		$f_destination_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_price"
		,array(
		
			'id'=>"destination_price"
				
		
		));
		$this->addField($f_destination_price);

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

		$f_unload_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_price"
		,array(
		
			'id'=>"unload_price"
				
		
		));
		$this->addField($f_unload_price);

		$f_pump_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_vehicle_id"
		,array(
		
			'id'=>"pump_vehicle_id"
				
		
		));
		$this->addField($f_pump_vehicle_id);

		$f_vh_owner=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner"
		,array(
		
			'id'=>"vh_owner"
				
		
		));
		$this->addField($f_vh_owner);

		$f_vh_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_plate"
		,array(
		
			'id'=>"vh_plate"
				
		
		));
		$this->addField($f_vh_plate);

		
		
		
	}

}
?>
