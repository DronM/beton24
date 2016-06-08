<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class OrderPump_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("order_pumps");
		
		$f_order_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"order_id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'id'=>"order_id"
				
		
		));
		$this->addField($f_order_id);

		$f_viewed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"viewed"
		,array(
		
			'defaultValue'=>"TRUE"
		,
			'id'=>"viewed"
				
		
		));
		$this->addField($f_viewed);

		$f_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment"
		,array(
		
			'id'=>"comment"
				
		
		));
		$this->addField($f_comment);

		
		
		
	}

}
?>
