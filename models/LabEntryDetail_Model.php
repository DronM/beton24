<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');

class LabEntryDetail_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("lab_entry_details");
		
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

		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_ok=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok"
		,array(
		
			'alias'=>"ОК"
		,
			'id'=>"ok"
				
		
		));
		$this->addField($f_ok);

		$f_weight=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight"
		,array(
		
			'alias'=>"Масса"
		,
			'id'=>"weight"
				
		
		));
		$this->addField($f_weight);

		$f_kn=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"kn"
		,array(
		
			'alias'=>"КН"
		,
			'id'=>"kn"
				
		
		));
		$this->addField($f_kn);

		
		
		
	}

}
?>
