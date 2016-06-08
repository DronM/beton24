<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class ClientContact_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_contacts");
		
		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_main=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"main"
		,array(
		
			'defaultValue'=>"FALSE"
		,
			'id'=>"main"
				
		
		));
		$this->addField($f_main);

		
		
		
	}

}
?>
