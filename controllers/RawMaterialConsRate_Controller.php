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
require_once(FRAME_WORK_PATH.'basic_classes/ModelReportSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
class RawMaterialConsRate_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('rate_date_id'
				,array('required'=>TRUE));
		$pm->addParam($param);
		$param = new FieldExtInt('concrete_type_id'
				,array(
				'alias'=>'Марка бетона'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('raw_material_id'
				,array(
				'alias'=>'Материал'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('rate'
				,array(
				'alias'=>'Расход'
			));
		$pm->addParam($param);
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('RawMaterialConsRate_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_rate_date_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('old_concrete_type_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('old_raw_material_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('rate_date_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('concrete_type_id'
				,array(
			
				'alias'=>'Марка бетона'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('raw_material_id'
				,array(
			
				'alias'=>'Материал'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('rate'
				,array(
			
				'alias'=>'Расход'
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('rate_date_id',array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('concrete_type_id',array(
			
				'alias'=>'Марка бетона'
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('raw_material_id',array(
			
				'alias'=>'Материал'
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('RawMaterialConsRate_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('rate_date_id'
		));		
		
		$pm->addParam(new FieldExtInt('concrete_type_id'
		));		
		
		$pm->addParam(new FieldExtInt('raw_material_id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('RawMaterialConsRate_Model');

			
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
		
		$this->setListModelId('RawMaterialConsRate_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('rate_date_id'
		));
		
		$pm->addParam(new FieldExtInt('concrete_type_id'
		));
		
		$pm->addParam(new FieldExtInt('raw_material_id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('RawMaterialConsRate_Model');		

			
		$pm = new PublicMethod('raw_material_cons_report');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_vals',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_sgns',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('cond_ic',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('grp_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('agg_fields',$opts));
	
			
		$this->addPublicMethod($pm);

		
	}
	public function raw_material_cons_report(){
		$pm = $this->getPublicMethod("raw_material_cons_report");
		$link = $this->getDbLink();
		$model = new ModelReportSQL($link,array("id"=>"RawMaterialConsReport_Model"));
		$model->addField(new FieldSQLDateTime($link,null,null,"date_time"));
		$model->addField(new FieldSQLInt($link,null,null,"concrete_type_id",array('alias'=>'Марка бетона')));
		$model->addField(new FieldSQLInt($link,null,null,"raw_material_id",array('alias'=>'Материал')));
		$model->addField(new FieldSQLString($link,null,null,"concrete_type_descr",array('alias'=>'Марка бетона')));
		$model->addField(new FieldSQLString($link,null,null,"raw_material_descr",array('alias'=>'Материал')));		
		$model->addField(new FieldSQLFloat($link,null,null,"quant_on_cons_rate",array('alias'=>'Расход по норме')));
		
		$where = $this->conditionFromParams($pm,$model);
		
		$from = null;
		$to = null;
		$concrete_type_id = 0;
		$raw_material_id = 0;

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
			else if ($id=='concrete_type_id'){
				$concrete_type_id = $w_field['field']->getValueForDb();
			}
			else if ($id=='raw_material_id'){
				$raw_material_id = $w_field['field']->getValueForDb();
			}
		}
		
		$table = sprintf("raw_material_cons_report(%s,%s,%d,%d)",
			$from,$to,$concrete_type_id,$raw_material_id);
		$model->setTableName($table);
		$model->setDbName('public');
		
		$where = null;
		$order = $this->orderFromParams($pm);
		$fields = $this->fieldsFromParams($pm);		
		$grp_fields = $this->grpFieldsFromParams($pm);		
		$agg_fields = $this->aggFieldsFromParams($pm);		
		$from = null; $count = null;
		$limit = $this->limitFromParams($pm,$from,$count);
		$calc_total = ($count>0);
		if ($from){
			$model->setListFrom($from);
		}
		if ($count){
			$model->setRowsPerPage($count);
		}
		
		$model->select(false,$where,$order,
			$limit,$fields,$grp_fields,$agg_fields,
			$calc_total,TRUE);
		//
		$this->addModel($model);
	}
	public function get_data($link,$rate_date_id,$concrete_type_id){
		$ar = $link->query_first('SELECT COUNT(*) AS cnt FROM raw_materials WHERE concrete_part=true');
		$mat_count = $ar['cnt'];				
		//
		//result model
		$model = new ModelReportSQL($link,array("id"=>"RawMaterialConsRateList_Model"));
		$model->addField(new FieldSQLString($link,null,null,"date_rate_id"));
		$model->addField(new FieldSQLString($link,null,null,"concrete_type_id"));
		$model->addField(new FieldSQLString($link,null,null,"concrete_type_descr"));
						
		$fld_list='';
		$fld_def = '';
		for ($i = 1; $i <= $mat_count; $i++) {
			$fld_list.=',mat'.$i.'_id, mat'.$i.'_rate';
			$fld_def.=',mat'.$i.'_id int, mat'.$i.'_rate numeric';
			$model->addField(new FieldSQLString($link,null,null,'mat'.$i.'_id'));
			$model->addField(new FieldSQLString($link,null,null,'mat'.$i.'_descr'));
			$model->addField(new FieldSQLString($link,null,null,'mat'.$i.'_rate'));
		}
		$sql='SELECT
			'.$rate_date_id.'::int AS rate_date_id,
			concrete_type_id,
			concrete_type_descr'.$fld_list.'
		FROM raw_material_cons_rates_on_date_id('.$rate_date_id.','.$concrete_type_id.')
		AS (concrete_type_id int, concrete_type_descr text'.$fld_def.')';
		//throw new Exception($sql);
		$model->query($sql,TRUE);
		$this->addModel($model);	
	}
	public function get_list($pm){
		$link = $this->getDbLink();
		
		$model = new ModelSQL($link);
		$model->addField(new FieldSQLInt($link,null,null,"rate_date_id"));
		$model->addField(new FieldSQLInt($link,null,null,"concrete_type_id"));
		$where = $this->conditionFromParams($pm,$model);
		$rate_date_id=$where->getFieldValueForDb('rate_date_id','=',0,0);
		$concrete_type_id=$where->getFieldValueForDb('concrete_type_id','=',0,0);
		
		$mat_model = new ModelSQL($link,array('id'=>'RawMaterial_Model'));
		$mat_model->addField(new FieldSQLInt($link,null,null,"id"));
		$mat_model->addField(new FieldSQLString($link,null,null,"name"));
		$mat_model->query('SELECT id,name
			FROM raw_materials
			WHERE concrete_part=true
			ORDER BY id',
		TRUE);
		$this->addModel($mat_model);		
		
		$this->get_data($link,$rate_date_id,$concrete_type_id);
	}
	
	public function get_object($pm){
		$link = $this->getDbLink();
		$rate_date_id = $pm->getParamValue('rate_date_id',0);
		$concrete_type_id = $pm->getParamValue('concrete_type_id',0);
		$this->get_data($link,$rate_date_id,$concrete_type_id);
	}
	public function update($pm){
		$link_master = $this->getDbLinkMaster();
		$rate_date_id = $pm->getParamValue('old_rate_date_id',0);
		$concrete_type_id = $pm->getParamValue('old_concrete_type_id',0);
		//dynamic params
		foreach($_REQUEST as $par_name => $par_val){
			if (preg_match("/mat[1-9]_rate/",$par_name)){
				$s = substr($par_name,0,strpos($par_name,'_'));
				$mat_ind = intval(str_replace('mat','',$s));
				FieldSQLInt::formatForDb($_REQUEST['old_mat'.$mat_ind.'_id'],
					$raw_material_id);
				
				if ($par_val==''||is_null($par_val)){
					$par_val=0;
				}
				FieldSQLFloat::formatForDb($par_val,$rate);
				if ($par_val){
					$q=sprintf(
					'SELECT raw_material_cons_rates_update(%d,%d,%d,%f)',
					$rate_date_id,$concrete_type_id,$raw_material_id,$rate);				
					//throw new Exception($q);
					$link_master->query($q);
				}
			}
		}
		
	}
}
?>
