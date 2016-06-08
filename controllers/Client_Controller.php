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
require_once(USER_MODELS_PATH.'ClientWithDetailsList_Model.php');

class Client_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtString('name'
				,array('required'=>TRUE,
				'alias'=>'Наименование'
			));
		$pm->addParam($param);
		$param = new FieldExtText('name_full'
				,array(
				'alias'=>'Полное наименование'
			));
		$pm->addParam($param);
		$param = new FieldExtText('manager_comment'
				,array(
				'alias'=>'Комментарий'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('client_type_id'
				,array(
				'alias'=>'Вид контрагента'
			));
		$pm->addParam($param);
		
				$param = new FieldExtEnum('client_kind',',','buyer,acc,else'
				,array(
				'alias'=>'Тип контрагента'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('client_come_from_id'
				,array(
				'alias'=>'Источник обращения'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('manager_id'
				,array(
				'alias'=>'Менеджер'
			));
		$pm->addParam($param);
		$param = new FieldExtDate('create_date'
				,array());
		$pm->addParam($param);
		$param = new FieldExtString('inn'
				,array(
				'alias'=>'ИНН'
			));
		$pm->addParam($param);
		$param = new FieldExtString('kpp'
				,array(
				'alias'=>'КПП'
			));
		$pm->addParam($param);
		$param = new FieldExtString('orgn'
				,array(
				'alias'=>'ОГРН'
			));
		$pm->addParam($param);
		$param = new FieldExtString('okpo'
				,array(
				'alias'=>'ОКПО'
			));
		$pm->addParam($param);
		$param = new FieldExtText('address_reg'
				,array(
				'alias'=>'Адрес регистрации'
			));
		$pm->addParam($param);
		$param = new FieldExtText('address_fact'
				,array(
				'alias'=>'Адрес фактический'
			));
		$pm->addParam($param);
		$param = new FieldExtText('address_post'
				,array(
				'alias'=>'Адрес почтовый'
			));
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('Client_Model');

			
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
		$param = new FieldExtText('name_full'
				,array(
			
				'alias'=>'Полное наименование'
			));
			$pm->addParam($param);
		$param = new FieldExtText('manager_comment'
				,array(
			
				'alias'=>'Комментарий'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('client_type_id'
				,array(
			
				'alias'=>'Вид контрагента'
			));
			$pm->addParam($param);
		
				$param = new FieldExtEnum('client_kind',',','buyer,acc,else'
				,array(
			
				'alias'=>'Тип контрагента'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('client_come_from_id'
				,array(
			
				'alias'=>'Источник обращения'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('manager_id'
				,array(
			
				'alias'=>'Менеджер'
			));
			$pm->addParam($param);
		$param = new FieldExtDate('create_date'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtString('inn'
				,array(
			
				'alias'=>'ИНН'
			));
			$pm->addParam($param);
		$param = new FieldExtString('kpp'
				,array(
			
				'alias'=>'КПП'
			));
			$pm->addParam($param);
		$param = new FieldExtString('orgn'
				,array(
			
				'alias'=>'ОГРН'
			));
			$pm->addParam($param);
		$param = new FieldExtString('okpo'
				,array(
			
				'alias'=>'ОКПО'
			));
			$pm->addParam($param);
		$param = new FieldExtText('address_reg'
				,array(
			
				'alias'=>'Адрес регистрации'
			));
			$pm->addParam($param);
		$param = new FieldExtText('address_fact'
				,array(
			
				'alias'=>'Адрес фактический'
			));
			$pm->addParam($param);
		$param = new FieldExtText('address_post'
				,array(
			
				'alias'=>'Адрес почтовый'
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			
				'alias'=>'Код'
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('Client_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('Client_Model');

			
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
		
		$this->setListModelId('ClientList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('ClientDialog_Model');		

			
		/* complete  */
		$pm = new PublicMethod('complete');
		$pm->addParam(new FieldExtString('pattern'));
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('ic'));
		$pm->addParam(new FieldExtInt('mid'));
		$pm->addParam(new FieldExtString('name'));		
		$this->addPublicMethod($pm);					
		$this->setCompleteModelId('Client_Model');

			
		$pm = new PublicMethod('union');
		
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('main_client_id',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('client_ids',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('set_duplicate_valid');
		
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('tel',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('client_ids',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('get_duplicates_list');
		
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('from',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('count',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('ord_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('ord_directs',$opts));
				
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('get_contact_details_list');
		
				
	/*Возвращает клиентов с детальной информацией*/

				
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
					
		$pm->addParam(new FieldExtInt('from',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('count',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('ord_fields',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('ord_directs',$opts));
								
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('from',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('count',$opts));
					
			
		$this->addPublicMethod($pm);

			
		
	}
	public function union($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->addAll();		
		
		$client_ids = $params->getVal('client_ids');
		//validation
		$ids_ar = split(',',$client_ids);
		foreach($ids_ar as $id){
			if (!ctype_digit($id)){
				throw new Exception('Not int found!');
			}
		}
		
		$this->getDbLinkMaster()->query(sprintf(
		//throw new Exception(sprintf(
			"SELECT clients_union(%d,ARRAY[%s])",
			$params->getParamById('main_client_id'),
			$client_ids
		));
	}
	public function set_duplicate_valid($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->addAll();		
		
		$client_ids = $params->getVal('client_ids');
		$tel = $params->getDbVal('tel');
		
		//validation
		$ids_ar = split(',',$client_ids);
		foreach($ids_ar as $id){
			if (!ctype_digit($id)){
				throw new Exception('Not int found!');
			}
		}
		$l = $this->getDbLinkMaster();
		foreach($ids_ar as $id){
			$l->query(sprintf(
				"INSERT INTO client_valid_duplicates
				(tel,client_id)
				VALUES (%s,%d)",
				$tel,
				$id
			));
		}
	}
	
	
	public function get_contact_details_list($pm){
		$model = new ClientWithDetailsList_Model($this->getDbLink());
		$from = null; $count = null;
		$limit = $this->limitFromParams($pm,$from,$count);
		$calc_total = ($count>0);
		if ($from){
			$model->setListFrom($from);
		}
		if ($count){
			$model->setRowsPerPage($count);
		}
		
		$order = $this->orderFromParams($pm,$model);
		$where = $this->conditionFromParams($pm,$model);
		$fields = $this->fieldsFromParams($pm);		
		$model->select(FALSE,$where,$order,
			$limit,$fields,NULL,NULL,
			$calc_total,TRUE);
		$this->addModel($model);		
	}
	
	public function get_duplicates_list($pm){
		$this->addNewModel("SELECT * FROM client_duplicates_list",
			'get_duplicates_list'
		);
	}

	public function insert($pm){
		if (!$pm->getParamValue('manager_id')){
			$pm->setParamValue('manager_id',$_SESSION['user_id']);
		}
		parent::insert($pm);				
	}
	

}
?>
