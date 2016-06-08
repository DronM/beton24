<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class TimeZoneLocale_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("time_zone_locales");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"descr"
		,array(
		'required'=>TRUE,
			'length'=>100,
			'id'=>"descr"
				
		
		));
		$this->addField($f_descr);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'length'=>50,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_hour_dif=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"hour_dif"
		,array(
		'required'=>TRUE,
			'id'=>"hour_dif"
				
		
		));
		$this->addField($f_hour_dif);

		
		
		
	}

}
?>
