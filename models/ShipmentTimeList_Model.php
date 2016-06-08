<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class ShipmentTimeList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipment_time_list");
		
		$f_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"№"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'alias'=>"Код клиента"
		,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'alias'=>"Клиент"
		,
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		$f_destination_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_id"
		,array(
		
			'alias'=>"Код объекта"
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

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'alias'=>"Объем"
		,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_vehicle_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_plate"
		,array(
		
			'alias'=>"Номер ТС"
		,
			'id'=>"vehicle_plate"
				
		
		));
		$this->addField($f_vehicle_plate);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'alias'=>"Водитель код"
		,
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'alias'=>"Водитель"
		,
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_assign_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"assign_date_time"
		,array(
		
			'alias'=>"Назначение"
		,
			'id'=>"assign_date_time"
				
		
		));
		$this->addField($f_assign_date_time);

		$f_assign_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"assign_date_time_descr"
		,array(
		
			'alias'=>"Назначение"
		,
			'id'=>"assign_date_time_descr"
				
		
		));
		$this->addField($f_assign_date_time_descr);

		$f_ship_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time"
		,array(
		
			'alias'=>"Отгрузка"
		,
			'id'=>"ship_date_time"
				
		
		));
		$this->addField($f_ship_date_time);

		$f_ship_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time_descr"
		,array(
		
			'alias'=>"Отгрузка"
		,
			'id'=>"ship_date_time_descr"
				
		
		));
		$this->addField($f_ship_date_time_descr);

		$f_dispatcher_fail_min=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"dispatcher_fail_min"
		,array(
		
			'alias'=>"Опоздание диспетчара (мин)"
		,
			'id'=>"dispatcher_fail_min"
				
		
		));
		$this->addField($f_dispatcher_fail_min);

		$f_ship_time_norm=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_time_norm"
		,array(
		
			'alias'=>"Норма погрузки (мин)"
		,
			'id'=>"ship_time_norm"
				
		
		));
		$this->addField($f_ship_time_norm);

		$f_operator_fail_min=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"operator_fail_min"
		,array(
		
			'alias'=>"Опоздание оператора (мин)"
		,
			'id'=>"operator_fail_min"
				
		
		));
		$this->addField($f_operator_fail_min);

		$f_total_fail_min=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total_fail_min"
		,array(
		
			'alias'=>"Опоздание общее (мин)"
		,
			'id'=>"total_fail_min"
				
		
		));
		$this->addField($f_total_fail_min);

		
		
		
	}

}
?>
