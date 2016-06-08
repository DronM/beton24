<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class MaterialObnul_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("materials_obnuls");
		
		$f_day=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"day"
				
		
		));
		$this->addField($f_day);

		$f_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'length'=>19,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_day);

		
		
		
	}

}
?>
