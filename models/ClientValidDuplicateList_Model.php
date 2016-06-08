<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class ClientValidDuplicateList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("client_valid_duplicates_list");
		
		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"client_id"
		,
			'sysCol'=>TRUE
				
		
		));
		$this->addField($f_client_id);

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'primaryKey'=>TRUE,
			'alias'=>"Телефон"
		,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'alias'=>"Клиент"
		,
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		
		
		
	}

}
?>
