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
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');
class RawMaterial_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtString('name'
				,array('required'=>TRUE,
				'alias'=>'Наименование'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('planned_procurement'
				,array(
				'alias'=>'Плановый приход'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('supply_days_count'
				,array(
				'alias'=>'Дней завоза'
			));
		$pm->addParam($param);
		$param = new FieldExtBool('concrete_part'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('ord'
				,array('required'=>TRUE));
		$pm->addParam($param);
		$param = new FieldExtInt('supply_volume'
				,array(
				'alias'=>'Объем ТС завоза'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('store_days'
				,array());
		$pm->addParam($param);
		$param = new FieldExtFloat('min_end_quant'
				,array());
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('RawMaterial_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		$param = new FieldExtString('name'
				,array(
			
				'alias'=>'Наименование'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('planned_procurement'
				,array(
			
				'alias'=>'Плановый приход'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('supply_days_count'
				,array(
			
				'alias'=>'Дней завоза'
			));
			$pm->addParam($param);
		$param = new FieldExtBool('concrete_part'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('ord'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('supply_volume'
				,array(
			
				'alias'=>'Объем ТС завоза'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('store_days'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('min_end_quant'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('RawMaterial_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('RawMaterial_Model');

			
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
		
		$this->setListModelId('RawMaterial_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('RawMaterial_Model');		

			
		/* complete  */
		$pm = new PublicMethod('complete');
		$pm->addParam(new FieldExtString('pattern'));
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('ic'));
		$pm->addParam(new FieldExtInt('mid'));
		$pm->addParam(new FieldExtString('name'));		
		$this->addPublicMethod($pm);					
		$this->setCompleteModelId('RawMaterial_Model');

			
		$pm = new PublicMethod('get_list_for_concrete');
		
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('supplier_orders_list');
		
				
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
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('templ',$opts));
				
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('update_procurement');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtText('docs',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('oper_week_report');
		
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('total_report');
		
				
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

			
		$pm = new PublicMethod('total_details_report');
		
				
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
			
			
		$pm = new PublicMethod('set_min_quant');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtDateTime('week_day',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('material_id',$opts));
	
				
	$opts=array();
	
		$opts['length']=19;				
		$pm->addParam(new FieldExtFloat('quant',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('correct_consumption');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtDate('date',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('material_id',$opts));
	
				
	$opts=array();
	
		$opts['length']=19;
		$opts['unsigned']=FALSE;				
		$pm->addParam(new FieldExtFloat('quant',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('correct_obnul');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtDate('date',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('material_id',$opts));
	
				
	$opts=array();
	
		$opts['length']=19;
		$opts['unsigned']=FALSE;				
		$pm->addParam(new FieldExtFloat('quant',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('correct_list');
		
				
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
						
			
		$pm = new PublicMethod('total_list');
		
				
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
									
			
		$pm = new PublicMethod('mat_totals');
		
				
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
	public function get_list_for_concrete($pm){		
		$this->addNewModel(
			"SELECT *
			FROM raw_materials
			WHERE concrete_part=TRUE
			ORDER BY ord",
		"RawMaterial_Model");
	}
	/*
	public function get_planned_consuption($pm){		
		$date = $pm->getParamValue('date');
		$days = $pm->getParamValue('days');
		$link = $this->getDbLink();
		
		$model = new ModelSQL($link,array("id"=>"RawMaterialConsuption_Model"));
		$model->addField(new FieldSQL($link,null,null,"raw_material_id",DT_INT));
		$model->addField(new FieldSQL($link,null,null,"raw_material_descr",DT_STRING));
		$model->addField(new FieldSQL($link,null,null,"planned_procurement",DT_FLOAT));
		$model->addField(new FieldSQL($link,null,null,"quant_balance",DT_FLOAT));
		$model->addField(new FieldSQL($link,null,null,"quant_ordered",DT_STRING));
		$model->addField(new FieldSQL($link,null,null,"planned_consuption",DT_STRING));
				
		
		$model->setSelectQueryText(
		sprintf(
		"SELECT *
		FROM get_raw_material_planned_consuption_report('%s',%d)"
		,date("Y-m-d",$date),$days));
		
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);			
	}
	*/
	public function update_procurement($pm){
		$docs_str = $pm->getParamValue('docs');
		
		$link_master = $this->getDbLinkMaster();
		$link = $this->getDbLink();
		
		$xml = new SimpleXMLElement($docs_str);
		try{
			$doc_cnt=0;
			foreach ($xml->doc as $doc) {
				$doc_cnt++;
				//supplier
				$sup_params = new ParamsSQL($pm,$link);				
				$sup_params->add('supplier_ref',DT_STRING,$doc->supplier_ref);
				$sup_params->add('supplier_name',DT_STRING,$doc->supplier_name);
				$sup_params->add('supplier_name_full',DT_STRING,$doc->supplier_name_full);				
				
				$supplier_ar = $link->query_first(
				sprintf(
				"SELECT id FROM suppliers
				WHERE ext_ref_scales=%s",
				$sup_params->getParamById('supplier_ref')));
				
				if (!is_array($supplier_ar)|| count($supplier_ar)==0){
					//new supplier
					$supplier_ar=$link_master->query_first(sprintf("INSERT INTO suppliers
					(name,name_full,ext_ref_scales)
					VALUES (%s,%s,%s) RETURNING id",
					$sup_params->getParamById('supplier_name'),
					$sup_params->getParamById('supplier_name_full'),
					$sup_params->getParamById('supplier_ref')));
				}
				else{
					$link_master->query(sprintf(
					"UPDATE suppliers
					SET name=%s,name_full=%s
					WHERE ext_ref_scales=%s",
					$sup_params->getParamById('supplier_name'),
					$sup_params->getParamById('supplier_name_full'),
					$sup_params->getParamById('supplier_ref')));
				}
				
				//carrier
				$car_params = new ParamsSQL($pm,$link);
				$car_params->add('carrier_ref',DT_STRING,$doc->carrier_ref);
				$car_params->add('carrier_name',DT_STRING,$doc->carrier_name);
				$car_params->add('carrier_name_full',DT_STRING,$doc->carrier_name_full);				
				
				$carrier_ar = $link->query_first(
				sprintf(
				"SELECT id FROM suppliers
				WHERE ext_ref_scales=%s",
				$car_params->getParamById('carrier_ref')));
				
				if (!is_array($carrier_ar)|| count($carrier_ar)==0){
					//new carrier
					$carrier_ar=$link_master->query_first(sprintf("INSERT INTO suppliers
					(name,name_full,ext_ref_scales)
					VALUES (%s,%s,%s) RETURNING id",
					$car_params->getParamById('carrier_name'),
					$car_params->getParamById('carrier_name_full'),
					$car_params->getParamById('carrier_ref')));
				}
				else{
					$link_master->query(sprintf(
					"UPDATE suppliers
					SET name=%s,name_full=%s
					WHERE ext_ref_scales=%s",
					$car_params->getParamById('carrier_name'),
					$car_params->getParamById('carrier_name_full'),
					$car_params->getParamById('carrier_ref')));
				}
				
				//material
				$mat_params = new ParamsSQL($pm,$link);				
				$mat_params->add('material',DT_STRING,$doc->material);				
				$material_ar = $link->query_first(
				sprintf(
				"SELECT id FROM raw_materials
				WHERE name=%s",
				$mat_params->getParamById('material')));
				if (!is_array($material_ar)|| count($material_ar)==0){
					//new material
					$material_ar=$link_master->query_first(sprintf(
					"INSERT INTO raw_materials (name)
					VALUES (%s) RETURNING id",
					$mat_params->getParamById('material')));
				}
				
				//doc				
				$doc_params = new ParamsSQL($pm,$link);				
				$doc_params->add('number',DT_STRING,$doc->number);
				$doc_params->add('doc_ref',DT_STRING,$doc->doc_ref);
				$doc_params->add('date_time',DT_DATETIME,$doc->date_time);
				$doc_params->add('driver',DT_STRING,$doc->driver);
				$doc_params->add('vehicle_plate',DT_STRING,$doc->vehicle_plate);
				$doc_params->add('material',DT_STRING,$doc->material);
				
				$quant_gross = ($doc->quant_gross=='0')? 0:$doc->quant_gross/1000;
				$quant_net = ($doc->quant_net=='0')? 0:$doc->quant_net/1000;
				$doc_params->add('quant_gross',DT_STRING,$quant_gross);
				$doc_params->add('quant_net',DT_STRING,$quant_net);
				$doc_ar = $link->query_first(sprintf(
				"SELECT id FROM doc_material_procurements WHERE doc_ref=%s",
				$doc_params->getParamById('doc_ref')));
				if (!is_array($doc_ar)|| count($doc_ar)==0){
					//new doc
					$link_master->query_first(sprintf(
					"INSERT INTO doc_material_procurements
					(date_time,number,doc_ref,supplier_id,carrier_id,driver,vehicle_plate,material_id,quant_gross,quant_net)
					VALUES (%s,%s,%s,%d,%d,%s,%s,%d,%f,%f) RETURNING id",
					$doc_params->getParamById('date_time'),
					$doc_params->getParamById('number'),
					$doc_params->getParamById('doc_ref'),
					$supplier_ar['id'],
					$carrier_ar['id'],
					$doc_params->getParamById('driver'),
					$doc_params->getParamById('vehicle_plate'),
					$material_ar['id'],
					$quant_gross,
					$quant_net
					));
				}
				else{
					//update doc
					$link_master->query_first(sprintf(
					"UPDATE doc_material_procurements
					SET date_time=%s,number=%s,
					supplier_id=%d,carrier_id=%d,driver=%s,
					vehicle_plate=%s,material_id=%d,
					quant_gross=%f,quant_net=%f
					WHERE id=%d",
					$doc_params->getParamById('date_time'),
					$doc_params->getParamById('number'),
					$supplier_ar['id'],
					$carrier_ar['id'],
					$doc_params->getParamById('driver'),
					$doc_params->getParamById('vehicle_plate'),
					$material_ar['id'],
					$quant_gross,
					$quant_net,
					$doc_ar['id']
					));					
				}
			}
			$res = 'true';
			$descr = 'null';
		}catch (Exception $e){
			$res = 'false';			
			$descr = "'".str_replace("'",'"',$e->getMessage())."'";
		}
		$link_master->query("DELETE FROM raw_material_procur_uploads");
		$link_master->query(
			sprintf("INSERT INTO raw_material_procur_uploads
			(date_time,result,descr,doc_count)
			VALUES ('%s',%s,%s,%d)",
			date('Y-m-d H:i:s'),$res,$descr,$doc_cnt));
		if ($res == 'false'){
			throw new $e;
		}
	}
	public function oper_week_report($pm){
		$days_for_avg = 10;
		$param_change="'08:00'";
		$this->addNewModel(sprintf(
			"SELECT * FROM oper_week_report(%d,%s::interval)",
			$days_for_avg,$param_change)
		,'oper_week_report');
	}
	public function total_report($pm){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'total_report'));
		$model->addField(new FieldSQLInt($link,null,null,"material_id"));
		$model->addField(new FieldSQLDateTime($link,null,null,"date_time"));
		$where = $this->conditionFromParams($pm,$model);
		$this->addNewModel(sprintf(
			"SELECT * FROM raw_material_total_report(%s,%s,%d)",
			$where->getFieldValueForDb('date_time','>=',0),
			$where->getFieldValueForDb('date_time','<=',0),
			$where->getFieldValueForDb('material_id','=',0)
			)
		,'total_report');	
	}
	public function total_details_report($pm){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'total_details_report'));
		$model->addField(new FieldSQLInt($link,null,null,"material_id"));
		$model->addField(new FieldSQLDateTime($link,null,null,"date_time"));
		$where = $this->conditionFromParams($pm,$model);
		$this->addNewModel(sprintf(
			"SELECT * FROM raw_material_total_details_report(
				%s::timestamp without time zone,
				%s::timestamp without time zone,
				%d)",
			$where->getFieldValueForDb('date_time','>=',0),
			$where->getFieldValueForDb('date_time','<=',0),
			$where->getFieldValueForDb('material_id','=',0)
			)
		,'total_details_report');	
	}
	
	public function set_min_quant($pm){
		$link = $this->getDbLinkMaster();
		$params = new ParamsSQL($pm,$link);
		$params->addAll();
		$quant = $pm->getParamValue('quant');
		$link->query(sprintf(
		"SELECT raw_material_min_quant_set(%s,%d,%f)",
		$params->getParamById('week_day'),
		$params->getParamById('material_id'),
		$params->getParamById('quant')
		));
	}
	public function correct_list($pm){
		//material list
		$this->addNewModel(
			"SELECT id,name FROM raw_materials
			WHERE concrete_part=true
			ORDER BY ord",
		'material_list');
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'correct_list'));
		$model->addField(new FieldSQLDateTime($link,null,null,"date_time"));
		$where = $this->conditionFromParams($pm,$model);
		$this->addNewModel(sprintf(
		"SELECT 
			get_shift_start(r.date_time) AS shift,
			date8_descr(get_shift_start(r.date_time)::date) AS shift_descr,
			r.material_id,
			sum(coalesce(r.material_quant_norm,0)) AS norm,
			sum(coalesce(r.material_quant_corrected,0)) AS corrected,
			coalesce(obn.quant,0) AS obnul,
			
			sum(coalesce(r.material_quant_corrected,0))-
				sum(coalesce(r.material_quant_norm,0))
			AS balance
			
		 FROM ra_material_consumption AS r
		 LEFT JOIN raw_materials AS m ON m.id=r.material_id
		 LEFT JOIN materials_obnuls AS obn
			ON obn.material_id=r.material_id AND obn.day=get_shift_start(r.date_time)::date
		 WHERE r.date_time BETWEEN %s AND %s
			AND m.concrete_part=true
		 GROUP BY shift,
				shift_descr,
				r.material_id,
				m.name,
				m.ord,
				obn.quant
		 ORDER BY shift,m.ord
		",		
		$where->getFieldValueForDb('date_time','>=',0),
		$where->getFieldValueForDb('date_time','<=',0)
		),'correct_list');
	}
	public function total_list($pm){
		//material list
		$this->addNewModel(
			"SELECT
				m.id,
				m.name,
				pp.mat_avg_cons AS avg_cons,
				pp.mat_tot_cons AS tot_cons
			FROM raw_materials AS m
			LEFT JOIN (
				SELECT
					material_id,
					mat_tot_cons,
					mat_avg_cons
				FROM mat_plan_procur(
					now()::timestamp without time zone+'1 day'::interval,
					get_shift_start(now()::timestamp without time zone - (const_days_for_plan_procur_val()||' days')::interval),
					get_shift_end(get_shift_start(now()::timestamp without time zone)-'1 day'::interval),
				null)
				) AS pp ON pp.material_id=m.id
			WHERE concrete_part=true
			ORDER BY ord",
		'material_list');
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'total_list'));
		$model->addField(new FieldSQLDateTime($link,null,null,"date_time"));
		$where = $this->conditionFromParams($pm,$model);
		$this->addNewModel(sprintf(
		"SELECT * FROM raw_material_total_report(%s,%s)",		
		$where->getFieldValueForDb('date_time','>=',0),
		$where->getFieldValueForDb('date_time','<=',0)
		),'total_list');
	}
	
	public function correct_consumption($pm){
		$link = $this->getDbLinkMaster();
		$params = new ParamsSQL($pm,$link);
		$params->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
			"SELECT mat_cons_correct_quant(%s,%d,%f)",
			$params->getParamById('date'),
			$params->getParamById('material_id'),
			$params->getParamById('quant')
			)
		);
	}
	public function correct_obnul($pm){
		$link = $this->getDbLinkMaster();
		$params = new ParamsSQL($pm,$link);
		$params->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
			"SELECT mat_obnul_correct_quant(%s,%d,%f)",
			$params->getParamById('date'),
			$params->getParamById('material_id'),
			$params->getParamById('quant')
			)
		);
	}
	
	public function supplier_orders_list($pm){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'supplier_orders_list'));
		$model->addField(new FieldSQLDateTime($link,null,null,"shift"));
		$model->addField(new FieldSQLInt($link,null,null,"material_id"));
		$where = $this->conditionFromParams($pm,$model);
		if (!$where){
			throw new Exception("Не заданы параметры!");
		}		
		$mat_id = $where->getFieldValueForDb('material_id','=',0);
		if ($mat_id==0){
			throw new Exception("Не задан материал!");
		}
		$this->addNewModel(sprintf(
		"SELECT
			o.shift,
			o.shift_descr,
			o.supplier_id,
			sp.name AS supplier_descr,
			o.supplier_proc_rate,
			o.quant_to_order,
			o.quant_procur,
			o.quant_balance,
			o.sms_delivered
			
		FROM supplier_orders_list(%s,%s,%d) AS o
		LEFT JOIN suppliers AS sp ON sp.id=o.supplier_id",		
		$where->getFieldValueForDb('shift','>=',0),
		$where->getFieldValueForDb('shift','<=',0),
		$mat_id
		),'supplier_orders_list');		
	}
	public function mat_totals($pm){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'mat_totals'));
		$model->addField(new FieldSQLString($link,null,null,"date",DT_DATE));
		$where = $this->conditionFromParams($pm,$model);
		$this->addNewModel(sprintf(
		"SELECT *
		FROM mat_totals(%s)",		
		$where->getFieldValueForDb('date','=',0)
		),'mat_totals');		
	}
}
?>
