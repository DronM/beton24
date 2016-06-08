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
require_once(USER_CONTROLLERS_PATH.'ContactDetail_Controller.php');
require_once(USER_CONTROLLERS_PATH.'Driver_Controller.php');

class DriverContactDetail_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Соединяет контактную информацию с водителем*/

			
		$pm = new PublicMethod('insert_contact_detail');
		
				
	/*Добавляет новую контактную информацтю заданному водителю*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('driver_id',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('name',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtString('value',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtBool('main',$opts));
	
				
	$opts=array();
					
		$pm->addParam(new FieldExtEnum('contact_type',$opts));
	
				
	$opts=array();
	
		$opts['value']=FALSE;				
		$pm->addParam(new FieldExtBool('ret_id',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('set_main');
		
				
	/*Устанавливает признак основного у контактной информации*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('driver_id',$opts));
				
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('contact_detail_id',$opts));
				
			
		$this->addPublicMethod($pm);
			
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('driver_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('contact_detail_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('main'
				,array());
		$pm->addParam($param);
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('DriverContactDetail_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_driver_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('old_contact_detail_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('driver_id'
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
		
			$param = new FieldExtInt('driver_id',array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('contact_detail_id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('DriverContactDetail_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('driver_id'
		));		
		
		$pm->addParam(new FieldExtInt('contact_detail_id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('DriverContactDetail_Model');

			
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
		
		$this->setListModelId('DriverContactDetailList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('driver_id'
		));
		
		$pm->addParam(new FieldExtInt('contact_detail_id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('DriverContactDetailList_Model');		

			
		$pm = new PublicMethod('insert_driver_with_contact_detail');
		
				
	/*Добавляет водителя и контактную информацию*/

				
	$opts=array();
	
		$opts['length']=50;
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('name',$opts));
	
				
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
			
		
	}	
	
	public function insert_contact_detail($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
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
			$meth->setParamValue('driver_id',$pm->getParamValue('driver_id'));
			$meth->setParamValue('main',$pm->getParamValue('main'));
			parent::insert($pm);

			if ($pm->getParamValue('ret_id')){
				$fields = array();
				array_push($fields,new Field('driver_id',DT_STRING,array('value'=>$pm->getParamValue('driver_id'))));
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
	public function set_main($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{
			//old mains
			$link->query(sprintf(
			"UPDATE driver_contact_details u
				SET main=FALSE
			FROM (
        		SELECT  cd.id
        		FROM driver_contact_details AS ccd
				LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
        		WHERE ccd.driver_id=%d AND ccd.main=TRUE
					AND cd.contact_type=(
						SELECT contact_type FROM contact_details WHERE id=%d
						)
    			) s
			WHERE s.id=u.contact_detail_id",
			$p->getDbVal('driver_id'),
			$p->getDbVal('contact_detail_id')
			));
	
			//new main
			$link->query(sprintf(
			"UPDATE driver_contact_details
				SET main=TRUE
			WHERE driver_id=%d
				AND contact_detail_id=%d",
			$p->getDbVal('driver_id'),
			$p->getDbVal('contact_detail_id')
			));			
			
			$link->query('COMMIT');
		}
		catch(Exception $e){
			$link->query('ROLLBACK');
			throw $e;
		}			
	}
	public function insert_driver_with_contact_detail($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$link = $this->getDbLinkMaster();
		$link->query('BEGIN');
		try{
			//новый клиент
			/*
			$contr = new Driver_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('name',$pm->getParamValue('name'));
			$ar = $contr->insert($meth);
			$driver_id = $ar['id'];
			*/
			$ar = $link->query_first(sprintf(
			"INSERT INTO drivers (name) VALUES (%s) RETURNING id",
			$p->getDbVal('name')
			));
			$driver_id = $ar['id'];
			//throw new Exception("driver_id=".$driver_id);
	
			//новая контактная инф
			$contr = new ContactDetail_Controller($link,$link);
			$meth = $contr->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('ret_id','1');
			$meth->setParamValue('name',$pm->getParamValue('detail_name'));
			$meth->setParamValue('value',$pm->getParamValue('detail_value'));
			$meth->setParamValue('contact_type',$pm->getParamValue('detail_contact_type'));
			$ar = $contr->insert($meth);
			$contact_detail_id = $ar['id'];
			
			//throw new Exception("driver_id=".$driver_id.' contact_detail_id='.$contact_detail_id);
			//связывание
			$meth = $this->getPublicMethod(ControllerDb::METH_INSERT);
			$meth->setParamValue('contact_detail_id',$contact_detail_id);
			$meth->setParamValue('driver_id',$driver_id);
			$meth->setParamValue('main',$pm->getParamValue('main'));
			parent::insert($pm);
			
			if ($pm->getParamValue('ret_id')){
				$fields = array();
				array_push($fields,new Field('driver_id',DT_STRING,array('value'=>$driver_id)));
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


}
?>
