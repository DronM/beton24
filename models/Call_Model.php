<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class Call_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("calls");
		
		$f_unique_id=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unique_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"unique_id"
				
		
		));
		$this->addField($f_unique_id);

		$f_caller_id_num=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"caller_id_num"
		,array(
		
			'length'=>15,
			'id'=>"caller_id_num"
				
		
		));
		$this->addField($f_caller_id_num);

		$f_ext=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ext"
		,array(
		
			'length'=>15,
			'id'=>"ext"
				
		
		));
		$this->addField($f_ext);

		$f_start_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"start_time"
		,array(
		
			'id'=>"start_time"
				
		
		));
		$this->addField($f_start_time);

		$f_end_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"end_time"
		,array(
		
			'id'=>"end_time"
				
		
		));
		$this->addField($f_end_time);

		$f_client_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_user_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id"
		,array(
		
			'id'=>"user_id"
				
		
		));
		$this->addField($f_user_id);

		$f_call_type=new FieldSQlEnum($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"call_type"
		,array(
		
			'id'=>"call_type"
				
		
		));
		$this->addField($f_call_type);

		$f_user_id_to=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"user_id_to"
		,array(
		
			'id'=>"user_id_to"
				
		
		));
		$this->addField($f_user_id_to);

		$f_answer_unique_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"answer_unique_id"
		,array(
		
			'id'=>"answer_unique_id"
				
		
		));
		$this->addField($f_answer_unique_id);

		$f_dt=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"dt"
		,array(
		
			'id'=>"dt"
				
		
		));
		$this->addField($f_dt);

		$f_manager_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"manager_comment"
		,array(
		
			'id'=>"manager_comment"
				
		
		));
		$this->addField($f_manager_comment);

		$f_informed=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"informed"
		,array(
		
			'id'=>"informed"
				
		
		));
		$this->addField($f_informed);

		$f_create_date=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"create_date"
		,array(
		
			'id'=>"create_date"
				
		
		));
		$this->addField($f_create_date);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_contact_detail_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_id"
		,array(
		
			'id'=>"contact_detail_id"
				
		
		));
		$this->addField($f_contact_detail_id);

		
		
		
	}

}
?>
