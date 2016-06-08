<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class Supplier_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("suppliers");
		
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

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'alias'=>"Наименование"
		,
			'length'=>100,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_name_full=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name_full"
		,array(
		'required'=>TRUE,
			'alias'=>"Полное наименование"
		,
			'id'=>"name_full"
				
		
		));
		$this->addField($f_name_full);

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'alias'=>"Мобильный телефон"
		,
			'length'=>15,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_tel2=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel2"
		,array(
		
			'alias'=>"Мобильный телефон"
		,
			'length'=>15,
			'id'=>"tel2"
				
		
		));
		$this->addField($f_tel2);

		$f_lang_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lang_id"
		,array(
		'required'=>FALSE,
			'id'=>"lang_id"
				
		
		));
		$this->addField($f_lang_id);

		$f_ext_ref_scales=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ext_ref_scales"
		,array(
		
			'length'=>36,
			'id'=>"ext_ref_scales"
				
		
		));
		$this->addField($f_ext_ref_scales);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_name);

		
		
		
	}

}
?>
