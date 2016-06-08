<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class SMSPattern_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("sms_patterns");
		
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

		$f_lang_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lang_id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>FALSE,
			'autoInc'=>FALSE,
			'alias'=>"Язык"
		,
			'id'=>"lang_id"
				
		
		));
		$this->addField($f_lang_id);

		$f_sms_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_type"
		,array(
		'required'=>TRUE,
			'primaryKey'=>FALSE,
			'autoInc'=>FALSE,
			'alias'=>"Тип SMS"
		,
			'id'=>"sms_type"
				
		
		));
		$this->addField($f_sms_type);

		$f_pattern=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pattern"
		,array(
		'required'=>TRUE,
			'alias'=>"Шаблон"
		,
			'id'=>"pattern"
				
		
		));
		$this->addField($f_pattern);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_id);

		
		
		
	}

}
?>
