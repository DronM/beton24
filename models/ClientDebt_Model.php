<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class ClientDebt_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_debts");
		
		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_debt=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"debt"
		,array(
		
			'length'=>15,
			'id'=>"debt"
				
		
		));
		$this->addField($f_debt);

		
		
		
	}

}
?>
