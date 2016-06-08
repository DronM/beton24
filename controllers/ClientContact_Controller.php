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
require_once(FRAME_WORK_PATH.'basic_classes/PublicMethod.php');
require_once(USER_CONTROLLERS_PATH.'Contact_Controller.php');

class ClientContact_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Соединяет контакты с клиентами*/

			
		$pm = new PublicMethod('insert_contact');
		
				
	/*Добавляет новый контакт заданному клиенту*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('client_id',$opts));
	
				
	$opts=array();
	
		$opts['length']=50;				
		$pm->addParam(new FieldExtString('first_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=50;				
		$pm->addParam(new FieldExtString('middle_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=50;
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('last_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=100;				
		$pm->addParam(new FieldExtString('post',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtText('description',$opts));
	
				
	$opts=array();
	
		$opts['value']=FALSE;				
		$pm->addParam(new FieldExtBool('main',$opts));
	
				
	$opts=array();
	
		$opts['value']=FALSE;				
		$pm->addParam(new FieldExtBool('ret_id',$opts));
	
			
		$this->addPublicMethod($pm);
						
			
		$pm = new PublicMethod('set_main');
		
				
	/*Устанавливает признак основного у контакта*/

				
	$opts=array();
			
		$pm->addParam(new FieldExtInt('client_id',$opts));
				
				
	$opts=array();
			
		$pm->addParam(new FieldExtInt('contact_id',$opts));
				
			
		$this->addPublicMethod($pm);

			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('client_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('contact_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('main'
				,array());
		$pm->addParam($param);
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('ClientContact_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_client_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('old_contact_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('client_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('contact_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('main'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('client_id',array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('contact_id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('ClientContact_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('client_id'
		));		
		
		$pm->addParam(new FieldExtInt('contact_id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('ClientContact_Model');

			
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
		
		$this->setListModelId('ClientContactList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('client_id'
		));
		
		$pm->addParam(new FieldExtInt('contact_id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('ClientContactList_Model');		

		
	}	
	
	public function insert_contact($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{				
			$contr = new Contact_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('last_name',$pm->getParamValue('last_name'));
			$meth->setParamValue('first_name',$pm->getParamValue('first_name'));
			$meth->setParamValue('middle_name',$pm->getParamValue('middle_name'));
			$meth->setParamValue('post',$pm->getParamValue('post'));
			$meth->setParamValue('description',$pm->getParamValue('description'));
			$ar = $contr->insert($meth);
			
			$meth = $this->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('contact_id',$ar['id']);
			$meth->setParamValue('client_id',$pm->getParamValue('client_id'));
			$meth->setParamValue('main',$pm->getParamValue('main'));
			parent::insert($pm);
			
			if ($pm->getParamValue('ret_id')){
				$fields = array();
				array_push($fields,new Field('client_id',DT_STRING,array('value'=>$pm->getParamValue('client_id'))));
				array_push($fields,new Field('contact_id',DT_STRING,array('value'=>$ar['id'])));
				$this->addModel(new ModelVars(
					array('id'=>'LastIds',
						'values'=>$fields)
					)
				);				
			}
			
			$link->query("COMMIT");			
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			throw $e;
		}		
	}	
	public function set_main($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{
			$link->query(sprtinf(
			"UPDATE client_contacts
			SET main=FALSE
			WHERE client_id=%d
			AND main=TRUE",
			$p->getDbVal('client_id')
			));
			//new
			$link->query(sprtinf(
			"UPDATE client_contacts
			SET main=TRUE
			WHERE client_id=%d AND contact_id=%d",
			$p->getDbVal('client_id'),
			$p->getDbVal('contact_id')
			));			
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			throw $e;
		}			
	}

}
?>
