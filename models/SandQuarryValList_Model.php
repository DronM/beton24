<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');

class SandQuarryValList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("sand_quarry_vals_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_day=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day"
		,array(
		
			'id'=>"day"
				
		
		));
		$this->addField($f_day);

		$f_day_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"day_descr"
		,array(
		
			'id'=>"day_descr"
				
		
		));
		$this->addField($f_day_descr);

		$f_quarry_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quarry_id"
		,array(
		
			'id'=>"quarry_id"
				
		
		));
		$this->addField($f_quarry_id);

		$f_quarry_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quarry_descr"
		,array(
		
			'id'=>"quarry_descr"
				
		
		));
		$this->addField($f_quarry_descr);

		$f_v_mkr=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_mkr"
		,array(
		
			'length'=>15,
			'id'=>"v_mkr"
				
		
		));
		$this->addField($f_v_mkr);

		$f_v_2_5=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_2_5"
		,array(
		
			'length'=>15,
			'id'=>"v_2_5"
				
		
		));
		$this->addField($f_v_2_5);

		$f_v_1_25=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_1_25"
		,array(
		
			'length'=>15,
			'id'=>"v_1_25"
				
		
		));
		$this->addField($f_v_1_25);

		$f_v_0_63=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_0_63"
		,array(
		
			'length'=>15,
			'id'=>"v_0_63"
				
		
		));
		$this->addField($f_v_0_63);

		$f_v_0_16=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_0_16"
		,array(
		
			'length'=>15,
			'id'=>"v_0_16"
				
		
		));
		$this->addField($f_v_0_16);

		$f_v_0_05=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_0_05"
		,array(
		
			'length'=>15,
			'id'=>"v_0_05"
				
		
		));
		$this->addField($f_v_0_05);

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

		$f_v_humid=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_humid"
		,array(
		
			'length'=>15,
			'id'=>"v_humid"
				
		
		));
		$this->addField($f_v_humid);

		$f_v_dust=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"v_dust"
		,array(
		
			'length'=>15,
			'id'=>"v_dust"
				
		
		));
		$this->addField($f_v_dust);

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

		
		
		
	}

}
?>
