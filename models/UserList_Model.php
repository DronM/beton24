<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class UserList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("user_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_role_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"role_descr"
		,array(
		
			'id'=>"role_descr"
				
		
		));
		$this->addField($f_role_descr);

		$f_ext_num=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ext_num"
		,array(
		
			'id'=>"ext_num"
				
		
		));
		$this->addField($f_ext_num);

		
		
		
	}

}
?>
