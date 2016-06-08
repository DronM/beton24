<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class Order_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("orders");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'alias'=>"клиент"
		,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'alias'=>"Марка бетона"
		,
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_concrete_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_price"
		,array(
		
			'alias'=>"Стоимость"
		,
			'length'=>15,
			'id'=>"concrete_price"
				
		
		));
		$this->addField($f_concrete_price);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_destination_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_id"
		,array(
		
			'alias'=>"Направление"
		,
			'id'=>"destination_id"
				
		
		));
		$this->addField($f_destination_id);

		$f_destination_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_price"
		,array(
		
			'alias'=>"Стоимость дост."
		,
			'length'=>15,
			'id'=>"destination_price"
				
		
		));
		$this->addField($f_destination_price);

		$f_pump_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_vehicle_id"
		,array(
		
			'alias'=>"Насос"
		,
			'id'=>"pump_vehicle_id"
				
		
		));
		$this->addField($f_pump_vehicle_id);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'alias'=>"Автор"
		,
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_address=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"address"
		,array(
		
			'id'=>"address"
				
		
		));
		$this->addField($f_address);

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

		$f_order_temp_comment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_temp_comment_id"
		,array(
		
			'id'=>"order_temp_comment_id"
				
		
		));
		$this->addField($f_order_temp_comment_id);

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

		$f_payed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"payed"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"payed"
				
		
		));
		$this->addField($f_payed);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'alias'=>"Количество"
		,
			'length'=>19,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_quant_init=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_init"
		,array(
		
			'alias'=>"Количество начальное"
		,
			'length'=>19,
			'id'=>"quant_init"
				
		
		));
		$this->addField($f_quant_init);

		$f_temp=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"temp"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"temp"
				
		
		));
		$this->addField($f_temp);

		$f_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total"
		,array(
		
			'alias'=>"Сумма"
		,
			'length'=>15,
			'id'=>"total"
				
		
		));
		$this->addField($f_total);

		$f_total_edit=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total_edit"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"total_edit"
				
		
		));
		$this->addField($f_total_edit);

		$f_under_control=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"under_control"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"under_control"
				
		
		));
		$this->addField($f_under_control);

		$f_unload_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_price"
		,array(
		
			'alias'=>"Стоимость прокачки"
		,
			'length'=>15,
			'id'=>"unload_price"
				
		
		));
		$this->addField($f_unload_price);

		$f_unload_speed=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_speed"
		,array(
		
			'alias'=>"Разгрузка куб/ч"
		,
			'length'=>19,
			'id'=>"unload_speed"
				
		
		));
		$this->addField($f_unload_speed);

		$f_unload_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unload_type"
		,array(
		
			'alias'=>"Прокачка"
		,
			'id'=>"unload_type"
				
		
		));
		$this->addField($f_unload_type);

		
		
		
	}

}
?>
