<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQLDOC.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');

class DOCMaterialProcurementList_Model extends ModelSQLDOC{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("doc_material_procurements_list_view");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'primaryKey'=>TRUE,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_descr"
		,array(
		
			'id'=>"date_time_descr"
				
		
		));
		$this->addField($f_date_time_descr);

		$f_number=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"number"
		,array(
		
			'id'=>"number"
				
		
		));
		$this->addField($f_number);

		$f_processed=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"processed"
		,array(
		
			'id'=>"processed"
				
		
		));
		$this->addField($f_processed);

		$f_supplier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_id"
		,array(
		
			'id'=>"supplier_id"
				
		
		));
		$this->addField($f_supplier_id);

		$f_supplier_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"supplier_descr"
		,array(
		
			'id'=>"supplier_descr"
				
		
		));
		$this->addField($f_supplier_descr);

		$f_carrier_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"carrier_id"
		,array(
		
			'id'=>"carrier_id"
				
		
		));
		$this->addField($f_carrier_id);

		$f_carrier_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"carrier_descr"
		,array(
		
			'id'=>"carrier_descr"
				
		
		));
		$this->addField($f_carrier_descr);

		$f_driver=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"driver"
		,array(
		
			'id'=>"driver"
				
		
		));
		$this->addField($f_driver);

		$f_vehicle_plate=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"vehicle_plate"
		,array(
		
			'id'=>"vehicle_plate"
				
		
		));
		$this->addField($f_vehicle_plate);

		$f_material_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_id"
		,array(
		
			'id'=>"material_id"
				
		
		));
		$this->addField($f_material_id);

		$f_material_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"material_descr"
		,array(
		
			'id'=>"material_descr"
				
		
		));
		$this->addField($f_material_descr);

		$f_quant_gross=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_gross"
		,array(
		
			'id'=>"quant_gross"
				
		
		));
		$this->addField($f_quant_gross);

		$f_quant_net=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant_net"
		,array(
		
			'id'=>"quant_net"
				
		
		));
		$this->addField($f_quant_net);

		
		
		
	}

}
?>
