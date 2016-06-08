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

class SMSForSending_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Управление очередью СМС сообщений.*/

			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtString('tel'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('body'
				,array());
		$pm->addParam($param);
		$param = new FieldExtDateTime('date_time'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('sent'
				,array());
		$pm->addParam($param);
		$param = new FieldExtDateTime('sent_date_time'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('delivered'
				,array());
		$pm->addParam($param);
		$param = new FieldExtDateTime('delivered_date_time'
				,array());
		$pm->addParam($param);
		
				$param = new FieldExtEnum('sms_type',',','order,ship,remind,procur,order_for_pump_ins,order_for_pump_upd,order_for_pump_del,remind_for_pump'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('sms_id'
				,array());
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('SMSForSending_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtString('tel'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('body'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtDateTime('date_time'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('sent'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtDateTime('sent_date_time'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('delivered'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtDateTime('delivered_date_time'
				,array(
			));
			$pm->addParam($param);
		
				$param = new FieldExtEnum('sms_type',',','order,ship,remind,procur,order_for_pump_ins,order_for_pump_upd,order_for_pump_del,remind_for_pump'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('sms_id'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('SMSForSending_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('SMSForSending_Model');

			
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
		
		$this->setListModelId('SMSForSending_Model');
		
		
	}	
	
}
?>
