<?php

require_once(FRAME_WORK_PATH.'basic_classes/Controller.php');

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

require_once('models/MainMenu_Model_owner.php');
require_once('models/MainMenu_Model_boss.php');
require_once('models/MainMenu_Model_operator.php');
require_once('models/MainMenu_Model_manager.php');
require_once('models/MainMenu_Model_dispatcher.php');
require_once('models/MainMenu_Model_accountant.php');
require_once('models/MainMenu_Model_lab_worker.php');
require_once('models/MainMenu_Model_supplies.php');
require_once('models/MainMenu_Model_sales.php');
require_once('models/MainMenu_Model_plant_director.php');
require_once('models/MainMenu_Model_supervisor.php');

class MainMenu_Controller extends Controller{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
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
		
		
	}	
	
	public function get_list($pm){
		if (isset($_SESSION['role_id'])){
			$menu_class = 'MainMenu_Model_'.$_SESSION['role_id'];
			$this->addModel(new $menu_class(array('id'=>'MainMenu_Model')));
		}

	}

}
?>
