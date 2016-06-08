<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class ShipmentForOrderList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipment_for_order_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_order_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_id"
		,array(
		
			'alias'=>"ID заявки"
		,
			'id'=>"order_id"
				
		
		));
		$this->addField($f_order_id);

		$f_order_number=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_number"
		,array(
		
			'alias'=>"номер заявки"
		,
			'id'=>"order_number"
				
		
		));
		$this->addField($f_order_number);

		$f_order_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_quant"
		,array(
		
			'alias'=>"Количество заявки"
		,
			'id'=>"order_quant"
				
		
		));
		$this->addField($f_order_quant);

		$f_vehicle_schedule_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_schedule_id"
		,array(
		
			'alias'=>"ID расписания"
		,
			'id'=>"vehicle_schedule_id"
				
		
		));
		$this->addField($f_vehicle_schedule_id);

		$f_ship_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time"
		,array(
		
			'alias'=>"Дата-время отгрузки"
		,
			'id'=>"ship_date_time"
				
		
		));
		$this->addField($f_ship_date_time);

		$f_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'alias'=>"Дата-время назначения"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'alias'=>"Количество"
		,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_cost=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"cost"
		,array(
		
			'alias'=>"Стоимость"
		,
			'id'=>"cost"
				
		
		));
		$this->addField($f_cost);

		$f_shipped=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipped"
		,array(
		
			'alias'=>"Отгружен"
		,
			'id'=>"shipped"
				
		
		));
		$this->addField($f_shipped);

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'alias'=>"ID марки"
		,
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'alias'=>"Представление марки"
		,
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_vh_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_client_id"
		,array(
		
			'alias'=>"ID владельца ТС"
		,
			'id'=>"vh_client_id"
				
		
		));
		$this->addField($f_vh_client_id);

		$f_vh_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_client_descr"
		,array(
		
			'alias'=>"Представление владельца ТС"
		,
			'id'=>"vh_client_descr"
				
		
		));
		$this->addField($f_vh_client_descr);

		$f_vh_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vh_plate"
		,array(
		
			'alias'=>"Гос.номер ТС"
		,
			'id'=>"vh_plate"
				
		
		));
		$this->addField($f_vh_plate);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'alias'=>"ID водителя"
		,
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'alias'=>"Прелставление водителя"
		,
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_destination_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_id"
		,array(
		
			'alias'=>"Объект"
		,
			'id'=>"destination_id"
				
		
		));
		$this->addField($f_destination_id);

		$f_destination_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_descr"
		,array(
		
			'alias'=>"Объект"
		,
			'id'=>"destination_descr"
				
		
		));
		$this->addField($f_destination_descr);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'alias'=>"ID клиента"
		,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'alias'=>"Представление клиента"
		,
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		$f_demurrage_cost=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"demurrage_cost"
		,array(
		
			'alias'=>"Стоимость простоя"
		,
			'id'=>"demurrage_cost"
				
		
		));
		$this->addField($f_demurrage_cost);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'alias'=>"ID пользователя"
		,
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_user_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_descr"
		,array(
		
			'alias'=>"Представление пользователя"
		,
			'id'=>"user_descr"
				
		
		));
		$this->addField($f_user_descr);

		$f_state_assigned=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state_assigned"
		,array(
		
			'alias'=>"Время статуса назначено"
		,
			'id'=>"state_assigned"
				
		
		));
		$this->addField($f_state_assigned);

		$f_state_left_for_dest=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state_left_for_dest"
		,array(
		
			'alias'=>"Время статуса выехал на объект"
		,
			'id'=>"state_left_for_dest"
				
		
		));
		$this->addField($f_state_left_for_dest);

		$f_state_at_dest=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state_at_dest"
		,array(
		
			'alias'=>"Время статуса на объкете"
		,
			'id'=>"state_at_dest"
				
		
		));
		$this->addField($f_state_at_dest);

		$f_state_left_for_base=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state_left_for_base"
		,array(
		
			'alias'=>"Время статуса выехал на базу"
		,
			'id'=>"state_left_for_base"
				
		
		));
		$this->addField($f_state_left_for_base);

		$f_state_free=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state_free"
		,array(
		
			'alias'=>"Время статуса свободен"
		,
			'id'=>"state_free"
				
		
		));
		$this->addField($f_state_free);

		$f_state=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state"
		,array(
		
			'alias'=>"Текущий статус"
		,
			'id'=>"state"
				
		
		));
		$this->addField($f_state);

		$f_is_late=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"is_late"
		,array(
		
			'alias'=>"Признак опоздания"
		,
			'id'=>"is_late"
				
		
		));
		$this->addField($f_is_late);

		$f_next_state_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"next_state_date_time"
		,array(
		
			'alias'=>"Расчетное время следующего статуса"
		,
			'id'=>"next_state_date_time"
				
		
		));
		$this->addField($f_next_state_date_time);

		
		
		
	}

}
?>
