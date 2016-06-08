<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class RAMaterialConsumption_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("ra_material_consumption");
		
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

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_doc_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"doc_type"
		,array(
		
			'alias'=>"Вид документа"
		,
			'id'=>"doc_type"
				
		
		));
		$this->addField($f_doc_type);

		$f_doc_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"doc_id"
		,array(
		
			'id'=>"doc_id"
				
		
		));
		$this->addField($f_doc_id);

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'alias'=>"Бетон"
		,
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'alias'=>"ТС"
		,
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_driver_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'alias'=>"Водитель"
		,
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		
			'alias'=>"Материал"
		,
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_concrete_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_quant"
		,array(
		
			'alias'=>"Количество бетона"
		,
			'length'=>19,
			'id'=>"concrete_quant"
				
		
		));
		$this->addField($f_concrete_quant);

		$f_material_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_quant"
		,array(
		
			'alias'=>"Количество материалов"
		,
			'length'=>19,
			'id'=>"material_quant"
				
		
		));
		$this->addField($f_material_quant);

		$f_material_quant_norm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_quant_norm"
		,array(
		
			'alias'=>"Количество материалов"
		,
			'length'=>19,
			'id'=>"material_quant_norm"
				
		
		));
		$this->addField($f_material_quant_norm);

		$f_material_quant_corrected=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_quant_corrected"
		,array(
		
			'alias'=>"Количество материалов"
		,
			'length'=>19,
			'id'=>"material_quant_corrected"
				
		
		));
		$this->addField($f_material_quant_corrected);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_date_time);

		
		
		
	}

}
?>
