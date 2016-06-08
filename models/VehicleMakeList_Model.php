<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class VehicleMakeList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_make_list_view");
		
		$f_make=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"make"
		,array(
		
			'id'=>"make"
				
		
		));
		$this->addField($f_make);

		
		
		
	}

}
?>
