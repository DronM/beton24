<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class SpecialistRequest_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("specialist_requests");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_name=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment"
		,array(
		
			'id'=>"comment"
				
		
		));
		$this->addField($f_comment);

		$f_tel=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_viewed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"viewed"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"viewed"
				
		
		));
		$this->addField($f_viewed);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_manager_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_comment"
		,array(
		
			'id'=>"manager_comment"
				
		
		));
		$this->addField($f_manager_comment);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_date_time);

		
		
		
	}

}
?>
