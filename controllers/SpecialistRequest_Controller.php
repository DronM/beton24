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
require_once("common/SMSService.php");

class SpecialistRequest_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Управление вызовами специалиста. При добавлении происходит поиск контрагента по базе контактов. Если есть такой контакт, то происходит привязка вызова к контрагенту. Актуально при добавлении вызова с сайта, когда пользователь вносит только телефон.*/

			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtDateTime('date_time'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('name'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('comment'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('tel'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('viewed'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('client_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('manager_comment'
				,array());
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('SpecialistRequest_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtDateTime('date_time'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('name'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('comment'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('tel'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('viewed'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('client_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('manager_comment'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('SpecialistRequest_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('SpecialistRequest_Model');
				
			
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
		
		$this->setListModelId('SpecialistRequestList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('SpecialistRequestList_Model');		

			
		$pm = new PublicMethod('set_viewed');
		
				
	/*Пометить вызов как просмотренный*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('doc_id',$opts));
	
			
		$this->addPublicMethod($pm);
			
		
	}	
	
	public function set_viewed($pm){
		$par = new ParamsSQL($pm,$this->getDbLink());
		$par->add('doc_id',DT_INT,$pm->getParamValue('doc_id'));
		$this->getDbLinkMaster()->query(sprintf(
		"UPDATE specialist_requests
		SET viewed=TRUE
		WHERE id=%d",
		$par->getParamById('doc_id')
		));	
	}
	public function update($pm){
		$pm->setParamValue('viewed','true');
		parent::update($pm);
	}
	public function insert($pm){
		$pm->setParamValue('viewed','true');
		parent::insert($pm);
		
		$par = new ParamsSQL($pm,$this->getDbLink());
		$par->addAll();
		
		//sms ответственному
		$ph_ar = explode(',',PHONES_FOR_NEW_PUMP_ORDER);
		$sms = new SMSService(SMS_LOGIN,SMS_PWD);				
		foreach ($ph_ar as $ph){
			$t = sprintf("Заявка на спец.%s,%s,%s,%s",
				date('d/m H:i',$par->getVal('date_time')),
				$par->getVal('name'),
				$par->getVal('tel'),
				$par->getVal('comment')
			);				
			$sms->send($ph,$t,SMS_SIGN);			
		}
		
	}
	

}
?>
