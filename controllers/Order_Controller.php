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
require_once('controllers/Widget_Controller.php');
require_once('models/OrderMakeList_Model.php');
require_once('models/ConcreteType_Model.php');
require_once('models/Lang_Model.php');
require_once('common/SMSService.php');
require_once('common/MyDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDate.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTimeTZ.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');

require_once('models/OrderCountList_Model.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldExtDateTimeTZ.php');

class Order_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Контроллер работы с заявками.*/

			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('client_id'
				,array(
				'alias'=>'клиент'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('concrete_type_id'
				,array(
				'alias'=>'Марка бетона'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('concrete_price'
				,array(
				'alias'=>'Стоимость'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('contact_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('destination_id'
				,array(
				'alias'=>'Направление'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('destination_price'
				,array(
				'alias'=>'Стоимость дост.'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('pump_vehicle_id'
				,array(
				'alias'=>'Насос'
			));
		$pm->addParam($param);
		$param = new FieldExtInt('user_id'
				,array(
				'alias'=>'Автор'
			));
		$pm->addParam($param);
		$param = new FieldExtText('address'
				,array());
		$pm->addParam($param);
		$param = new FieldExtText('comment_text'
				,array(
				'alias'=>'Комментарий'
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
		$param = new FieldExtInt('order_temp_comment_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('pay_cash'
				,array(
				'alias'=>'Оплата на месте'
			));
		$pm->addParam($param);
		$param = new FieldExtBool('payed'
				,array());
		$pm->addParam($param);
		$param = new FieldExtFloat('quant'
				,array(
				'alias'=>'Количество'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('quant_init'
				,array(
				'alias'=>'Количество начальное'
			));
		$pm->addParam($param);
		$param = new FieldExtBool('temp'
				,array());
		$pm->addParam($param);
		$param = new FieldExtFloat('total'
				,array(
				'alias'=>'Сумма'
			));
		$pm->addParam($param);
		$param = new FieldExtBool('total_edit'
				,array());
		$pm->addParam($param);
		$param = new FieldExtBool('under_control'
				,array());
		$pm->addParam($param);
		$param = new FieldExtFloat('unload_price'
				,array(
				'alias'=>'Стоимость прокачки'
			));
		$pm->addParam($param);
		$param = new FieldExtFloat('unload_speed'
				,array(
				'alias'=>'Разгрузка куб/ч'
			));
		$pm->addParam($param);
		
				$param = new FieldExtEnum('unload_type',',','pump,band,none'
				,array(
				'alias'=>'Прокачка'
			));
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('Order_Model');

			
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
		$param = new FieldExtInt('concrete_type_id'
				,array(
			
				'alias'=>'Марка бетона'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('concrete_price'
				,array(
			
				'alias'=>'Стоимость'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('contact_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('destination_id'
				,array(
			
				'alias'=>'Направление'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('destination_price'
				,array(
			
				'alias'=>'Стоимость дост.'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('pump_vehicle_id'
				,array(
			
				'alias'=>'Насос'
			));
			$pm->addParam($param);
		$param = new FieldExtInt('user_id'
				,array(
			
				'alias'=>'Автор'
			));
			$pm->addParam($param);
		$param = new FieldExtText('address'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtText('comment_text'
				,array(
			
				'alias'=>'Комментарий'
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
		$param = new FieldExtInt('order_temp_comment_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('pay_cash'
				,array(
			
				'alias'=>'Оплата на месте'
			));
			$pm->addParam($param);
		$param = new FieldExtBool('payed'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('quant'
				,array(
			
				'alias'=>'Количество'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('quant_init'
				,array(
			
				'alias'=>'Количество начальное'
			));
			$pm->addParam($param);
		$param = new FieldExtBool('temp'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('total'
				,array(
			
				'alias'=>'Сумма'
			));
			$pm->addParam($param);
		$param = new FieldExtBool('total_edit'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtBool('under_control'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('unload_price'
				,array(
			
				'alias'=>'Стоимость прокачки'
			));
			$pm->addParam($param);
		$param = new FieldExtFloat('unload_speed'
				,array(
			
				'alias'=>'Разгрузка куб/ч'
			));
			$pm->addParam($param);
		
				$param = new FieldExtEnum('unload_type',',','pump,band,none'
				,array(
			
				'alias'=>'Прокачка'
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('Order_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('Order_Model');

			
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
		
		$this->setListModelId('OrderList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('OrderDialog_Model');		

			
		$pm = new PublicMethod('get_make_orders_list');
		
				
	/*Получает список заявок с дополнительной информацией.*/

				
	$opts=array();
			
		$pm->addParam(new FieldExtInt('id',$opts));
	
				
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

			
		$pm = new PublicMethod('get_temp_orders_list');
		
				
	/*Получает список черновых заявок.*/

			
		$this->addPublicMethod($pm);

			
			
		$pm = new PublicMethod('get_avail_spots');
		
				
	/*Получает список свободных временных позиций для размещения заявки с заданным количеством и скоростью разгрузки.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtDate('date',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtFloat('quant',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtFloat('speed',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('set_payed');
		
				
	/*Установить признак оплаты для заявки.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('id',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('set_temp');
		
				
	/*Перенести заявку в черновики.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('id',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('unset_temp');
		
				
	/*Перенести заявку из черновиков в основные. При переносе происходит проверка заполненности всех реквизитов заявки.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('id',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('get_history');
		
				
	/*Получает историю заявки.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('id',$opts));
	
			
		$this->addPublicMethod($pm);
						
			
		$pm = new PublicMethod('get_count');
		
				
	/*Получает количество заявок за заданный период, сгруппированное с заданной периодичностью.*/

				
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
			
		$pm->addParam(new FieldExtString('period',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('get_operator_list');
		
				
					
					
					
								
				
	/*Получает список отгрузок для отображения у оператора.Возвращает 3 модели одинаковой структуры.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtDate('date_time',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('operator_list_move_up');
		
				
	/*Сдвигает отгрузку вверх по очереди.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('shipment_id',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('operator_list_move_down');
		
				
	/*Сдвигает отгрузку вниз по очереди.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('shipment_id',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('operator_list_set_before');
		
				
	/*Устанавливает отгрузку перед определенной отгрузки в очереди.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('shipment_id',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('after_shipment_id',$opts));
	
			
		$this->addPublicMethod($pm);
						
			
		$pm = new PublicMethod('put_on_load');
		
				
	/*Ставит отгрузку под загрузку. Чтобы очистить место под загрузкой - отправить shipment_id=0 (null,nan)*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('shipment_id',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('set_shipped');
		
				
	/*Отгружает заявку, которая находится под загрузкой.*/

			
		$this->addPublicMethod($pm);
			
			
		$pm = new PublicMethod('unset_shipped');
		
				
	/*Отменяет отгрузку.*/

				
	$opts=array();
					
		$pm->addParam(new FieldExtInt('shipment_id',$opts));
	
			
		$this->addPublicMethod($pm);
						
			
		
	}
	
	public function send_messages($id,$phone_cel,$quant,$total,
		$date_time,$concrete_type_id,$destination_id,
		$lang_id, $pumpVehicleId, $order_update){
		//SMS service		
		if (SMS_ACTIVE&&(strlen($phone_cel)||$pumpVehicleId!='null')){
			$dbLink = $this->getDbLink();
			$dbLinkMaster = $this->getDbLinkMaster();
			
			$sms_service = NULL;
			
			if (strlen($phone_cel)){
				//date + rout time
				$date_time_str = NULL;
				FieldSQLDateTime::formatForDb($date_time,$date_time_str);
				$ar = $dbLink->query_first(sprintf(
				"SELECT %s::timestamp + coalesce(time_route,'00:00'::time) AS date_time
				FROM destinations WHERE id=%d",
				$date_time_str,$destination_id)
				);
				if ($ar){
					$date_time = strtotime($ar['date_time']);
				}
				$lang_id = intval($lang_id);
				$lang_id = ($lang_id==0)? 1:$lang_id;
				$ar = $dbLink->query_first(sprintf(
				"SELECT pattern AS text
				FROM sms_patterns
				WHERE sms_type='order'::sms_types AND lang_id=%d",
				$lang_id));
				if (!is_array($ar) || count($ar)==0){
					throw new Exception('Шаблон для SMS не найден!');
				}
				$text = str_replace('[quant]',$quant,$ar['text']);
				$total_repl= ($total)? ' стоимость:'.$total:'';
				$text = str_replace('[total]',$total_repl,$text);
				$text = str_replace('[time]',date('H:i',$date_time),$text);
				$text = str_replace('[date]',date('d/m/y',$date_time),$text);
				$text = str_replace('[day_of_week]',MyDate::getRusDayOfWeek($date_time),$text);
				
				$is_dest = (strpos($text,'[dest]')>=0);
				$is_concr = (strpos($text,'[concrete]')>=0);
				if ($is_dest || $is_concr){
					$q = 'SELECT ';
					if ($is_dest){
						$q.='(SELECT name FROM destinations WHERE id='.$destination_id.') AS dest';
					}
					if ($is_concr){
						if ($is_dest){
							$q.=',';
						}
						$q.='(SELECT name FROM concrete_types WHERE id='.$concrete_type_id.') AS concrete';
					}
					$ar = $dbLink->query_first($q);
					foreach($ar as $key=>$val){
						$text = str_replace(sprintf('[%s]',$key),$val,$text);
					}
				}
			}
			//throw new Exception($text);
			try{
				$sms_id = NULL;
				$sms_id_pump = NULL;
				
				if (strlen($phone_cel)){
					$sms_service = new SMSService(SMS_LOGIN, SMS_PWD);
					$sms_id_resp = $sms_service->send($phone_cel,$text,SMS_SIGN,SMS_TEST);				
					FieldSQLString::formatForDb($this->getDbLink(),$sms_id_resp,$sms_id);
				}
				
				//насоснику
				if ($pumpVehicleId!='null'){
					$pump_sms_ar = $this->getDbLink()->query_first(sprintf(
					"SELECT * FROM %s
					WHERE order_id=%d",
					($order_update)? 'sms_pump_order_upd':'sms_pump_order_ins',
					$id
					));
					if (is_array($pump_sms_ar)&&count($pump_sms_ar)){
						if (is_null($sms_service)){
							$sms_service = new SMSService(SMS_LOGIN, SMS_PWD);
						}					
						$sms_id_resp_pump = $sms_service->send($pump_sms_ar['phone_cel'],$pump_sms_ar['message'],SMS_SIGN,SMS_TEST);
						FieldSQLString::formatForDb($this->getDbLink(),$sms_id_resp_pump,$sms_id_pump);									
						
						//ответственному
						if (!$order_update){
							$ph_ar = explode(',',PHONES_FOR_NEW_PUMP_ORDER);
							foreach ($ph_ar as $ph){
								$sms_service->send($ph,$pump_sms_ar['message'],SMS_SIGN);
							}		
						
						}
					}
				}
				
				$q = '';
				
				if ($order_update&&(!is_null($sms_id)||!is_null($sms_id_pump))){
					$q = sprintf("UPDATE sms_service
					SET
						sms_id_order = %s,
						order_sms_time=%s,
						sms_id_pump = %s,
						pump_sms_time=%s						
					WHERE order_id=%d",
					(is_null($sms_id))? 'NULL':$sms_id,(is_null($sms_id))? 'NULL':"'".date('Y-m-d H:i:s')."'",
					(is_null($sms_id_pump))? 'NULL':$sms_id_pump,(is_null($sms_id_pump))? 'NULL':"'".date('Y-m-d H:i:s')."'",
					$id);
				}
				else if (!$order_update&&(!is_null($sms_id)||!is_null($sms_id_pump))){
					$q = sprintf("INSERT INTO sms_service
					(order_id,shipment_id,
					sms_id_order,order_sms_time,
					sms_id_pump,pump_sms_time)
					VALUES (%d,0,%s,%s,%s,%s)",
					$id,
					(is_null($sms_id))? 'NULL':$sms_id,(is_null($sms_id))? 'NULL':"'".date('Y-m-d H:i:s')."'",
					(is_null($sms_id_pump))? 'NULL':$sms_id_pump,(is_null($sms_id_pump))? 'NULL':"'".date('Y-m-d H:i:s')."'"
					);
				}
				
				if (!is_null($sms_id)||!is_null($sms_id_pump)){
					$dbLinkMaster->query($q);
				}
				$sms_res_str = '';
				$sms_res_ok = 1;
			}
			catch (Exception $e){
				$sms_res_str = $e->getMessage();
				$sms_res_ok = 0;
			}
		}
		else{
			$sms_res_str = 'Сервис SMS выключен.';
			$sms_res_ok = 0;
		}
		
		$this->addModel(new ModelVars(
			array('id'=>'SMSSend',
				'values'=>array(
					new Field('sent',DT_INT,
						array('value'=>$sms_res_ok))
					,					
					new Field('resp',DT_STRING,
						array('value'=>$sms_res_str))
					)
				)
			)
		);		
	}
	public function update($pm){		
		$dbLink = $this->getDbLink();
		$p = new ParamsSQL($pm,$dbLink);
		$p->addAll();
		
		$ar = $dbLink->query_first(sprintf(
			"SELECT
				o.date_time,
				o.quant,
				o.pay_cash,
				CASE WHEN o.pay_cash THEN o.total ELSE 0 END AS total,
				o.unload_speed,
				o.phone_cel,
				o.concrete_type_id,
				o.destination_id,
				o.lang_id,
				COALESCE(o.pump_vehicle_id::text,'null') AS pump_vehicle_id,
				COALESCE(
				(SELECT SUM(sh.quant)>0
				FROM shipments sh
				WHERE sh.order_id=o.id
				),FALSE) AS shipped
			FROM orders AS o
			WHERE o.id=%d",$p->getDbVal('old_id'))
			);
		if (is_array($ar)){
			$old_date_time = strtotime($ar['date_time']);
			$new_date_time = $p->getVal('date_time');
			
			$rebuild_chart = 
			( (floatval($p->getVal("quant"))!=floatval($ar['quant']))
			||(intval($p->getVal('unload_speed'))!=intval($ar['unload_speed']))
			);
			if ($rebuild_chart){
				Widget_Controller::clearPlantLoadCachOnDate(
					$this->getDbLinkMaster(),"'".$ar['date_time']."'");
			}
			
			if ($new_date_time!=$old_date_time){
				Widget_Controller::clearPlantLoadCachOnDate(
					$this->getDbLinkMaster(),$p->getDbVal('date_time'));
			}			
		}	
		
		$resend_sms = 
		(
		$ar['shipped']=='f'
		&&
		( ($p->getVal("quant")&&floatval($p->getVal("quant"))!=floatval($ar['quant']))
		||($p->getVal("phone_cel")&&$p->getVal('phone_cel')!=$ar['phone_cel'])
		||($p->getVal("concrete_type_id")&&$p->getVal('concrete_type_id')!=$ar['concrete_type_id'])
		||($p->getVal("destination_id")&&$p->getVal('destination_id')!=$ar['destination_id'])
		||($p->getVal("lang_id")&& $p->getVal('lang_id')!=$ar['lang_id'])
		||($new_date_time&&$new_date_time!=$old_date_time)
		||($p->getVal("pump_vehicle_id")&& $p->getVal('pump_vehicle_id')!=$ar['pump_vehicle_id'])
		)
		);
		
		//
		$l = $this->getDbLinkMaster();
		try{				
			parent::update();
			$l->query(sprintf(
			"INSERT INTO order_log (order_id,user_id,order_event) VALUES (%d,%d,'update'::order_events)",
			$p->getDbVal('old_id'),
			$_SESSION['user_id']
			));				
		}
		catch (Exception $e){
			$l->query('ROLLBACK');
			throw $e;
		}				
		
		
		if ($resend_sms){
			//changed phone or date_time
			$id = $p->getVal("id");
			$id = (isset($id))? $id:$p->getVal("old_id");
			$destination_id = $p->getVal("destination_id");
			$destination_id = (isset($destination_id))? $destination_id:$ar['destination_id'];
			$phone_cel = $p->getVal("phone_cel");
			$phone_cel = (isset($phone_cel))? $phone_cel:$ar['phone_cel'];			
			$lang_id = $p->getVal("lang_id");
			$lang_id = (isset($lang_id))? $lang_id:$ar['lang_id'];			
			$concrete_type_id = $p->getVal("concrete_type_id");
			$concrete_type_id = (isset($concrete_type_id))? $concrete_type_id:$ar['concrete_type_id'];
			$pump_vehicle_id = $p->getVal("pump_vehicle_id");
			$pump_vehicle_id = (isset($pump_vehicle_id))? $pump_vehicle_id:$ar['pump_vehicle_id'];
			
			$quant = $p->getVal("quant");
			$quant = (isset($quant))? $quant:$ar['quant'];
			
			$total = 0;
			$pay_cash = $p->getVal("pay_cash");
			if (
				(isset($pay_cash)&&$pay_cash=='true')
				||
				(!isset($pay_cash)&&$ar['pay_cash']=='t')
			){
				$total = $p->getVal("total");
				$total = (isset($total))? $total:$ar['total'];
			}
			
			$date_time = $p->getVal("date_time");
			$date_time = (isset($date_time))? $date_time:$old_date_time;
			
			$this->send_messages(
				$id,$phone_cel,$quant,$total,$date_time,
				$concrete_type_id,$destination_id,
				$lang_id,$pump_vehicle_id,TRUE);
				
			/*Послать на удаление насоснику
			если был насос а сейчас нет,
			или был один стал другой
			*/
		}
	}
	public function delete($pm){
		/* SMS насоснику */
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->set('id',DT_INT);
		$pump_sms_ar = $this->getDbLink()->query_first(sprintf(
			"SELECT * FROM sms_pump_order_del
			WHERE order_id=%d",
			$params->getParamById('id'))
		);	
		if (is_array($pump_sms_ar)&&count($pump_sms_ar)){
			$sms_service = new SMSService(SMS_LOGIN, SMS_PWD);
			$sms_service->send($pump_sms_ar['phone_cel'],$pump_sms_ar['message'],SMS_SIGN,SMS_TEST);
		}
	
		Widget_Controller::clearPlantLoadCacheOnOrderId(
			$this->getDbLink(),$params->getDbVal('id'));
		parent::delete();
	}
	public function get_make_orders_for_lab_list($pm){
		$this->addNewModel("SELECT * FROM lab_orders_list"
		,'get_make_orders_for_lab_list');
	}
	
	public function get_history($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->set('id',DT_INT);
	
		$this->addNewModel(sprintf(
			"SELECT * FROM order_history(%d)",
		$params->getParamById('id')
		),'OrderHistory_Model');
	}
	
	public function get_avail_spots($pm){
		$link = $this->getDbLinkMaster();
		$p = new ParamsSQL($pm,$link);
		$p->addAll();
		
		$d1 = NULL;
		if (date('Y-m-d',$p->getVal('date'))==date('Y-m-d')){
			//ToDay
			$d1 = $p->getVal('date');
		}
		else{
			$d1 = $p->getVal('date');
			$d1 = MyDate::DateAdd('d',-1,$d1);
		}
		$d2 = MyDate::DateAdd('d',1,$d1);
		$d3 = MyDate::DateAdd('d',2,$d1);
		
		//day1
		$this->addNewModel(sprintf(
		"SELECT * FROM available_spots_for_order_dif_speed('%s',%f,%f)",
		date('Y-m-d',$d1),
		$p->getDbVal('quant'),
		$p->getDbVal('speed')
		),'AvailTimeDay1_Model');

		//day2
		$this->addNewModel(sprintf(
		"SELECT * FROM available_spots_for_order_dif_speed('%s',%f,%f)",
		date('Y-m-d',$d2),
		$p->getDbVal('quant'),
		$p->getDbVal('speed')
		),'AvailTimeDay2_Model');

		//day3
		$this->addNewModel(sprintf(
		"SELECT * FROM available_spots_for_order_dif_speed('%s',%f,%f)",
		date('Y-m-d',$d3),
		$p->getDbVal('quant'),
		$p->getDbVal('speed')
		),'AvailTimeDay3_Model');		
	}
	private function set_bool_field($pm,$field,$newVal,$event){
		try{
			$l = $this->getDbLinkMaster();
			$l->query('BEGIN');

			$params = new ParamsSQL($pm,$l);
			$params->addAll();
			
			$this->getDbLinkMaster()->query(sprintf(
				"UPDATE orders SET %s=%s
				WHERE id=%d",
				$field,
				$newVal,
				$params->getDbVal('id')
			));	
			
			
			$l->query(sprintf(
			"INSERT INTO order_log (order_id,user_id,order_event) VALUES (%d,%d,'%s'::order_events)",
			$params->getDbVal('id'),
			$_SESSION['user_id'],
			$event
			));
			
			$l->query('COMMIT');
		}
		catch (Exception $e){
			$l->query('ROLLBACK');
			throw $e;
		}
	
	}	
	
	public function set_payed($pm){
		$this->set_bool_field($pm,'payed','TRUE','update');
	}	
	
	public function set_temp($pm){	
		$this->set_bool_field($pm,'temp','TRUE','set_temp');
	}	
	
	public function unset_temp($pm){
		$this->set_bool_field($pm,'temp','FALSE','unset_temp');
	}
		
	public function get_temp_orders_list($pm){
		$this->addNewModel("SELECT * FROM orders_temp_list"
		,'OrderTempList_Model');	
	}
	public function get_make_orders_list($pm){
		$model = new OrderMakeList_Model($this->getDbLink());
		$this->modelGetList($model,$pm);				
	}

	public function get_count($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->set('period',DT_STRING);
	
		$model = new OrderCountList_Model($this->getDbLink());
		$cond = $this->conditionFromParams($pm,$model);
		if (!$cond){
			throw new Exception("Не заданы условия.");
		}
		
		/*
		$period = $cond->getFieldValueForDb('period','=');
		if (!$period){
			throw new Exception("Не задана периодичность.");
		}
		$cond->deleteField('period','=');
		*/
		
		$this->addNewModel(sprintf(
		"SELECT * FROM orders_count_on_period(%s,%s,%s)",		
		$cond->getFieldValueForDb('date_time','>='),
		$cond->getFieldValueForDb('date_time','<='),
		$params->getDbVal('period')
		),
		'OrderCountList_Model');		
	}
	public function get_operator_list($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		//назначенные
		$this->addNewModel(sprintf(
		"SELECT * FROM orders_for_operator(%s::date+const_shift_start_val())",
		$p->getDbVal('date_time')),
		'AssignedOrderList_Model');		
		
		//Отгруженные
		$this->addNewModel(sprintf(
		"SELECT
			sh.*
		FROM shipment_base sh
		WHERE sh.date_time BETWEEN %s::date+const_shift_start_val() AND get_shift_end(%s::date+const_shift_start_val())
		AND sh.shipped=TRUE",
		$p->getDbVal('date_time'),
		$p->getDbVal('date_time')
		),
		'ShippedOrderList_Model');		

		//под загрузкой
		$this->addNewModel(
		"SELECT *
		FROM orders_for_operator_list
		WHERE id=(
			SELECT t.shipment_id FROM shipment_on_load t LIMIT 1
			)",
		'ShipmentOnLoad_Model');
	
	}
	public function operator_list_move_up($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT orders_for_operator_queue_move(%d,-1)",
		$p->getDbVal('shipment_id')
		));
	}
	
	public function operator_list_move_down($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT orders_for_operator_queue_move(%d,1)",
		$p->getDbVal('shipment_id')
		));
	}
	
	public function operator_list_set_before($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT orders_for_operator_queue_set_before(%d,%d)",
		$p->getDbVal('shipment_id'),
		$p->getDbVal('after_shipment_id')
		));
	}
	
	public function insert($pm){
		$pm->setParamValue('user_id',$_SESSION['user_id']);
		$pm->addParam(new FieldExtInt('ret_id',array('value'=>1)));

		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		/*
		if (!$p->getVal('temp')){
			$oblig_fields = array('client_id','destination_id',
				'concrete_type_id');
			foreach($oblig_fields as $f){
				if (!$p->getVal($f)){
				}
			}
		}
		*/
	
		$l = $this->getDbLinkMaster();
		try{	
			$l->query('BEGIN');			
			$id_ar = parent::insert();
		
			$l->query(sprintf(
			"INSERT INTO order_log (order_id,user_id,order_event) VALUES (%d,%d,'insert'::order_events)",
			$id_ar['id'],
			$_SESSION['user_id']
			));				
			
			$l->query('COMMIT');
		}
		catch (Exception $e){
			$l->query('ROLLBACK');
			throw $e;
		}				
		
		Widget_Controller::clearPlantLoadCachOnDate(
			$this->getDbLinkMaster(),$p->getDbVal('date_time')
		);
		
		/*
		$this->send_messages(
			$id_ar['id'],
			$p->getVal('phone_cel'),
			$p->getVal('quant'),
			($p->getVal('pay_cash')=='true')?
				$p->getVal('total'):0,
			$p->getVal('date_time'),
			$p->getVal('concrete_type_id'),
			$p->getVal('destination_id'),
			$p->getVal('lang_id'),
			$p->getVal("pump_vehicle_id"),
			FALSE
		);
		*/
		
	}
	public function put_on_load($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT shipment_set_on_load(%d)",
		$p->getDbVal("shipment_id")
		));
	}
	public function set_shipped($pm){	
		$ar = $this->getDbLinkMaster()->query_first("SELECT shipment_id AS id FROM shipment_on_load");
		if (!is_array($ar)||!count($ar)){
			throw new Exception('Нет ТС под загрузкой.@1015');
		}
		$id = $ar['id'];
		
		//непосредственно отгрузка
		$l = $this->getDbLinkMaster();
		$l->query('BEGIN');
		try{
			$l->query(
				sprintf(
				"UPDATE shipments SET
				shipped=true,
				operator_user_id=%d
				WHERE id=%d",
				$_SESSION["user_id"],$id)
			);

			$l->query("DELETE FROM shipment_on_load");
		
			$l->query('COMMIT');
		}
		catch (Exception $e){
			$l->query('ROLLBACK');
		}
				
		Widget_Controller::clearPlantLoadCacheOnShipId(
			$this->getDbLinkMaster(),$id
		);
			
		//SMS service
		if (SMS_ACTIVE) {
			$dbLink = $this->getDbLink();
			$ar = $dbLink->query_first(sprintf(
			"SELECT
				orders.id AS order_id,
				orders.phone_cel,
				shipments.quant,
				concrete_types.name AS concrete,
				d.name AS d_name,
				coalesce(d.phone_cel,'') AS d_phone,
				v.plate AS v_plate,
				(SELECT pattern FROM sms_patterns
					WHERE sms_type='ship'::sms_types
					AND lang_id= orders.lang_id
				) AS text	
			FROM orders
			LEFT JOIN shipments ON shipments.order_id=orders.id
			LEFT JOIN concrete_types ON concrete_types.id=orders.concrete_type_id
			LEFT JOIN vehicle_schedules AS vs ON vs.id=shipments.vehicle_schedule_id
			LEFT JOIN drivers AS d ON d.id=vs.driver_id
			LEFT JOIN vehicles AS v ON v.id=vs.vehicle_id									
			WHERE shipments.id=%d			
			",$id)
			);
			
			if (strlen($ar['phone_cel'])){
				$text = $ar['text'];
				$text = str_replace('[quant]',$ar['quant'],$text);
				$text = str_replace('[concrete]',$ar['concrete'],$text);
				$text = str_replace('[car]',$ar['v_plate'],$text);
				
				$driver = $ar['d_name'];
				$d_phone = $ar['d_phone'];
				$d_phone = str_replace('_','',$d_phone);
				$driver.= ($d_phone!='' && strlen($d_phone)==15)? ' '.$d_phone:'';				
				$text = str_replace('[driver]',$driver,$text);
				try{
					$sms_service = new SMSService(SMS_LOGIN, SMS_PWD);
					$sms_id_resp = $sms_service->send($ar['phone_cel'],$text,SMS_SIGN,SMS_TEST);
					$sms_id = NULL;
					FieldSQLString::formatForDb($this->getDbLink(),$sms_id_resp,$sms_id);
					$this->getDbLinkMaster()->query(sprintf(
					"UPDATE sms_service SET
						shipment_id=%d,
						sms_id_shipment=%s,
						shipment_sms_time='%s'
					WHERE order_id=%d",
						$id,
						$sms_id,
						date('Y-m-d H:i:s'),
						$ar['order_id'])
					);
					
					$sms_res_str = '';
					$sms_res_ok = 1;
				}
				catch (Exception $e){
					$sms_res_str = $e->getMessage();
					$sms_res_ok = 0;
				}
				$this->addModel(new ModelVars(
					array('id'=>'SMSSend',
						'values'=>array(
							new Field('sent',DT_INT,
								array('value'=>$sms_res_ok))
							,					
							new Field('resp',DT_STRING,
								array('value'=>$sms_res_str))
							)
						)
					)
				);				
			}
		}
	}
	public function unset_shipped($pm){
		$dbLink = $this->getDbLink();
		$p = new ParamsSQL($pm,$dbLink);
		$p->addAll();
		$id = $p->getDbVal('shipment_id');
		
		$ar = $dbLink->query_first(
			sprintf("SELECT ship_date_time
			FROM shipments WHERE id=%d",
				$id)
			);
		if (is_array($ar)){
			$this->getDbLinkMaster()->query(
				sprintf("UPDATE shipments SET
					shipped=false
				WHERE id=%d",$id)
			);
		
			Widget_Controller::clearPlantLoadCachOnDate(
				$this->getDbLinkMaster(),"'".$ar['ship_date_time']."'"
			);
			
		}					
	}
	

}
?>
