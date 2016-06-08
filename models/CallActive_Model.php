<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');

class CallActive_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("calls_active");
		
		$f_unique_id=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"unique_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"unique_id"
				
		
		));
		$this->addField($f_unique_id);

		$f_call_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"call_type"
		,array(
		
			'id'=>"call_type"
				
		
		));
		$this->addField($f_call_type);

		$f_ext=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ext"
		,array(
		
			'id'=>"ext"
				
		
		));
		$this->addField($f_ext);

		$f_caller_id_num=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"caller_id_num"
		,array(
		
			'id'=>"caller_id_num"
				
		
		));
		$this->addField($f_caller_id_num);

		$f_ring_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ring_time"
		,array(
		
			'id'=>"ring_time"
				
		
		));
		$this->addField($f_ring_time);

		$f_answer_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"answer_time"
		,array(
		
			'id'=>"answer_time"
				
		
		));
		$this->addField($f_answer_time);

		$f_hangup_time=new FieldSQlDateTimeTZ($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"hangup_time"
		,array(
		
			'id'=>"hangup_time"
				
		
		));
		$this->addField($f_hangup_time);

		$f_contact_detail_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_id"
		,array(
		
			'id'=>"contact_detail_id"
				
		
		));
		$this->addField($f_contact_detail_id);

		$f_contact_detail_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_detail_name"
		,array(
		
			'id'=>"contact_detail_name"
				
		
		));
		$this->addField($f_contact_detail_name);

		$f_contact_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_id"
		,array(
		
			'id'=>"contact_id"
				
		
		));
		$this->addField($f_contact_id);

		$f_contact_post=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_post"
		,array(
		
			'id'=>"contact_post"
				
		
		));
		$this->addField($f_contact_post);

		$f_contact_last_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_last_name"
		,array(
		
			'id'=>"contact_last_name"
				
		
		));
		$this->addField($f_contact_last_name);

		$f_contact_first_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_first_name"
		,array(
		
			'id'=>"contact_first_name"
				
		
		));
		$this->addField($f_contact_first_name);

		$f_contact_middle_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_middle_name"
		,array(
		
			'id'=>"contact_middle_name"
				
		
		));
		$this->addField($f_contact_middle_name);

		$f_contact_name=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_name"
		,array(
		
			'id'=>"contact_name"
				
		
		));
		$this->addField($f_contact_name);

		$f_contact_description=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"contact_description"
		,array(
		
			'id'=>"contact_description"
				
		
		));
		$this->addField($f_contact_description);

		$f_client_id=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_id"
		,array(
		
			'id'=>"client_id"
				
		
		));
		$this->addField($f_client_id);

		$f_client_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"client_descr"
		,array(
		
			'id'=>"client_descr"
				
		
		));
		$this->addField($f_client_descr);

		
		
		
	}

}
?>
