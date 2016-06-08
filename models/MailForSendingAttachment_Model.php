<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class MailForSendingAttachment_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("mail_for_sending_attachments");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_mail_for_sending_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"mail_for_sending_id"
		,array(
		
			'id'=>"mail_for_sending_id"
				
		
		));
		$this->addField($f_mail_for_sending_id);

		$f_file_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"file_name"
		,array(
		
			'length'=>255,
			'id'=>"file_name"
				
		
		));
		$this->addField($f_file_name);

		
		
		
	}

}
?>
