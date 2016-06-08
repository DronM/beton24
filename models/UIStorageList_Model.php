<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class UIStorageList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("");
		
		$f_ui_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ui_id"
		,array(
		
			'id'=>"ui_id"
				
		
		));
		$this->addField($f_ui_id);

		$f_data=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"data"
		,array(
		
			'id'=>"data"
				
		
		));
		$this->addField($f_data);

		
		
		
	}

}
?>
