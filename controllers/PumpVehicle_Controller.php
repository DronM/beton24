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

class PumpVehicle_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
		/* insert */
		$pm = new PublicMethod('insert');
		$param = new FieldExtInt('vehicle_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtInt('pump_price_id'
				,array());
		$pm->addParam($param);
		$param = new FieldExtString('phone_cel'
				,array());
		$pm->addParam($param);
		
				$param = new FieldExtEnum('unload_type',',','pump,band,none'
				,array('required'=>TRUE));
		$pm->addParam($param);
		
		$pm->addParam(new FieldExtInt('ret_id'));
		
		
		$this->addPublicMethod($pm);
		$this->setInsertModelId('PumpVehicle_Model');

			
		/* update */		
		$pm = new PublicMethod('update');
		
		$pm->addParam(new FieldExtInt('old_id',array('required'=>TRUE)));
		
		$pm->addParam(new FieldExtInt('obj_mode'));
		$param = new FieldExtInt('id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('vehicle_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtInt('pump_price_id'
				,array(
			));
			$pm->addParam($param);
		$param = new FieldExtString('phone_cel'
				,array(
			));
			$pm->addParam($param);
		
				$param = new FieldExtEnum('unload_type',',','pump,band,none'
				,array(
			));
			$pm->addParam($param);
		
			$param = new FieldExtInt('id',array(
			));
			$pm->addParam($param);
		
		
			$this->addPublicMethod($pm);
			$this->setUpdateModelId('PumpVehicle_Model');

			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtInt('id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('PumpVehicle_Model');
		
			
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
		
		$this->setListModelId('PumpVehicleList_Model');
		
			
		/* get_object */
		$pm = new PublicMethod('get_object');
		$pm->addParam(new FieldExtInt('browse_mode'));
		
		$pm->addParam(new FieldExtInt('id'
		));
		
		$this->addPublicMethod($pm);
		$this->setObjectModelId('PumpVehicleList_Model');		

			
		$pm = new PublicMethod('get_price');
		
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('pump_id',$opts));
	
				
	$opts=array();
	
		$opts['length']=19;
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtFloat('quant',$opts));
	
			
		$this->addPublicMethod($pm);

		
	}	
	
	public function get_price($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->add('pump_id',DT_INT,$pm->getParamValue('pump_id'));
		$p->add('quant',DT_FLOAT,$pm->getParamValue('quant'));
		
		$quant = $p->getParamById('quant');
		$pump_id = $p->getParamById('pump_id');
		
		/*поиск подходящей схемы для насоса
		и актуального тарифа от количества
		*/
		$this->addNewModel(sprintf(
		"SELECT
			CASE
				WHEN COALESCE(pprv.price_fixed)>0 THEN
					COALESCE(pprv.price_fixed)
				ELSE ROUND(COALESCE(pprv.price_m)*%f,2)
			END AS price
		FROM pump_prices_values pprv
		WHERE pprv.pump_price_id=(
			SELECT
				pv.pump_price_id
			FROM pump_vehicles AS pv
			WHERE pv.id=%d
			)
			AND (%f > pprv.quant_from
				AND %f <= pprv.quant_to)
		LIMIT 1",
		$quant,$pump_id,$quant,$quant
		),'get_price');
	}

}
?>
