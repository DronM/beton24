<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelReportSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class ShipmentRep_Model extends ModelReportSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipment_report");
		
		$f_ship_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time"
		,array(
		
			'id'=>"ship_date_time"
				
		
		));
		$this->addField($f_ship_date_time);

		$f_shift_descr=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shift_descr"
		,array(
		
			'alias'=>"Смена"
		,
			'id'=>"shift_descr"
				
		
		));
		$this->addField($f_shift_descr);

		$f_concrete_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_id"
		,array(
		
			'id'=>"concrete_id"
				
		
		));
		$this->addField($f_concrete_id);

		$f_concrete_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_descr"
		,array(
		
			'alias'=>"Марка бетона"
		,
			'id'=>"concrete_descr"
				
		
		));
		$this->addField($f_concrete_descr);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
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

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
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

		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_vehicle_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_descr"
		,array(
		
			'alias'=>"Автомобиль"
		,
			'id'=>"vehicle_descr"
				
		
		));
		$this->addField($f_vehicle_descr);

		$f_vehicle_feature=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_feature"
		,array(
		
			'alias'=>"Свойство автом."
		,
			'id'=>"vehicle_feature"
				
		
		));
		$this->addField($f_vehicle_feature);

		$f_vehicle_owner=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_owner"
		,array(
		
			'alias'=>"Владелец автом."
		,
			'id'=>"vehicle_owner"
				
		
		));
		$this->addField($f_vehicle_owner);

		$f_quant_shipped=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_shipped"
		,array(
		
			'alias'=>"Количество"
		,
			'id'=>"quant_shipped"
				
		
		));
		$this->addField($f_quant_shipped);

		
		
		
	}

}
?>
