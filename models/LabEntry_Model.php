<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class LabEntry_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("lab_entries");
		
		$f_shipment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipment_id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'alias'=>"Отгрузка"
		,
			'id'=>"shipment_id"
				
		
		));
		$this->addField($f_shipment_id);

		$f_samples=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"samples"
		,array(
		
			'alias'=>"Подборы"
		,
			'id'=>"samples"
				
		
		));
		$this->addField($f_samples);

		$f_materials=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"materials"
		,array(
		
			'alias'=>"Материалы"
		,
			'id'=>"materials"
				
		
		));
		$this->addField($f_materials);

		$f_ok2=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok2"
		,array(
		
			'alias'=>"OK2"
		,
			'id'=>"ok2"
				
		
		));
		$this->addField($f_ok2);

		$f_time=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"time"
		,array(
		
			'alias'=>"Время"
		,
			'id'=>"time"
				
		
		));
		$this->addField($f_time);

		
		
		
	}

}
?>
