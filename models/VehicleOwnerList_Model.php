<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class VehicleOwnerList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_owner_list_view");
		
		$f_owner=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"owner"
		,array(
		
			'id'=>"owner"
				
		
		));
		$this->addField($f_owner);

		
		
		
	}

}
?>
