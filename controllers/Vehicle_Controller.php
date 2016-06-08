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
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');
require_once('common/SMSService.php');
class Vehicle_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtString('plate'
				,array('required'=>TRUE,
				'alias'=>'Номер'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('load_capacity'
				,array('required'=>TRUE,
				'alias'=>'Грузоподъемность'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('vehicle_make_id'
				,array('required'=>FALSE,
				'alias'=>'Марка'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('vehicle_feature_id'
				,array('required'=>FALSE,
				'alias'=>'Свойства'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('driver_id'
				,array('required'=>FALSE,
				'alias'=>'Водитель'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('client_id'
				,array('required'=>FALSE,
				'alias'=>'Владелец'
			));
		$pm->addParam($param);
		$param = new FieldExtString('tracker_id'
				,array(
				'alias'=>'Трэкер'
			));
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('Vehicle_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		$param = new FieldExtString('plate'
				,array(
			
				'alias'=>'Номер'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('load_capacity'
				,array(
			
				'alias'=>'Грузоподъемность'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('vehicle_make_id'
				,array(
			
				'alias'=>'Марка'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('vehicle_feature_id'
				,array(
			
				'alias'=>'Свойства'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('driver_id'
				,array(
			
				'alias'=>'Водитель'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('client_id'
				,array(
			
				'alias'=>'Владелец'
			));
			$pm->addParam($param);
		$param = new FieldExtString('tracker_id'
				,array(
			
				'alias'=>'Трэкер'
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('Vehicle_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('Vehicle_Model');

			
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
		
		$this->setListModelId('VehicleDialog_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('VehicleDialog_Model');		

			
		/* complete  */
		$pm = new PublicMethod('complete');
		$pm->addParam(new FieldExtString('pattern'));
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('ic'));
		$pm->addParam(new FieldExtInt('mid'));
		$pm->addParam(new FieldExtString('plate'));		
		$this->addPublicMethod($pm);					
		$this->setCompleteModelId('Vehicle_Model');

			
		$pm = new PublicMethod('complete_features');
		
				
	$opts=array();
			
		$pm->addParam(new FieldExtString('feature',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('ic',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('mid',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('complete_owners');
		
				
	$opts=array();
			
		$pm->addParam(new FieldExtString('owner',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('complete_makes');
		
				
	$opts=array();
			
		$pm->addParam(new FieldExtString('make',$opts));
	
			
		$this->addPublicMethod($pm);
						
			
		$pm = new PublicMethod('get_gps_all');
		
				
					
					
				
				
	/*Получает информацию о текущем местоположении по всем ТС.
				Возвращает две модели: ZoneList_Model и GPSDataAll_Model*/

			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('get_gps_at_work');
		
				
					
					
				
				
	/*Получает информацию о текущем местоположении по рабочим ТС.
				Возвращает две модели: ZoneList_Model и GPSData_Model*/

			
		$this->addPublicMethod($pm);

			
			
			
		$pm = new PublicMethod('get_track');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('id',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtDateTime('dt_from',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtDateTime('dt_to',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtTime('stop_dur',$opts));
	
			
		$this->addPublicMethod($pm);
			
		
	}
	
	public function complete_owners($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->setValidated('owner',DT_STRING);
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_owner_list_view
			WHERE lower(owner) LIKE %s||'%%'",
			$params->getArray()),
			'VehicleOwnerList_Model'
		);
	}
	public function complete_features($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->setValidated('feature',DT_STRING);
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_feature_list_view
			WHERE lower(feature) LIKE %s||'%%'",
			$params->getArray()),
			'VehicleFeatureList_Model'
		);	
	}
	public function complete_makes($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->setValidated('make',DT_STRING);
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_make_list_view
			WHERE lower(make) LIKE %s||'%%'",
			$params->getArray()),
			'VehicleMakeList_Model'
		);	
	}
	public function get_track($pm){
		$link = $this->getDbLink();
		$params = new ParamsSQL($pm,$link);
		$params->setValidated('id',DT_INT);
		$params->setValidated('dt_from',DT_DATETIME);
		$params->setValidated('dt_to',DT_DATETIME);
		$params->setValidated('stop_dur',DT_TIME);
		$this->addNewModel(
		vsprintf(
		"SELECT
			(SELECT
				replace(replace(st_astext(zone), 'POLYGON(('::text, ''::text), '))'::text, ''::text) AS coords
				FROM destinations
				WHERE id=constant_base_geo_zone_id()
			) AS base,
			NULL AS dest
		UNION ALL
		SELECT
			NULL AS base,
			replace(replace(st_astext(zone), 'POLYGON(('::text, ''::text), '))'::text, ''::text) AS dest
			FROM vehicle_schedule_states AS st
			LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
			LEFT JOIN vehicles AS v ON v.id=vs.vehicle_id
			LEFT JOIN destinations AS dest ON dest.id=st.destination_id
			WHERE v.id=%d
			AND st.date_time BETWEEN %s AND %s
			AND st.state='busy'::vehicle_states
		",
		$params->getArray()),
		'zones'
		);
		//track
		$this->addNewModel(vsprintf(
			"SELECT * FROM vehicle_track_with_stops(%d,%s,%s,%s)",
			$params->getArray()),
			'track_data'
		);				
	}
	
	public function get_gps_all($pm){
		//zones
		$this->addNewModel(
		"SELECT * FROM destination_base_list",
		'ZoneList_Model');
		
		//position
		$this->addNewModel(
			"SELECT * FROM vehicle_current_pos_all",
			'GPSDataAll_Model'
		);		
	}
	public function get_gps_at_work($pm){
		//zones
		$this->addNewModel(
		"SELECT * FROM destination_at_work_list(now()::date)",
		'ZoneList_Model');
		
		//position
		$this->addNewModel(
			"SELECT * FROM vehicle_at_work_list(now()::date)",
			'GPSData_Model'
		);		
	}
	

}
?>
