<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class RawMaterialConsRateDateList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("raw_material_cons_rates_dates_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_id);

		$f_dt=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"dt"
		,array(
		
			'id'=>"dt"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_dt);

		$f_period=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"period"
		,array(
		
			'alias'=>"Период"
		,
			'id'=>"period"
				
		
		));
		$this->addField($f_period);

		$f_name=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		
		
		
	}

}
?>
