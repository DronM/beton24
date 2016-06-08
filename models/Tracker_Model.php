<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class Tracker_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("trackers");
		
		$f_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'alias'=>"Код"
		,
			'length'=>15,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_sim_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sim_id"
		,array(
		
			'alias'=>"Идентификатор SIM карты"
		,
			'length'=>50,
			'id'=>"sim_id"
				
		
		));
		$this->addField($f_sim_id);

		$f_sim_number=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sim_number"
		,array(
		
			'alias'=>"Номер SIM карты"
		,
			'length'=>10,
			'id'=>"sim_number"
				
		
		));
		$this->addField($f_sim_number);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_id);

		
		
		
	}

}
?>
