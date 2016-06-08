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

require_once(USER_CONTROLLERS_PATH.'Contact_Controller.php');
require_once(USER_CONTROLLERS_PATH.'ContactDetail_Controller.php');

class ContactContactDetail_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Соединяет контакты с контактной информацией*/

			
		$pm = new PublicMethod('insert_contact_detail');
		
				
	/*Добавляет новую контактную информацтю заданному контакту*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('contact_id',$opts));
	
				
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('name',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('value',$opts));
	
				
	$opts=array();
	
		$opts['value']=FALSE;				
		$pm->addParam(new FieldExtBool('main',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtEnum('contact_type',$opts));
	
				
	$opts=array();
	
		$opts['value']=FALSE;				
		$pm->addParam(new FieldExtBool('ret_id',$opts));
	
			
		$this->addPublicMethod($pm);
									
			
		$pm = new PublicMethod('insert_contact_with_contact_detail');
		
				
	/*Добавляет контакт и контактную информацию*/

				
	$opts=array();
	
		$opts['length']=50;
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('first_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=50;				
		$pm->addParam(new FieldExtString('middle_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=50;				
		$pm->addParam(new FieldExtString('last_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=100;				
		$pm->addParam(new FieldExtString('post',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtText('description',$opts));
					
				
	$opts=array();
	
		$opts['length']=50;				
		$pm->addParam(new FieldExtString('detail_contact_type',$opts));
	
				
	$opts=array();
	
		$opts['length']=100;				
		$pm->addParam(new FieldExtString('detail_name',$opts));
	
				
	$opts=array();
	
		$opts['length']=100;				
		$pm->addParam(new FieldExtString('detail_value',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtBool('main',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtBool('ret_id',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('set_main');
		
				
	/*Устанавливает признак основного у контактной информации*/

				
	$opts=array();
			
		$pm->addParam(new FieldExtInt('contact_id',$opts));
				
				
	$opts=array();
			
		$pm->addParam(new FieldExtInt('contact_detail_id',$opts));
				
			
		$this->addPublicMethod($pm);
			
			
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('contact_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('contact_detail_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('main'
				,array());
		$pm->addParam($param);
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('ContactContactDetail_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_contact_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('old_contact_detail_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('contact_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('contact_detail_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('main'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('contact_id',array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('contact_detail_id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('ContactContactDetail_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('contact_id'
		));		
		
		$pm->addParam(new FieldExtInt('contact_detail_id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('ContactContactDetail_Model');

			
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
		
		$this->setListModelId('ContactContactDetailList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('contact_id'
		));
		
		$pm->addParam(new FieldExtInt('contact_detail_id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('ContactContactDetailList_Model');		

		
	}	
	
	public function insert_contact_detail($pm){
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{				
			$contr = new ContactDetail_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('name',$pm->getParamValue('name'));
			$meth->setParamValue('value',$pm->getParamValue('value'));
			$meth->setParamValue('contact_type',$pm->getParamValue('contact_type'));
			$ar = $contr->insert($meth);
			
			$meth = $this->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('contact_detail_id',$ar['id']);
			$meth->setParamValue('contact_id',$pm->getParamValue('contact_id'));
			$meth->setParamValue('main',$pm->getParamValue('main'));
			parent::insert($pm);
			
			if ($pm->getParamValue('ret_id')){
				$fields = array();
				array_push($fields,new Field('contact_id',DT_STRING,array('value'=>$pm->getParamValue('contact_id'))));
				array_push($fields,new Field('contact_detail_id',DT_STRING,array('value'=>$ar['id'])));
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
	public function insert_contact_with_contact_detail($pm){
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{	
			//новая контактная инф
			$contr = new ContactDetail_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('name',$pm->getParamValue('detail_name'));
			$meth->setParamValue('value',$pm->getParamValue('detail_value'));
			$meth->setParamValue('contact_type',$pm->getParamValue('detail_contact_type'));
			$ar = $contr->insert($meth);
			$contact_detail_id = $ar['id'];
			
			//новый контакт
			$contr = new Contact_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('first_name',$pm->getParamValue('first_name'));
			$meth->setParamValue('middle_name',$pm->getParamValue('middle_name'));
			$meth->setParamValue('last_name',$pm->getParamValue('last_name'));
			$meth->setParamValue('post',$pm->getParamValue('post'));
			$meth->setParamValue('description',$pm->getParamValue('description'));
			$ar = $contr->insert($meth);
			$contact_id = $ar['id'];
			
			//связывание
			$meth = $this->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('contact_detail_id',$contact_detail_id);
			$meth->setParamValue('contact_id',$contact_id);
			$meth->setParamValue('main',$pm->getParamValue('main'));
			parent::insert($pm);
			
			if ($pm->getParamValue('ret_id')){
				$fields = array();
				array_push($fields,new Field('contact_id',DT_STRING,array('value'=>$contact_id)));
				array_push($fields,new Field('contact_detail_id',DT_STRING,array('value'=>$contact_detail_id)));
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
			//old mains
			$link->query(sprintf(
			"UPDATE contact_contact_details u
				SET main=FALSE
			FROM (
        		SELECT  cd.id
        		FROM contact_contact_details AS ccd
				LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
        		WHERE ccd.contact_id=%d AND ccd.main=TRUE
					AND cd.contact_type=(
						SELECT contact_type FROM contact_details WHERE id=%d
						)
    			) s
			WHERE s.id=u.contact_detail_id",
			$p->getDbVal('contact_id'),
			$p->getDbVal('contact_detail_id')
			));
	
			//new main
			$link->query(sprintf(
			"UPDATE contact_contact_details
				SET main=TRUE
			WHERE contact_id=%d
				AND contact_detail_id=%d",
			$p->getDbVal('contact_id'),
			$p->getDbVal('contact_detail_id')
			));			
			
			$link->query('COMMIT');
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			throw $e;
		}			
	}
	

}
?>
