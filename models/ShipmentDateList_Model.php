<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class ShipmentDateList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipment_date_list");
		
		$f_ship_date=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date"
		,array(
		
			'id'=>"ship_date"
				
		
		));
		$this->addField($f_ship_date);

		$f_ship_date_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_descr"
		,array(
		
			'alias'=>"Дата отгрузки"
		,
			'id'=>"ship_date_descr"
				
		
		));
		$this->addField($f_ship_date_descr);

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

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'alias'=>"Код марки"
		,
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'alias'=>"Марка"
		,
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

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

		$f_ship_cost=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_cost"
		,array(
		
			'alias'=>"Стоимость доставки"
		,
			'id'=>"ship_cost"
				
		
		));
		$this->addField($f_ship_cost);

		
		
		
	}

}
?>
