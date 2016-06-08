<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class ClientBank_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_banks");
		
		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"ID клиента"
		,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_bank_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"bank_id"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"ID банка"
		,
			'id'=>"bank_id"
				
		
		));
		$this->addField($f_bank_id);

		$f_account=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"account"
		,array(
		
			'alias'=>"Расчетный счет"
		,
			'length'=>20,
			'id'=>"account"
				
		
		));
		$this->addField($f_account);

		
		
		
	}

}
?>
