<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class SMSForSending_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("sms_for_sending");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'length'=>15,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_body=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"body"
		,array(
		
			'id'=>"body"
				
		
		));
		$this->addField($f_body);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'defaultValue'=>"current_timestamp"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_sent=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sent"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"sent"
				
		
		));
		$this->addField($f_sent);

		$f_sent_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sent_date_time"
		,array(
		
			'id'=>"sent_date_time"
				
		
		));
		$this->addField($f_sent_date_time);

		$f_delivered=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"delivered"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"delivered"
				
		
		));
		$this->addField($f_delivered);

		$f_delivered_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"delivered_date_time"
		,array(
		
			'id'=>"delivered_date_time"
				
		
		));
		$this->addField($f_delivered_date_time);

		$f_sms_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_type"
		,array(
		
			'id'=>"sms_type"
				
		
		));
		$this->addField($f_sms_type);

		$f_sms_id=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sms_id"
		,array(
		
			'id'=>"sms_id"
				
		
		));
		$this->addField($f_sms_id);

		
		
		
	}

}
?>
