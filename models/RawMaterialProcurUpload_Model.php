<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class RawMaterialProcurUpload_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("raw_material_procur_uploads");
		
		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_descr=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"descr"
		,array(
		
			'alias'=>"Описание ошибки"
		,
			'id'=>"descr"
				
		
		));
		$this->addField($f_descr);

		$f_result=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"result"
		,array(
		
			'alias'=>"Результат"
		,
			'id'=>"result"
				
		
		));
		$this->addField($f_result);

		$f_doc_count=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"doc_count"
		,array(
		
			'alias'=>"Кол-во документов"
		,
			'id'=>"doc_count"
				
		
		));
		$this->addField($f_doc_count);

		
		
		
	}

}
?>
