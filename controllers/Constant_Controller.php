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
class Constant_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtString('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtString('id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('name'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('descr'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('val'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtString('id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('ConstantList_Model');

			
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
		
		$this->setListModelId('ConstantList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtString('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('ConstantList_Model');		

			
		$pm = new PublicMethod('get_values');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('id_list',$opts));
	
			
		$this->addPublicMethod($pm);

		
	}
	public function get_values(){
		$link = $this->getDbLink();
		$model = new ModelSQL($link,array('id'=>'ConstantList_Model'));
		$model->addField(new FieldSQL($link,null,null,'id',DT_STRING));
		$model->addField(new FieldSQL($link,null,null,'val',DT_STRING));	
		
		$pm = $this->getPublicMethod('get_values');
		$id_list = $pm->getParamValue('id_list');
		$q = '';
		if (isset($id_list)){
			$ids = explode(',',$id_list);
			foreach($ids as $id) {
				if ($q!=''){
					$q.=' UNION ALL ';
				}			
				$q.=sprintf("SELECT
				'%s' AS id,val::text
				FROM const_%s",
				$id,$id);
			}
		}
		$model->setSelectQueryText($q);
		$model->select(false,null,null,
			null,null,null,null,null,TRUE);
		//
		$this->addModel($model);					
	}
	public function set_value($pm){
		$link = $this->getDbLinkMaster();
		$link->query(sprintf(
		"SELECT const_%s_set_val('%s')",
		$pm->getParamValue('id'),$pm->getParamValue('val')));
	}
}
?>
