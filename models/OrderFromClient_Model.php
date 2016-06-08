<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class OrderFromClient_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("orders_from_clients");
		
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

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'length'=>15,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_concrete_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type"
		,array(
		
			'length'=>15,
			'id'=>"concrete_type"
				
		
		));
		$this->addField($f_concrete_type);

		$f_dest=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"dest"
		,array(
		
			'id'=>"dest"
				
		
		));
		$this->addField($f_dest);

		$f_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total"
		,array(
		
			'length'=>15,
			'id'=>"total"
				
		
		));
		$this->addField($f_total);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'length'=>15,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_pump=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump"
		,array(
		
			'defaultValue'=>"false"
		,
			'id'=>"pump"
				
		
		));
		$this->addField($f_pump);

		$f_comment_text=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment_text"
		,array(
		
			'id'=>"comment_text"
				
		
		));
		$this->addField($f_comment_text);

		$f_closed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"closed"
		,array(
		
			'id'=>"closed"
				
		
		));
		$this->addField($f_closed);

		$f_viewed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"viewed"
		,array(
		
			'id'=>"viewed"
				
		
		));
		$this->addField($f_viewed);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_id);

		
		
		
	}

}
?>
