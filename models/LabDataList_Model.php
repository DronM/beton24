<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class LabDataList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("lab_data_list_view");
		
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

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'alias'=>"Марка"
		,
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_quant_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_descr"
		,array(
		
			'alias'=>"Кол-во"
		,
			'id'=>"quant_descr"
				
		
		));
		$this->addField($f_quant_descr);

		$f_num=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"num"
		,array(
		
			'alias'=>"№"
		,
			'id'=>"num"
				
		
		));
		$this->addField($f_num);

		$f_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'alias'=>"Водитель"
		,
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_ok_sm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok_sm"
		,array(
		
			'alias'=>"ОК см"
		,
			'id'=>"ok_sm"
				
		
		));
		$this->addField($f_ok_sm);

		$f_weight=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight"
		,array(
		
			'alias'=>"масса"
		,
			'id'=>"weight"
				
		
		));
		$this->addField($f_weight);

		$f_weight_norm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight_norm"
		,array(
		
			'alias'=>"масса норм"
		,
			'id'=>"weight_norm"
				
		
		));
		$this->addField($f_weight_norm);

		$f_percent_1=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"percent_1"
		,array(
		
			'alias'=>"%"
		,
			'id'=>"percent_1"
				
		
		));
		$this->addField($f_percent_1);

		$f_p_1=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_1"
		,array(
		
			'alias'=>"p1"
		,
			'id'=>"p_1"
				
		
		));
		$this->addField($f_p_1);

		$f_p_2=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_2"
		,array(
		
			'alias'=>"p2"
		,
			'id'=>"p_2"
				
		
		));
		$this->addField($f_p_2);

		$f_p_3=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_3"
		,array(
		
			'alias'=>"p3"
		,
			'id'=>"p_3"
				
		
		));
		$this->addField($f_p_3);

		$f_p_4=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_4"
		,array(
		
			'alias'=>"p4"
		,
			'id'=>"p_4"
				
		
		));
		$this->addField($f_p_4);

		$f_p_7=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_7"
		,array(
		
			'alias'=>"p7"
		,
			'id'=>"p_7"
				
		
		));
		$this->addField($f_p_7);

		$f_p_norm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_norm"
		,array(
		
			'alias'=>"p_norm"
		,
			'id'=>"p_norm"
				
		
		));
		$this->addField($f_p_norm);

		$f_percent_2=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"percent_2"
		,array(
		
			'alias'=>"percent_2"
		,
			'id'=>"percent_2"
				
		
		));
		$this->addField($f_percent_2);

		$f_lab_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lab_comment"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"lab_comment"
				
		
		));
		$this->addField($f_lab_comment);

		
		
		
	}

}
?>
