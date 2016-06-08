<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class ClientDialog_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_dialog");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>FALSE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
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

		$f_manager_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_comment"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"manager_comment"
				
		
		));
		$this->addField($f_manager_comment);

		$f_phone_cel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"phone_cel"
		,array(
		
			'id'=>"phone_cel"
				
		
		));
		$this->addField($f_phone_cel);

		$f_quant=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_client_type_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_id"
		,array(
		
			'id'=>"client_type_id"
				
		
		));
		$this->addField($f_client_type_id);

		$f_client_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_descr"
		,array(
		
			'id'=>"client_type_descr"
				
		
		));
		$this->addField($f_client_type_descr);

		$f_client_come_from_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_id"
		,array(
		
			'id'=>"client_come_from_id"
				
		
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
		
			'id'=>"client_kind"
				
		
		));
		$this->addField($f_client_kind);

		$f_manager_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_id"
		,array(
		
			'id'=>"manager_id"
				
		
		));
		$this->addField($f_manager_id);

		$f_manager_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_descr"
		,array(
		
			'id'=>"manager_descr"
				
		
		));
		$this->addField($f_manager_descr);

		$f_contact_first_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_first_name"
		,array(
		
			'id'=>"contact_first_name"
				
		
		));
		$this->addField($f_contact_first_name);

		$f_contact_middle_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_middle_name"
		,array(
		
			'id'=>"contact_middle_name"
				
		
		));
		$this->addField($f_contact_middle_name);

		$f_contact_last_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_last_name"
		,array(
		
			'id'=>"contact_last_name"
				
		
		));
		$this->addField($f_contact_last_name);

		$f_contact_post=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_post"
		,array(
		
			'id'=>"contact_post"
				
		
		));
		$this->addField($f_contact_post);

		$f_contact_description=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_description"
		,array(
		
			'id'=>"contact_description"
				
		
		));
		$this->addField($f_contact_description);

		$f_tel_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_name"
		,array(
		
			'id'=>"tel_name"
				
		
		));
		$this->addField($f_tel_name);

		$f_tel_value=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_value"
		,array(
		
			'id'=>"tel_value"
				
		
		));
		$this->addField($f_tel_value);

		$f_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_name"
		,array(
		
			'id'=>"email_name"
				
		
		));
		$this->addField($f_email_name);

		$f_email_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email_name"
		,array(
		
			'id'=>"email_name"
				
		
		));
		$this->addField($f_email_name);

		$f_inn=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"inn"
		,array(
		
			'alias'=>"ИНН"
		,
			'id'=>"inn"
				
		
		));
		$this->addField($f_inn);

		$f_kpp=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"kpp"
		,array(
		
			'alias'=>"КПП"
		,
			'id'=>"kpp"
				
		
		));
		$this->addField($f_kpp);

		$f_orgn=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"orgn"
		,array(
		
			'alias'=>"ОГРН"
		,
			'id'=>"orgn"
				
		
		));
		$this->addField($f_orgn);

		$f_okpo=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"okpo"
		,array(
		
			'alias'=>"ОКПО"
		,
			'id'=>"okpo"
				
		
		));
		$this->addField($f_okpo);

		$f_address_reg=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"address_reg"
		,array(
		
			'alias'=>"Адрес регистрации"
		,
			'id'=>"address_reg"
				
		
		));
		$this->addField($f_address_reg);

		$f_address_fact=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"address_fact"
		,array(
		
			'alias'=>"Адрес фактический"
		,
			'id'=>"address_fact"
				
		
		));
		$this->addField($f_address_fact);

		$f_address_post=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"address_post"
		,array(
		
			'alias'=>"Адрес почтовый"
		,
			'id'=>"address_post"
				
		
		));
		$this->addField($f_address_post);

		
		
		
	}

}
?>
