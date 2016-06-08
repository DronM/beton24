<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class SiteFeedBackList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("site_feedbacks_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_date_time);

		$f_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_descr"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"date_time_descr"
				
		
		));
		$this->addField($f_date_time_descr);

		$f_name=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'alias'=>"ФИО"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"comment"
				
		
		));
		$this->addField($f_comment);

		$f_email=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email"
		,array(
		
			'alias'=>"Email"
		,
			'id'=>"email"
				
		
		));
		$this->addField($f_email);

		$f_viewed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"viewed"
		,array(
		
			'id'=>"viewed"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_viewed);

		$f_viewed_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"viewed_descr"
		,array(
		
			'alias'=>"Просмотрено"
		,
			'id'=>"viewed_descr"
				
		
		));
		$this->addField($f_viewed_descr);

		
		
		
	}

}
?>
