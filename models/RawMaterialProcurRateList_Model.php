<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class RawMaterialProcurRateList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("raw_material_procur_rates_view");
		
		$f_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_material_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_descr"
		,array(
		
			'id'=>"material_descr"
				
		
		));
		$this->addField($f_material_descr);

		$f_supplier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"supplier_id"
				
		
		));
		$this->addField($f_supplier_id);

		$f_supplier_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_descr"
		,array(
		
			'id'=>"supplier_descr"
				
		
		));
		$this->addField($f_supplier_descr);

		$f_rate=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"rate"
		,array(
		
			'id'=>"rate"
				
		
		));
		$this->addField($f_rate);

		
		
		
	}

}
?>
