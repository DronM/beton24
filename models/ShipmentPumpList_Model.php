<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class ShipmentPumpList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipments_pumps_list");
		
		$f_ship_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time"
		,array(
		
			'id'=>"ship_date_time"
				
		
		));
		$this->addField($f_ship_date_time);

		$f_ship_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time_descr"
		,array(
		
			'alias'=>"Дата отгрузки"
		,
			'id'=>"ship_date_time_descr"
				
		
		));
		$this->addField($f_ship_date_time_descr);

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
		
			'alias'=>"Количество"
		,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_pump_price=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_price"
		,array(
		
			'alias'=>"Цена насоса"
		,
			'id'=>"pump_price"
				
		
		));
		$this->addField($f_pump_price);

		$f_owner=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"owner"
		,array(
		
			'alias'=>"Владелец"
		,
			'id'=>"owner"
				
		
		));
		$this->addField($f_owner);

		$f_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"plate"
		,array(
		
			'alias'=>"Гос.номер"
		,
			'id'=>"plate"
				
		
		));
		$this->addField($f_plate);

		$f_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'alias'=>"Водитель"
		,
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_demurrage=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"demurrage"
		,array(
		
			'alias'=>"Простой"
		,
			'id'=>"demurrage"
				
		
		));
		$this->addField($f_demurrage);

		$f_blanks_exist=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"blanks_exist"
		,array(
		
			'alias'=>"Бланки"
		,
			'id'=>"blanks_exist"
				
		
		));
		$this->addField($f_blanks_exist);

		
		
		
	}

}
?>
