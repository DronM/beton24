<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class VehicleFeatureList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("vehicle_feature_list_view");
		
		$f_feature=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"feature"
		,array(
		
			'id'=>"feature"
				
		
		));
		$this->addField($f_feature);

		
		
		
	}

}
?>
