<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class ConstantList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("constants_list_view");
		
		$f_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'length'=>50,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_descr=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"descr"
		,array(
		'required'=>TRUE,
			'id'=>"descr"
				
		
		));
		$this->addField($f_descr);

		$f_val=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"val"
		,array(
		'required'=>TRUE,
			'id'=>"val"
				
		
		));
		$this->addField($f_val);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_id);

		
		
		
	}

}
?>
