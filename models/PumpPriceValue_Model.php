<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class PumpPriceValue_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("pump_prices_values");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_pump_price_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump_price_id"
		,array(
		
			'autoInc'=>TRUE,
			'id'=>"pump_price_id"
				
		
		));
		$this->addField($f_pump_price_id);

		$f_quant_from=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_from"
		,array(
		
			'length'=>19,
			'id'=>"quant_from"
				
		
		));
		$this->addField($f_quant_from);

		$f_quant_to=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_to"
		,array(
		
			'length'=>19,
			'id'=>"quant_to"
				
		
		));
		$this->addField($f_quant_to);

		$f_price_m=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"price_m"
		,array(
		
			'length'=>15,
			'id'=>"price_m"
				
		
		));
		$this->addField($f_price_m);

		$f_price_fixed=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"price_fixed"
		,array(
		
			'length'=>15,
			'id'=>"price_fixed"
				
		
		));
		$this->addField($f_price_fixed);

		
		
		
	}

}
?>
