<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class UIStorage_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("ui_storages");
		
		$f_ui_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ui_id"
		,array(
		
			'primaryKey'=>TRUE,
			'length'=>50,
			'id'=>"ui_id"
				
		
		));
		$this->addField($f_ui_id);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_data=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"data"
		,array(
		
			'id'=>"data"
				
		
		));
		$this->addField($f_data);

		
		
		
	}

}
?>
