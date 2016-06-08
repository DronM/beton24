<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class RawMaterialProcurRate_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("raw_material_procur_rates");
		
		$f_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_supplier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'id'=>"supplier_id"
				
		
		));
		$this->addField($f_supplier_id);

		$f_rate=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"rate"
		,array(
		
			'length'=>19,
			'id'=>"rate"
				
		
		));
		$this->addField($f_rate);

		
		
		
	}

}
?>
