<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class VehicleDialog_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_dialog_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"plate"
		,array(
		'required'=>TRUE,
			'alias'=>"Номер"
		,
			'length'=>6,
			'id'=>"plate"
				
		
		));
		$this->addField($f_plate);

		$f_load_capacity=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"load_capacity"
		,array(
		'required'=>TRUE,
			'alias'=>"Грузоподъемность"
		,
			'length'=>15,
			'id'=>"load_capacity"
				
		
		));
		$this->addField($f_load_capacity);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'alias'=>"ID водитель"
		,
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'alias'=>"ФИО Водителя"
		,
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'alias'=>"ID владельца"
		,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'alias'=>"ФИО владельца"
		,
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		$f_vehicle_make_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_make_id"
		,array(
		
			'alias'=>"ID марки"
		,
			'id'=>"vehicle_make_id"
				
		
		));
		$this->addField($f_vehicle_make_id);

		$f_vehicle_make_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_make_descr"
		,array(
		
			'alias'=>"Наименование марки"
		,
			'id'=>"vehicle_make_descr"
				
		
		));
		$this->addField($f_vehicle_make_descr);

		$f_vehicle_feature_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_feature_id"
		,array(
		
			'alias'=>"ID свойства"
		,
			'id'=>"vehicle_feature_id"
				
		
		));
		$this->addField($f_vehicle_feature_id);

		$f_vehicle_feature_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_feature_descr"
		,array(
		
			'alias'=>"Наименование свойства"
		,
			'id'=>"vehicle_feature_descr"
				
		
		));
		$this->addField($f_vehicle_feature_descr);

		$f_tracker_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tracker_id"
		,array(
		
			'alias'=>"Трэкер"
		,
			'id'=>"tracker_id"
				
		
		));
		$this->addField($f_tracker_id);

		$f_tracker_last_data=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tracker_last_data"
		,array(
		
			'alias'=>"Последние данные от трэкера"
		,
			'id'=>"tracker_last_data"
				
		
		));
		$this->addField($f_tracker_last_data);

		$f_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_name"
		,array(
		
			'alias'=>"Наименование основного телефона водителя"
		,
			'id'=>"tel_name"
				
		
		));
		$this->addField($f_tel_name);

		$f_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_value"
		,array(
		
			'alias'=>"Основной телефон водителя"
		,
			'id'=>"tel_value"
				
		
		));
		$this->addField($f_tel_value);

		$f_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_name"
		,array(
		
			'alias'=>"Наименование основного email водителя"
		,
			'id'=>"email_name"
				
		
		));
		$this->addField($f_email_name);

		$f_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_value"
		,array(
		
			'alias'=>"Основной email водителя"
		,
			'id'=>"email_value"
				
		
		));
		$this->addField($f_email_value);

		$f_pump_vehicle_unload_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_vehicle_unload_type"
		,array(
		
			'alias'=>"Вид разгрузки"
		,
			'id'=>"pump_vehicle_unload_type"
				
		
		));
		$this->addField($f_pump_vehicle_unload_type);

		
		
		
	}

}
?>
