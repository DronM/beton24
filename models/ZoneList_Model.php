<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class ZoneList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("");
		
		$f_vehicle_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_id"
		,array(
		
			'id'=>"vehicle_id"
				
		
		));
		$this->addField($f_vehicle_id);

		$f_destination_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_id"
		,array(
		
			'id'=>"destination_id"
				
		
		));
		$this->addField($f_destination_id);

		$f_destination_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"destination_descr"
		,array(
		
			'id'=>"destination_descr"
				
		
		));
		$this->addField($f_destination_descr);

		$f_zone_str=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"zone_str"
		,array(
		
			'id'=>"zone_str"
				
		
		));
		$this->addField($f_zone_str);

		$f_zone_center_str=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"zone_center_str"
		,array(
		
			'id'=>"zone_center_str"
				
		
		));
		$this->addField($f_zone_center_str);

		$f_is_base=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"is_base"
		,array(
		
			'id'=>"is_base"
				
		
		));
		$this->addField($f_is_base);

		
		
		
	}

}
?>
