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
require_once 'common/Caller.php';
	
class Call_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Управление звонками.*/

			
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
		
		$this->setListModelId('CallList_Model');
		
			
		$pm = new PublicMethod('get_active_call');
		
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('set_comment');
		
				
	/*Устанавливает комментарий к звонку.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtInt('id',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtText('value',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('dial');
		
				
	/*Набирает номер.*/

				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('from',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('to',$opts));
	
			
		$this->addPublicMethod($pm);
			
		
	}	
	
	public function set_comment($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"UPDATE calls SET manager_comment=%s
		WHERE unique_id=%s",		
		$p->getDbVal('value'),
		$p->getDbVal('id')
		));
	}
	public function dial($pm){
		$params = new ParamsSQL($pm,$this->getDbLink());
		$params->addAll();
		$caller = new Caller(AST_SERVER,AST_PORT,AST_USER,AST_PASSWORD);
		$caller->call($params->getVal('from'),$params->getVal('to'));	
	}
	public function get_active_call($pm){
		if ($_SESSION['tel_ext']){			
			$this->addNewModel(sprintf(
			"SELECT * FROM calls_active
			WHERE ext='%s'
			LIMIT 1",
			$_SESSION['tel_ext']
			),'CallActive_Model');
		}			
	}
	

}
?>
