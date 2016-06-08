<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');

class LabEntryDetailList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("lab_entry_detail_list_view");
		
		$f_shipment_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"shipment_id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"shipment_id"
				
		
		));
		$this->addField($f_shipment_id);

		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_code=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"code"
		,array(
		
			'id'=>"code"
				
		
		));
		$this->addField($f_code);

		$f_ship_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ship_date_time_descr"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"ship_date_time_descr"
				
		
		));
		$this->addField($f_ship_date_time_descr);

		$f_concrete_type_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type_descr"
		,array(
		
			'alias'=>"Марка"
		,
			'id'=>"concrete_type_descr"
				
		
		));
		$this->addField($f_concrete_type_descr);

		$f_ok=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"ok"
		,array(
		
			'alias'=>"ОК"
		,
			'id'=>"ok"
				
		
		));
		$this->addField($f_ok);

		$f_weight=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"weight"
		,array(
		
			'alias'=>"Масса"
		,
			'id'=>"weight"
				
		
		));
		$this->addField($f_weight);

		$f_p7=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p7"
		,array(
		
			'alias'=>"П7%"
		,
			'id'=>"p7"
				
		
		));
		$this->addField($f_p7);

		$f_p28=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p28"
		,array(
		
			'alias'=>"П28%"
		,
			'id'=>"p28"
				
		
		));
		$this->addField($f_p28);

		$f_p_date_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"p_date_descr"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"p_date_descr"
				
		
		));
		$this->addField($f_p_date_descr);

		$f_kn=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"kn"
		,array(
		
			'id'=>"kn"
				
		
		));
		$this->addField($f_kn);

		$f_mpa=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"mpa"
		,array(
		
			'id'=>"mpa"
				
		
		));
		$this->addField($f_mpa);

		$f_mpa_avg=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"mpa_avg"
		,array(
		
			'id'=>"mpa_avg"
				
		
		));
		$this->addField($f_mpa_avg);

		$f_pres_norm=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pres_norm"
		,array(
		
			'id'=>"pres_norm"
				
		
		));
		$this->addField($f_pres_norm);

		
		
		
	}

}
?>
