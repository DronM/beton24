<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class MailForSending_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("mail_for_sending");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'defaultValue'=>"current_timestamp"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_from_addr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"from_addr"
		,array(
		
			'length'=>50,
			'id'=>"from_addr"
				
		
		));
		$this->addField($f_from_addr);

		$f_from_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"from_name"
		,array(
		
			'length'=>255,
			'id'=>"from_name"
				
		
		));
		$this->addField($f_from_name);

		$f_to_addr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"to_addr"
		,array(
		
			'length'=>50,
			'id'=>"to_addr"
				
		
		));
		$this->addField($f_to_addr);

		$f_to_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"to_name"
		,array(
		
			'length'=>255,
			'id'=>"to_name"
				
		
		));
		$this->addField($f_to_name);

		$f_reply_addr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"reply_addr"
		,array(
		
			'length'=>50,
			'id'=>"reply_addr"
				
		
		));
		$this->addField($f_reply_addr);

		$f_reply_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"reply_name"
		,array(
		
			'length'=>255,
			'id'=>"reply_name"
				
		
		));
		$this->addField($f_reply_name);

		$f_body=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"body"
		,array(
		
			'id'=>"body"
				
		
		));
		$this->addField($f_body);

		$f_sender_addr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sender_addr"
		,array(
		
			'length'=>50,
			'id'=>"sender_addr"
				
		
		));
		$this->addField($f_sender_addr);

		$f_subject=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"subject"
		,array(
		
			'length'=>255,
			'id'=>"subject"
				
		
		));
		$this->addField($f_subject);

		$f_sent=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"sent"
		,array(
		
			'defaultValue'=>"false"
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

		$f_email_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_type"
		,array(
		
			'id'=>"email_type"
				
		
		));
		$this->addField($f_email_type);

		
		
		
	}

}
?>
