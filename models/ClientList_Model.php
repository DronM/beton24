<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class ClientList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'alias'=>"Наименование"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_manager_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_comment"
		,array(
		
			'alias'=>"Комметарий менеджера"
		,
			'id'=>"manager_comment"
				
		
		));
		$this->addField($f_manager_comment);

		$f_client_type_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_id"
		,array(
		
			'id'=>"client_type_id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_client_type_id);

		$f_client_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_descr"
		,array(
		
			'alias'=>"Тип клиента"
		,
			'id'=>"client_type_descr"
				
		
		));
		$this->addField($f_client_type_descr);

		$f_client_come_from_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_id"
		,array(
		
			'id'=>"client_come_from_id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_client_come_from_id);

		$f_client_come_from_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_descr"
		,array(
		
			'id'=>"client_come_from_descr"
				
		
		));
		$this->addField($f_client_come_from_descr);

		$f_client_kind=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_kind"
		,array(
		
			'alias'=>"Вид клиента"
		,
			'id'=>"client_kind"
				
		
		));
		$this->addField($f_client_kind);

		$f_manager_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_id"
		,array(
		
			'id'=>"manager_id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_manager_id);

		$f_manager_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_descr"
		,array(
		
			'alias'=>"Менеджер"
		,
			'id'=>"manager_descr"
				
		
		));
		$this->addField($f_manager_descr);

		$f_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_name"
		,array(
		
			'alias'=>"Параметр телефон"
		,
			'id'=>"tel_name"
				
		
		));
		$this->addField($f_tel_name);

		$f_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_value"
		,array(
		
			'alias'=>"Значение параметра телефон"
		,
			'id'=>"tel_value"
				
		
		));
		$this->addField($f_tel_value);

		$f_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_name"
		,array(
		
			'alias'=>"Параметр эл.почта"
		,
			'id'=>"email_name"
				
		
		));
		$this->addField($f_email_name);

		$f_email_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_value"
		,array(
		
			'alias'=>"Значение параметра эл.почты"
		,
			'id'=>"email_value"
				
		
		));
		$this->addField($f_email_value);

		
		
		
	}

}
?>
