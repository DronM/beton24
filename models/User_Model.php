<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLPassword.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelOrderSQL.php');

class User_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("users");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		'required'=>TRUE,
			'length'=>50,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_role_id=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"role_id"
		,array(
		'required'=>TRUE,
			'id'=>"role_id"
				
		
		));
		$this->addField($f_role_id);

		$f_email=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email"
		,array(
		'required'=>FALSE,
			'length'=>50,
			'id'=>"email"
				
		
		));
		$this->addField($f_email);

		$f_pwd=new FieldSQlPassword($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pwd"
		,array(
		
			'length'=>32,
			'id'=>"pwd"
				
		
		));
		$this->addField($f_pwd);

		$f_tel_ext=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_ext"
		,array(
		
			'length'=>5,
			'id'=>"tel_ext"
				
		
		));
		$this->addField($f_tel_ext);

		$f_phone_cel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"phone_cel"
		,array(
		
			'length'=>15,
			'id'=>"phone_cel"
				
		
		));
		$this->addField($f_phone_cel);

		$f_time_zone_locale_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"time_zone_locale_id"
		,array(
		
			'id'=>"time_zone_locale_id"
				
		
		));
		$this->addField($f_time_zone_locale_id);

		$order = new ModelOrderSQL();		
		$this->setDefaultModelOrder($order);		
		
		$order->addField($f_name);

		
		
		
	}

}
?>
