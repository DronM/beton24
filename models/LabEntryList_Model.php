<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class LabEntryList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("lab_entry_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_shipment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipment_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"shipment_id"
				
		
		));
		$this->addField($f_shipment_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_ship_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time_descr"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"ship_date_time_descr"
				
		
		));
		$this->addField($f_ship_date_time_descr);

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'alias'=>"Марка"
		,
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_ok=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok"
		,array(
		
			'id'=>"ok"
				
		
		));
		$this->addField($f_ok);

		$f_weight=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight"
		,array(
		
			'id'=>"weight"
				
		
		));
		$this->addField($f_weight);

		$f_p7=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p7"
		,array(
		
			'id'=>"p7"
				
		
		));
		$this->addField($f_p7);

		$f_p28=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p28"
		,array(
		
			'id'=>"p28"
				
		
		));
		$this->addField($f_p28);

		$f_samples=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"samples"
		,array(
		
			'alias'=>"Подборы"
		,
			'id'=>"samples"
				
		
		));
		$this->addField($f_samples);

		$f_materials=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"materials"
		,array(
		
			'alias'=>"Материалы"
		,
			'id'=>"materials"
				
		
		));
		$this->addField($f_materials);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'alias'=>"Заказчик"
		,
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		$f_client_phone=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_phone"
		,array(
		
			'alias'=>"Телефон"
		,
			'id'=>"client_phone"
				
		
		));
		$this->addField($f_client_phone);

		$f_destination_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_descr"
		,array(
		
			'alias'=>"Объект"
		,
			'id'=>"destination_descr"
				
		
		));
		$this->addField($f_destination_descr);

		$f_ok2=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok2"
		,array(
		
			'alias'=>"ОК2"
		,
			'id'=>"ok2"
				
		
		));
		$this->addField($f_ok2);

		$f_time=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"time"
		,array(
		
			'alias'=>"Время"
		,
			'id'=>"time"
				
		
		));
		$this->addField($f_time);

		
		
		
	}

}
?>
