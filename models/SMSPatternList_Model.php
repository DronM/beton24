<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class SMSPatternList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("sms_patterns_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_sms_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_type"
		,array(
		
			'id'=>"sms_type"
				
		
		));
		$this->addField($f_sms_type);

		$f_sms_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_type_descr"
		,array(
		
			'id'=>"sms_type_descr"
				
		
		));
		$this->addField($f_sms_type_descr);

		$f_lang_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lang_descr"
		,array(
		
			'id'=>"lang_descr"
				
		
		));
		$this->addField($f_lang_descr);

		$f_lang_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lang_id"
		,array(
		
			'id'=>"lang_id"
				
		
		));
		$this->addField($f_lang_id);

		$f_pattern=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pattern"
		,array(
		
			'id'=>"pattern"
				
		
		));
		$this->addField($f_pattern);

		
		
		
	}

}
?>
