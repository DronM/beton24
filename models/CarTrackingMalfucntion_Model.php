<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class CarTrackingMalfucntion_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("car_tracking_malfucntions");
		
		$f_dt=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"dt"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"dt"
				
		
		));
		$this->addField($f_dt);

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'primaryKey'=>TRUE,
			'length'=>15,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_tracker_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tracker_id"
		,array(
		
			'primaryKey'=>TRUE,
			'length'=>15,
			'id'=>"tracker_id"
				
		
		));
		$this->addField($f_tracker_id);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_dt);

		
		
		
	}

}
?>
