<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class OfferList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("offers_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

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
		
			'alias'=>"ID марки бетона"
		,
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_concrete_type_descr=new FieldSQl($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'alias'=>"Марка бетона"
		,
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_unload_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_type"
		,array(
		
			'alias'=>"Прокачка"
		,
			'id'=>"unload_type"
				
		
		));
		$this->addField($f_unload_type);

		$f_comment_text=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment_text"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"comment_text"
				
		
		));
		$this->addField($f_comment_text);

		$f_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		'required'=>TRUE,
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_date_time_to=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_to"
		,array(
		
			'alias'=>"Время до"
		,
			'id'=>"date_time_to"
				
		
		));
		$this->addField($f_date_time_to);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'alias'=>"Количество"
		,
			'length'=>19,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_unload_speed=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_speed"
		,array(
		
			'alias'=>"Разгрузка куб/ч"
		,
			'length'=>19,
			'id'=>"unload_speed"
				
		
		));
		$this->addField($f_unload_speed);

		$f_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total"
		,array(
		
			'alias'=>"Сумма"
		,
			'length'=>15,
			'id'=>"total"
				
		
		));
		$this->addField($f_total);

		$f_concrete_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_price"
		,array(
		
			'alias'=>"Стоимость"
		,
			'length'=>15,
			'id'=>"concrete_price"
				
		
		));
		$this->addField($f_concrete_price);

		$f_destination_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_price"
		,array(
		
			'alias'=>"Стоимость дост."
		,
			'length'=>15,
			'id'=>"destination_price"
				
		
		));
		$this->addField($f_destination_price);

		$f_unload_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_price"
		,array(
		
			'alias'=>"Стоимость прокачки"
		,
			'length'=>15,
			'id'=>"unload_price"
				
		
		));
		$this->addField($f_unload_price);

		$f_pump_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_vehicle_id"
		,array(
		
			'alias'=>"Насос"
		,
			'id'=>"pump_vehicle_id"
				
		
		));
		$this->addField($f_pump_vehicle_id);

		$f_vh_owner=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_owner"
		,array(
		
			'alias'=>"Владелец"
		,
			'id'=>"vh_owner"
				
		
		));
		$this->addField($f_vh_owner);

		$f_vh_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_plate"
		,array(
		
			'alias'=>"ТС номер"
		,
			'id'=>"vh_plate"
				
		
		));
		$this->addField($f_vh_plate);

		$f_pay_cash=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pay_cash"
		,array(
		
			'alias'=>"Оплата на месте"
		,
			'defaultValue'=>"FALSE"
		,
			'id'=>"pay_cash"
				
		
		));
		$this->addField($f_pay_cash);

		$f_total_edit=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total_edit"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"total_edit"
				
		
		));
		$this->addField($f_total_edit);

		$f_payed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"payed"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"payed"
				
		
		));
		$this->addField($f_payed);

		$f_under_control=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"under_control"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"under_control"
				
		
		));
		$this->addField($f_under_control);

		$f_address=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"address"
		,array(
		
			'id'=>"address"
				
		
		));
		$this->addField($f_address);

		$f_def_call_reply_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"def_call_reply_id"
		,array(
		
			'id'=>"def_call_reply_id"
				
		
		));
		$this->addField($f_def_call_reply_id);

		$f_def_call_reply_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"def_call_reply_descr"
		,array(
		
			'id'=>"def_call_reply_descr"
				
		
		));
		$this->addField($f_def_call_reply_descr);

		
		
		
	}

}
?>
