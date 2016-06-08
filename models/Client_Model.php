<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class Client_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("clients");
		
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

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'alias'=>"Наименование"
		,
			'length'=>100,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_name_full=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name_full"
		,array(
		
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

		$f_client_type_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_type_id"
		,array(
		
			'alias'=>"Вид контрагента"
		,
			'id'=>"client_type_id"
				
		
		));
		$this->addField($f_client_type_id);

		$f_client_kind=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_kind"
		,array(
		
			'alias'=>"Тип контрагента"
		,
			'id'=>"client_kind"
				
		
		));
		$this->addField($f_client_kind);

		$f_client_come_from_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_come_from_id"
		,array(
		
			'alias'=>"Источник обращения"
		,
			'id'=>"client_come_from_id"
				
		
		));
		$this->addField($f_client_come_from_id);

		$f_manager_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_id"
		,array(
		
			'alias'=>"Менеджер"
		,
			'id'=>"manager_id"
				
		
		));
		$this->addField($f_manager_id);

		$f_create_date=new FieldSQlDate($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"create_date"
		,array(
		
			'id'=>"create_date"
				
		
		));
		$this->addField($f_create_date);

		$f_inn=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"inn"
		,array(
		
			'alias'=>"ИНН"
		,
			'length'=>12,
			'id'=>"inn"
				
		
		));
		$this->addField($f_inn);

		$f_kpp=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"kpp"
		,array(
		
			'alias'=>"КПП"
		,
			'length'=>10,
			'id'=>"kpp"
				
		
		));
		$this->addField($f_kpp);

		$f_orgn=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"orgn"
		,array(
		
			'alias'=>"ОГРН"
		,
			'length'=>15,
			'id'=>"orgn"
				
		
		));
		$this->addField($f_orgn);

		$f_okpo=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"okpo"
		,array(
		
			'alias'=>"ОКПО"
		,
			'length'=>20,
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

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_name);

		
		
		
	}

}
?>
