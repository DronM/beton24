<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQLDOC.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class DOCMaterialProcurement_Model extends ModelSQLDOC{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("doc_material_procurements");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		'required'=>TRUE,
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_number=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"number"
		,array(
		
			'alias'=>"Номер"
		,
			'length'=>11,
			'id'=>"number"
				
		
		));
		$this->addField($f_number);

		$f_doc_ref=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"doc_ref"
		,array(
		
			'length'=>36,
			'id'=>"doc_ref"
				
		
		));
		$this->addField($f_doc_ref);

		$f_processed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"processed"
		,array(
		
			'alias'=>"Проведен"
		,
			'id'=>"processed"
				
		
		));
		$this->addField($f_processed);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'alias'=>"Автор"
		,
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_supplier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Поставщик"
		,
			'id'=>"supplier_id"
				
		
		));
		$this->addField($f_supplier_id);

		$f_carrier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"carrier_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Перевозчик"
		,
			'id'=>"carrier_id"
				
		
		));
		$this->addField($f_carrier_id);

		$f_driver=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver"
		,array(
		
			'alias'=>"Водитель"
		,
			'length'=>100,
			'id'=>"driver"
				
		
		));
		$this->addField($f_driver);

		$f_vehicle_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_plate"
		,array(
		
			'alias'=>"гос.номер"
		,
			'length'=>10,
			'id'=>"vehicle_plate"
				
		
		));
		$this->addField($f_vehicle_plate);

		$f_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		'required'=>TRUE,
			'alias'=>"Материал"
		,
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_quant_gross=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_gross"
		,array(
		
			'alias'=>"Брутто"
		,
			'length'=>19,
			'id'=>"quant_gross"
				
		
		));
		$this->addField($f_quant_gross);

		$f_quant_net=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_net"
		,array(
		
			'alias'=>"Нетто"
		,
			'length'=>19,
			'id'=>"quant_net"
				
		
		));
		$this->addField($f_quant_net);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_date_time);

		
		
		
	}

}
?>
