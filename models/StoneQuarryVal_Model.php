<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class StoneQuarryVal_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("stone_quarry_vals");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_day=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day"
		,array(
		
			'id'=>"day"
				
		
		));
		$this->addField($f_day);

		$f_quarry_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quarry_id"
		,array(
		
			'id'=>"quarry_id"
				
		
		));
		$this->addField($f_quarry_id);

		$f_v_nasip=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_nasip"
		,array(
		
			'length'=>15,
			'id'=>"v_nasip"
				
		
		));
		$this->addField($f_v_nasip);

		$f_v_istin=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_istin"
		,array(
		
			'length'=>15,
			'id'=>"v_istin"
				
		
		));
		$this->addField($f_v_istin);

		$f_v_dust=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_dust"
		,array(
		
			'length'=>15,
			'id'=>"v_dust"
				
		
		));
		$this->addField($f_v_dust);

		$f_v_humid=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_humid"
		,array(
		
			'length'=>15,
			'id'=>"v_humid"
				
		
		));
		$this->addField($f_v_humid);

		$f_v_void=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_void"
		,array(
		
			'length'=>15,
			'id'=>"v_void"
				
		
		));
		$this->addField($f_v_void);

		$f_v_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_comment"
		,array(
		
			'id'=>"v_comment"
				
		
		));
		$this->addField($f_v_comment);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_day);

		
		
		
	}

}
?>
