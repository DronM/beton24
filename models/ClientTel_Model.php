<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class ClientTel_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_tels");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'autoInc'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_name=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'alias'=>"ФИО"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		'required'=>TRUE,
			'alias'=>"Телефон"
		,
			'length'=>15,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_email=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"email"
		,array(
		'required'=>FALSE,
			'alias'=>"Эл.почта"
		,
			'length'=>50,
			'id'=>"email"
				
		
		));
		$this->addField($f_email);

		$f_post=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"post"
		,array(
		'required'=>FALSE,
			'alias'=>"Должность"
		,
			'length'=>50,
			'id'=>"post"
				
		
		));
		$this->addField($f_post);

		
		
		
	}

}
?>
