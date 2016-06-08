<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class PlantLoadChart_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("widget_plant_load_charts");
		
		$f_date_time_from=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_from"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'id'=>"date_time_from"
				
		
		));
		$this->addField($f_date_time_from);

		$f_date_time_to=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_to"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'id'=>"date_time_to"
				
		
		));
		$this->addField($f_date_time_to);

		$f_times=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"times"
		,array(
		
			'id'=>"times"
				
		
		));
		$this->addField($f_times);

		$f_orders=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"orders"
		,array(
		
			'id'=>"orders"
				
		
		));
		$this->addField($f_orders);

		$f_shipments=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipments"
		,array(
		
			'id'=>"shipments"
				
		
		));
		$this->addField($f_shipments);

		$f_norms=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"norms"
		,array(
		
			'id'=>"norms"
				
		
		));
		$this->addField($f_norms);

		$f_veh_counts=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"veh_counts"
		,array(
		
			'id'=>"veh_counts"
				
		
		));
		$this->addField($f_veh_counts);

		$f_state=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"state"
		,array(
		
			'id'=>"state"
				
		
		));
		$this->addField($f_state);

		
		
		
	}

}
?>
