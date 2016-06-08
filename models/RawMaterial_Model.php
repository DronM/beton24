<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class RawMaterial_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("raw_materials");
		
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

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'alias'=>"Наименование"
		,
			'length'=>100,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_planned_procurement=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"planned_procurement"
		,array(
		
			'alias'=>"Плановый приход"
		,
			'length'=>19,
			'id'=>"planned_procurement"
				
		
		));
		$this->addField($f_planned_procurement);

		$f_supply_days_count=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supply_days_count"
		,array(
		
			'alias'=>"Дней завоза"
		,
			'id'=>"supply_days_count"
				
		
		));
		$this->addField($f_supply_days_count);

		$f_concrete_part=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_part"
		,array(
		
			'defaultValue'=>"'false'"
		,
			'id'=>"concrete_part"
				
		
		));
		$this->addField($f_concrete_part);

		$f_ord=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ord"
		,array(
		'required'=>TRUE,
			'id'=>"ord"
				
		
		));
		$this->addField($f_ord);

		$f_supply_volume=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supply_volume"
		,array(
		
			'alias'=>"Объем ТС завоза"
		,
			'id'=>"supply_volume"
				
		
		));
		$this->addField($f_supply_volume);

		$f_store_days=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"store_days"
		,array(
		
			'id'=>"store_days"
				
		
		));
		$this->addField($f_store_days);

		$f_min_end_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"min_end_quant"
		,array(
		
			'length'=>19,
			'id'=>"min_end_quant"
				
		
		));
		$this->addField($f_min_end_quant);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_ord);

		
		
		
	}

}
?>
