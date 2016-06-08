<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class RAMaterialConsumptionList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("ra_material_consumption_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_descr"
		,array(
		
			'id'=>"date_time_descr"
				
		
		));
		$this->addField($f_date_time_descr);

		$f_concrete_type_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_vehicle_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_vehicle_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_descr"
		,array(
		
			'id'=>"vehicle_descr"
				
		
		));
		$this->addField($f_vehicle_descr);

		$f_driver_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_id"
		,array(
		
			'id'=>"driver_id"
				
		
		));
		$this->addField($f_driver_id);

		$f_driver_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver_descr"
		,array(
		
			'id'=>"driver_descr"
				
		
		));
		$this->addField($f_driver_descr);

		$f_material_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_material_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_descr"
		,array(
		
			'id'=>"material_descr"
				
		
		));
		$this->addField($f_material_descr);

		$f_material_quant=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_quant"
		,array(
		
			'id'=>"material_quant"
				
		
		));
		$this->addField($f_material_quant);

		$f_concrete_quant=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_quant"
		,array(
		
			'id'=>"concrete_quant"
				
		
		));
		$this->addField($f_concrete_quant);

		
		
		
	}

}
?>
