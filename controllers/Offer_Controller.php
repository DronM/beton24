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

class Offer_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('client_id'
				,array(
				'alias'=>'клиент'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('destination_id'
				,array(
				'alias'=>'Направление'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('concrete_type_id'
				,array(
				'alias'=>'Марка бетона'
			));
		$pm->addParam($param);
		
				$param = new FieldExtEnum('unload_type',',','pump,band,none'
				,array(
				'alias'=>'Прокачка'
			));
		$pm->addParam($param);
		$param = new FieldExtText('comment_text'
				,array(
				'alias'=>'Комментарий'
			));
		$pm->addParam($param);
		$param = new FieldExtText('descr'
				,array(
				'alias'=>'Описание'
			));
		$pm->addParam($param);
		$param = new FieldExtDateTimeTZ('date_time'
				,array('required'=>TRUE,
				'alias'=>'Дата'
			));
		$pm->addParam($param);
		$param = new FieldExtDateTimeTZ('date_time_to'
				,array(
				'alias'=>'Время до'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('quant'
				,array(
				'alias'=>'Количество'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('unload_speed'
				,array(
				'alias'=>'Разгрузка куб/ч'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('user_id'
				,array(
				'alias'=>'Автор'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('lang_id'
				,array(
				'alias'=>'Язык'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('total'
				,array(
				'alias'=>'Сумма'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('concrete_price'
				,array(
				'alias'=>'Стоимость'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('destination_price'
				,array(
				'alias'=>'Стоимость дост.'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('unload_price'
				,array(
				'alias'=>'Стоимость прокачки'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('pump_vehicle_id'
				,array(
				'alias'=>'Насос'
			));
		$pm->addParam($param);
		$param = new FieldExtBool('pay_cash'
				,array(
				'alias'=>'Оплата на месте'
			));
		$pm->addParam($param);
		$param = new FieldExtBool('total_edit'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('payed'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('under_control'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('temp'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('address'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('contact_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('def_call_reply_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtString('call_id'
				,array());
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('Offer_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('client_id'
				,array(
			
				'alias'=>'клиент'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('destination_id'
				,array(
			
				'alias'=>'Направление'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('concrete_type_id'
				,array(
			
				'alias'=>'Марка бетона'
			));
			$pm->addParam($param);
		
				$param = new FieldExtEnum('unload_type',',','pump,band,none'
				,array(
			
				'alias'=>'Прокачка'
			));
			$pm->addParam($param);
		$param = new FieldExtText('comment_text'
				,array(
			
				'alias'=>'Комментарий'
			));
			$pm->addParam($param);
		$param = new FieldExtText('descr'
				,array(
			
				'alias'=>'Описание'
			));
			$pm->addParam($param);
		$param = new FieldExtDateTimeTZ('date_time'
				,array(
			
				'alias'=>'Дата'
			));
			$pm->addParam($param);
		$param = new FieldExtDateTimeTZ('date_time_to'
				,array(
			
				'alias'=>'Время до'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('quant'
				,array(
			
				'alias'=>'Количество'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('unload_speed'
				,array(
			
				'alias'=>'Разгрузка куб/ч'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('user_id'
				,array(
			
				'alias'=>'Автор'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('lang_id'
				,array(
			
				'alias'=>'Язык'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('total'
				,array(
			
				'alias'=>'Сумма'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('concrete_price'
				,array(
			
				'alias'=>'Стоимость'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('destination_price'
				,array(
			
				'alias'=>'Стоимость дост.'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('unload_price'
				,array(
			
				'alias'=>'Стоимость прокачки'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('pump_vehicle_id'
				,array(
			
				'alias'=>'Насос'
			));
			$pm->addParam($param);
		$param = new FieldExtBool('pay_cash'
				,array(
			
				'alias'=>'Оплата на месте'
			));
			$pm->addParam($param);
		$param = new FieldExtBool('total_edit'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('payed'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('under_control'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('temp'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('address'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('contact_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('def_call_reply_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtString('call_id'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('Offer_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('Offer_Model');

			
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
		
		$this->setListModelId('OfferList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('OfferList_Model');		

		
	}	
	
}
?>
