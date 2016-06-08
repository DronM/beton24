<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class UserDialog_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("user_view");
		
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
		
			'alias'=>"Имя"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_email=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email"
		,array(
		
			'alias'=>"Эл.почта"
		,
			'id'=>"email"
				
		
		));
		$this->addField($f_email);

		$f_role_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"role_descr"
		,array(
		
			'id'=>"role_descr"
				
		
		));
		$this->addField($f_role_descr);

		$f_role_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"role_id"
		,array(
		
			'id'=>"role_id"
				
		
		));
		$this->addField($f_role_id);

		$f_phone_cel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"phone_cel"
		,array(
		
			'id'=>"phone_cel"
				
		
		));
		$this->addField($f_phone_cel);

		
		
		
	}

}
?>
