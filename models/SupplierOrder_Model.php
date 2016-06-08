<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class SupplierOrder_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("supplier_orders");
		
		$f_date=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"date"
				
		
		));
		$this->addField($f_date);

		$f_supplier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"supplier_id"
				
		
		));
		$this->addField($f_supplier_id);

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
		
			'length'=>15,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_vehicles=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicles"
		,array(
		
			'id'=>"vehicles"
				
		
		));
		$this->addField($f_vehicles);

		$f_sms_id=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_id"
		,array(
		
			'id'=>"sms_id"
				
		
		));
		$this->addField($f_sms_id);

		$f_sms_confirmed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_confirmed"
		,array(
		
			'id'=>"sms_confirmed"
				
		
		));
		$this->addField($f_sms_confirmed);

		
		
		
	}

}
?>
