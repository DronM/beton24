<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class OutComment_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("out_comments");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_vehicle_schedule_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_schedule_id"
		,array(
		'required'=>TRUE,
			'id'=>"vehicle_schedule_id"
				
		
		));
		$this->addField($f_vehicle_schedule_id);

		$f_comment_text=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment_text"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"comment_text"
				
		
		));
		$this->addField($f_comment_text);

		
		
		
	}

}
?>
