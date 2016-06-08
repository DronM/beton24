<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLTime.php');

class Shipment_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipments");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		'required'=>TRUE,
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_order_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Заявка"
		,
			'id'=>"order_id"
				
		
		));
		$this->addField($f_order_id);

		$f_vehicle_schedule_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_schedule_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Экипаж"
		,
			'id'=>"vehicle_schedule_id"
				
		
		));
		$this->addField($f_vehicle_schedule_id);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'alias'=>"Количество"
		,
			'length'=>19,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'alias'=>"Автор"
		,
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_demurrage=new FieldSQlTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"demurrage"
		,array(
		
			'alias'=>"Простой"
		,
			'id'=>"demurrage"
				
		
		));
		$this->addField($f_demurrage);

		
		
		
	}

}
?>
