<?php

require_once(FRAME_WORK_PATH.'basic_classes/ControllerSQL.php');

require_once(FRAME_WORK_PATH.'basic_classes/FieldExtInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtEnum.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtPassword.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtBool.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
class RAMaterialConsumption_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		$pm = new PublicMethod('get_dates_list');
		
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
				
			
		$this->addPublicMethod($pm);
		
			
		$pm = new PublicMethod('get_docs_list');
		
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
				
			
		$this->addPublicMethod($pm);
					
		
	}	
	
	public function get_dates_list($pm){
		$link = $this->getDbLink();
		$ar = $link->query_first('SELECT COUNT(*) AS cnt FROM raw_materials');
		$mat_count = $ar['cnt'];				
		//
		//result model
		$model = new ModelSQL($link,array("id"=>"get_dates_list"));
		$model->addField(new FieldSQLString($link,null,null,"shift"));
		$model->addField(new FieldSQLString($link,null,null,"shift_descr"));		
		$model->addField(new FieldSQLString($link,null,null,"shift_from_descr"));		
		$model->addField(new FieldSQLString($link,null,null,"shift_to_descr"));		
		$model->addField(new FieldSQLString($link,null,null,"concrete_quant"));		

		$fld_list='';
		$fld_def = '';
		for ($i = 1; $i <= $mat_count; $i++) {
			$fld_list.=',mat'.$i.'_quant';
			$fld_def.=',mat'.$i.'_quant numeric';
			$model->addField(new FieldSQLString($link,null,null,'mat'.$i.'_quant'));
		}
		$def_date=null;
		FieldSQLDateTime::formatForDb(mktime(),$def_date);
		
		$model_params = new ModelSQL($link);
		$model_params->addField(new FieldSQLDateTime($link,null,null,"shift"));		
		$where = $this->conditionFromParams($pm,$model_params);
		if (!$where){
			throw new Exception("Не заданы условия!");
		}		
		$sql=sprintf("SELECT
			shift,shift_descr,
			shift_from_descr,shift_to_descr,
			concrete_quant%s
		FROM ra_material_consumption_dates(%s,%s)
		AS (shift timestamp,
		shift_descr text,shift_from_descr text,
		shift_to_descr text,
		concrete_quant numeric%s)",
		$fld_list,
		$where->getFieldValueForDb('shift','>=',0,$def_date),
		$where->getFieldValueForDb('shift','<=',0,$def_date),
		$fld_def);
		//throw new Exception($sql);
		$model->query($sql,TRUE);
		$this->addModel($model);		
		
		$mat_model = new ModelSQL($link,array('id'=>'RawMaterial_Model'));
		$mat_model->addField(new FieldSQLInt($link,null,null,"id"));
		$mat_model->addField(new FieldSQLString($link,null,null,"name"));
		$mat_model->query('SELECT id,name FROM raw_materials ORDER BY id',
		TRUE);
		$this->addModel($mat_model);			
	}
	public function get_docs_list($pm){
		$link = $this->getDbLink();
		$ar = $link->query_first('SELECT COUNT(*) AS cnt FROM raw_materials');
		$mat_count = $ar['cnt'];				
		//
		//result model
		$model = new ModelSQL($link,array("id"=>"get_docs_list"));
		$model->addField(new FieldSQLString($link,null,null,"date_time"));
		$model->addField(new FieldSQLString($link,null,null,"date_time_descr"));		
		$model->addField(new FieldSQLString($link,null,null,"concrete_type_descr"));
		$model->addField(new FieldSQLString($link,null,null,"vehicle_descr"));
		$model->addField(new FieldSQLString($link,null,null,"driver_descr"));
		$model->addField(new FieldSQLString($link,null,null,"concrete_quant"));		

		$fld_list='';
		$fld_def = '';
		for ($i = 1; $i <= $mat_count; $i++) {
			$fld_list.=',mat'.$i.'_quant';
			$fld_def.=',mat'.$i.'_quant numeric';
			$model->addField(new FieldSQLString($link,null,null,'mat'.$i.'_quant'));
		}
		$def_date=null;
		FieldSQLDateTime::formatForDb(mktime(),$def_date);
		
		$model_params = new ModelSQL($link);
		$model_params->addField(new FieldSQLDateTime($link,null,null,"date_time"));		
		$where = $this->conditionFromParams($pm,$model_params);
		if (!$where){
			throw new Exception("Не заданы условия!");
		}		
		$sql=sprintf("SELECT
			date_time,date_time_descr,
			concrete_type_id,concrete_type_descr,
			vehicle_id,vehicle_descr,
			driver_id,driver_descr,
			concrete_quant%s
		FROM ra_material_consumption_doc_materials(%s,%s)
		AS (date_time timestamp,date_time_descr text,
		concrete_type_id int,concrete_type_descr text,
		vehicle_id int, vehicle_descr text,
		driver_id int, driver_descr text,
		concrete_quant numeric%s)",
		$fld_list,
		$where->getFieldValueForDb('date_time','>=',0,$def_date),
		$where->getFieldValueForDb('date_time','<=',0,$def_date),
		$fld_def);
		//throw new Exception($sql);
		$model->query($sql,TRUE);
		$this->addModel($model);		
		
		$mat_model = new ModelSQL($link,array('id'=>'RawMaterial_Model'));
		$mat_model->addField(new FieldSQLInt($link,null,null,"id"));
		$mat_model->addField(new FieldSQLString($link,null,null,"name"));
		$mat_model->query('SELECT id,name FROM raw_materials ORDER BY id',
		TRUE);
		$this->addModel($mat_model);			
	}	

}
?>
