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

require_once('models/CurrentVehList_Model.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTimeTZ.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');

class VehicleSchedule_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtDate('schedule_date'
				,array(
				'alias'=>'Дата'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('vehicle_id'
				,array('required'=>TRUE,
				'alias'=>'Автомобиль'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('driver_id'
				,array('required'=>TRUE,
				'alias'=>'Водитель'
			));
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('VehicleSchedule_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		$param = new FieldExtDate('schedule_date'
				,array(
			
				'alias'=>'Дата'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('vehicle_id'
				,array(
			
				'alias'=>'Автомобиль'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('driver_id'
				,array(
			
				'alias'=>'Водитель'
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('VehicleSchedule_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('VehicleSchedule_Model');

			
		/* get_list */
		$pm = new PublicMethod('get_list');
		$pm->addParam(new FieldExtInt('browse_mode'));
		$pm->addParam(new FieldExtInt('browse_id'));		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));
		$pm->addParam(new FieldExtString('cond_fields'));
		$pm->addParam(new FieldExtString('cond_sgns'));
		$pm->addParam(new FieldExtString('cond_vals'));
		$pm->addParam(new FieldExtString('cond_ic'));
		$pm->addParam(new FieldExtString('ord_fields'));
		$pm->addParam(new FieldExtString('ord_directs'));				
		
		$this->addPublicMethod($pm);
		
		$this->setListModelId('VehicleScheduleList_Model');
		
			
		/* complete  */
		$pm = new PublicMethod('complete');
		$pm->addParam(new FieldExtString('pattern'));
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('ic'));
		$pm->addParam(new FieldExtInt('mid'));
		$pm->addParam(new FieldExtString('vehicle_schedule_descr'));		
		$this->addPublicMethod($pm);					
		$this->setCompleteModelId('VehicleScheduleComplete_Model');
			
			
		$pm = new PublicMethod('get_current_veh_list');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
	
			
		$this->addPublicMethod($pm);

			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('VehicleScheduleList_Model');		

			
		$pm = new PublicMethod('set_free');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('id',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('set_out');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('id',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtText('comment_text',$opts));
				
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('gen_schedule');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtDate('date_from',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtDate('date_to',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('vehicle_id',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day1',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day2',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day3',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day4',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day5',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day6',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('day7',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('get_vehicle_efficiency');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('get_schedule_report');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
	
			
		$this->addPublicMethod($pm);
						
			
		$pm = new PublicMethod('get_schedule_report_all');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
	
			
		$this->addPublicMethod($pm);
									
			
		$pm = new PublicMethod('get_runs_inf');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
	
			
		$this->addPublicMethod($pm);
	
		
	}
	
	public function set_free($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$dbLink = $this->getDbLinkMaster();
		$dbLink->query(
			sprintf("SELECT set_vehicle_schedule_free(%d)",
			$p->getDbVal('id')));
	}
	
	public function set_out($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$dbLink = $this->getDbLinkMaster();
		$dbLink->query(
			sprintf("INSERT INTO out_comments
			(vehicle_schedule_id,comment_text)
			VALUES (%d,%s)",
			$p->getDbVal('id'),
			$p->getDbVal('comment_text')
			));
	}
	
	public function gen_schedule(){
		$pm = $this->getPublicMethod('gen_schedule');
		$date_from = null;
		$date_to = null;
		FieldSQLDate::formatForDb($pm->getParamValue('date_from'),$date_from);		
		FieldSQLDate::formatForDb($pm->getParamValue('date_to'),$date_to);
		$vehicle_id = $pm->getParamValue('vehicle_id');
		$day1 = ($pm->getParamValue('day1')=='1')? "true":"false";
		$day2 = ($pm->getParamValue('day2')=='1')? "true":"false";
		$day3 = ($pm->getParamValue('day3')=='1')? "true":"false";
		$day4 = ($pm->getParamValue('day4')=='1')? "true":"false";
		$day5 = ($pm->getParamValue('day5')=='1')? "true":"false";
		$day6 = ($pm->getParamValue('day6')=='1')? "true":"false";
		$day7 = ($pm->getParamValue('day7')=='1')? "true":"false";
		$dbLink = $this->getDbLink();
		$dbLink->query(
			sprintf("SELECT gen_schedule(%d,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
			$vehicle_id,
			$date_from,
			$date_to,
			$day1,$day2,$day3,$day4,$day5,$day6,$day7
			));
			
		//return report
		$model = new ModelSQL($dbLink,array("id"=>"VehicleScheduleReport_Model"));
		
		$model->setSelectQueryText(sprintf(
		"SELECT * FROM get_schedule_on_vehicle(%s,%s,%d)",
		$date_from,$date_to,$vehicle_id));
		
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);				
		
	}
	public function get_current_veh_list($pm){
		$model = new CurrentVehList_Model($this->getDbLink());
	
		$cond = $this->conditionFromParams($pm,$model);
		if (!$cond){
			throw new Exception("Не заданы условия.");
		}
		$schedule_date = $cond->getFieldValueForDb('schedule_date','=');
		if (!$schedule_date){
			throw new Exception("Не задана дата.");
		}
		
		$this->addNewModel(sprintf(
			"SELECT * FROM current_veh_list(%s)",		
			$schedule_date
			),
		'CurrentVehList_Model'
		);
	}
	public function get_vehicle_efficiency(){
		$pm = $this->getPublicMethod('get_vehicle_efficiency');
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array("id"=>"VehicleEfficiency_Model"));
		$model->addField(new FieldSQLDateTime($link,null,null,"date_time",DT_DATETIME));
		$model->addField(new FieldSQLInt($link,null,null,"vehicle_id",DT_INT));
		$model->addField(new FieldSQLString($link,null,null,"vehicle_owner_descr",DT_STRING));
		$model->addField(new FieldSQLString($link,null,null,"vehicle_feature",DT_STRING));
		$model->addField(new FieldSQLString($link,null,null,"run_type",DT_STRING));
		$model->addField(new FieldSQLString($link,null,null,"shift_type",DT_STRING));
		$where = $this->conditionFromParams($pm,$model);

		$from = null;
		$to = null;
		$vehicle_id = 0;
		$vehicle_owner_descr = "''";
		$vehicle_feature = "''";
		$run_type = "0";
		$shift_type = "0";
		
		foreach($where->fields as $w_field){
			$id = $w_field['field']->getId();
			if ($id=='date_time'){
				if ($w_field['signe']=='>='){
					$from = $w_field['field']->getValueForDb();
				}
				else{
					$to = $w_field['field']->getValueForDb();
				}
			}
			else if ($id=='vehicle_id'){
				$vehicle_id = $w_field['field']->getValueForDb();
			}
			else if ($id=='vehicle_owner_descr'){
				$vehicle_owner_descr = $w_field['field']->getValueForDb();
			}
			else if ($id=='vehicle_feature'){
				$vehicle_feature = $w_field['field']->getValueForDb();
			}
			else if ($id=='run_type'){
				switch ($w_field['field']->getValue()){
					case 'run_type_day':
						$run_type = 1;
						break;
					case 'run_type_night':
						$run_type = 2;
						break;
				}
			}			
			else if ($id=='shift_type'){
				switch ($w_field['field']->getValue()){
					case 'shift_type_on':
						$shift_type = 1;
						break;
					case 'shift_type_off':
						$shift_type = 2;
						break;
				}
			}						
		}
		$model->setSelectQueryText(
		sprintf(
		"SELECT * FROM vehicle_efficiency(%s,%s,%d,%s,%s,%d,%d)",
		$from,$to,$vehicle_id,$vehicle_owner_descr,$vehicle_feature,
		$run_type,$shift_type));
		
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);				
	}
	public function get_schedule_report(){
		$pm = $this->getPublicMethod('get_schedule_report');
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array("id"=>"VehicleScheduleReport_Model"));
		$model->addField(new FieldSQLDateTime($link,null,null,"date",DT_DATE));
		$model->addField(new FieldSQLInt($link,null,null,"vehicle_id",DT_INT));
		$where = $this->conditionFromParams($pm,$model);

		$from = null;
		$to = null;
		$vehicle_id = 0;
		
		foreach($where->fields as $w_field){
			$id = $w_field['field']->getId();
			if ($id=='date'){
				if ($w_field['signe']=='>='){
					$from = $w_field['field']->getValueForDb();
				}
				else{
					$to = $w_field['field']->getValueForDb();
				}
			}
			else if ($id=='vehicle_id'){
				$vehicle_id = $w_field['field']->getValueForDb();
			}
		}
				
		$model->setSelectQueryText(
		sprintf(
		"SELECT * FROM get_schedule_on_vehicle(%s,%s,%d)",
		$from,$to,$vehicle_id));
		
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);				
		
	}
	public function get_schedule_report_all($pm){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'get_schedule_report_all'));
		$model->addField(new FieldSQLDateTime($link,null,null,"date",DT_DATE));
		$model->addField(new FieldSQLInt($link,null,null,"vehicle_id",DT_INT));
		$where = $this->conditionFromParams($pm,$model);

		$from = null;
		$to = null;
		$vehicle_id = 0;
		
		foreach($where->fields as $w_field){
			$id = $w_field['field']->getId();
			if ($id=='date'){
				if ($w_field['signe']=='>='){
					$from = $w_field['field']->getValueForDb();
				}
				else{
					$to = $w_field['field']->getValueForDb();
				}
			}
			else if ($id=='vehicle_id'){
				$vehicle_id = $w_field['field']->getValueForDb();
			}
		}
				
		$model->setSelectQueryText(
		sprintf(
		"SELECT * FROM get_schedule_for_all(%s,%s,%d)",
		$from,$to,$vehicle_id));
		
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);				
		
	}
	
	public function get_runs_inf($pm){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array("id"=>"RunsInf_Model"));
		$model->addField(new FieldSQLInt($link,null,null,"schedule_id",DT_INT));
		$where = $this->conditionFromParams($pm,$model);
		if (!isset($where)){
			throw new Exception('Condition fields not set!');
		}
	
		$schedule_id = 0;
		
		foreach($where->fields as $w_field){
			$id = $w_field['field']->getId();
			if ($id=='schedule_id'){
				$schedule_id = $w_field['field']->getValueForDb();
			}
		}
	
		$model->setSelectQueryText(
		sprintf(
		"SELECT * FROM get_run_inf_on_schedule(%d)",
		$schedule_id));
		
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);						
	}	
}
?>
