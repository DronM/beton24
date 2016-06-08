<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');

class ShipmentTimeNorm_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("shipment_time_norms");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'alias'=>"Объем"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_norm_min=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"norm_min"
		,array(
		'required'=>TRUE,
			'alias'=>"Норма минут"
		,
			'id'=>"norm_min"
				
		
		));
		$this->addField($f_norm_min);

		
		
		
	}

}
?>
