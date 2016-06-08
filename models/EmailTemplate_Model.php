<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class EmailTemplate_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("email_templates");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_email_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_type"
		,array(
		'required'=>TRUE,
			'primaryKey'=>FALSE,
			'autoInc'=>FALSE,
			'alias'=>"Тип email"
		,
			'id'=>"email_type"
				
		
		));
		$this->addField($f_email_type);

		$f_template=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"template"
		,array(
		'required'=>TRUE,
			'alias'=>"Шаблон"
		,
			'id'=>"template"
				
		
		));
		$this->addField($f_template);

		$f_comment_text=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment_text"
		,array(
		'required'=>TRUE,
			'alias'=>"Комментарий"
		,
			'id'=>"comment_text"
				
		
		));
		$this->addField($f_comment_text);

		$f_mes_subject=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"mes_subject"
		,array(
		'required'=>TRUE,
			'alias'=>"Тема"
		,
			'id'=>"mes_subject"
				
		
		));
		$this->addField($f_mes_subject);

		$f_fields=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"fields"
		,array(
		'required'=>TRUE,
			'alias'=>"Поля"
		,
			'id'=>"fields"
				
		
		));
		$this->addField($f_fields);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_email_type);

		
		
		
	}

}
?>
