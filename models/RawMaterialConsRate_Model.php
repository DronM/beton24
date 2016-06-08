<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class RawMaterialConsRate_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("raw_material_cons_rates");
		
		$f_rate_date_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"rate_date_id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'id'=>"rate_date_id"
				
		
		));
		$this->addField($f_rate_date_id);

		$f_concrete_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Марка бетона"
		,
			'id'=>"concrete_type_id"
				
		
		));
		$this->addField($f_concrete_type_id);

		$f_raw_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"raw_material_id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Материал"
		,
			'id'=>"raw_material_id"
				
		
		));
		$this->addField($f_raw_material_id);

		$f_rate=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"rate"
		,array(
		
			'alias'=>"Расход"
		,
			'length'=>19,
			'id'=>"rate"
				
		
		));
		$this->addField($f_rate);

		
		
		
	}

}
?>
