<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');

class LabData_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("lab_data");
		
		$f_shipment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipment_id"
		,array(
		'required'=>TRUE,
			'primaryKey'=>TRUE,
			'autoInc'=>FALSE,
			'alias'=>"Отгрузка"
		,
			'id'=>"shipment_id"
				
		
		));
		$this->addField($f_shipment_id);

		$f_ok_sm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok_sm"
		,array(
		
			'alias'=>"ОК см"
		,
			'id'=>"ok_sm"
				
		
		));
		$this->addField($f_ok_sm);

		$f_weight=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight"
		,array(
		
			'alias'=>"масса"
		,
			'id'=>"weight"
				
		
		));
		$this->addField($f_weight);

		$f_weight_norm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight_norm"
		,array(
		
			'alias'=>"масса норм"
		,
			'id'=>"weight_norm"
				
		
		));
		$this->addField($f_weight_norm);

		$f_percent_1=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"percent_1"
		,array(
		
			'alias'=>"%"
		,
			'id'=>"percent_1"
				
		
		));
		$this->addField($f_percent_1);

		$f_p_1=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_1"
		,array(
		
			'alias'=>"p1"
		,
			'id'=>"p_1"
				
		
		));
		$this->addField($f_p_1);

		$f_p_2=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_2"
		,array(
		
			'alias'=>"p2"
		,
			'id'=>"p_2"
				
		
		));
		$this->addField($f_p_2);

		$f_p_3=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_3"
		,array(
		
			'alias'=>"p3"
		,
			'id'=>"p_3"
				
		
		));
		$this->addField($f_p_3);

		$f_p_4=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_4"
		,array(
		
			'alias'=>"p4"
		,
			'id'=>"p_4"
				
		
		));
		$this->addField($f_p_4);

		$f_p_7=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_7"
		,array(
		
			'alias'=>"p7"
		,
			'id'=>"p_7"
				
		
		));
		$this->addField($f_p_7);

		$f_p_28=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_28"
		,array(
		
			'alias'=>"p28"
		,
			'id'=>"p_28"
				
		
		));
		$this->addField($f_p_28);

		$f_p_norm=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_norm"
		,array(
		
			'alias'=>"p_norm"
		,
			'id'=>"p_norm"
				
		
		));
		$this->addField($f_p_norm);

		$f_percent_2=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"percent_2"
		,array(
		
			'alias'=>"percent_2"
		,
			'id'=>"percent_2"
				
		
		));
		$this->addField($f_percent_2);

		$f_lab_comment=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"lab_comment"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"lab_comment"
				
		
		));
		$this->addField($f_lab_comment);

		$f_num=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"num"
		,array(
		
			'alias'=>"№"
		,
			'id'=>"num"
				
		
		));
		$this->addField($f_num);

		
		
		
	}

}
?>
