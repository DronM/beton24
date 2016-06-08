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

require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/ParamsSQL.php');

class UIStorage_Controller extends ControllerSQL{
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);
			
	/*Хранилище с пользовательскими настройками*/

			
		$pm = new PublicMethod('set');
		
				
	/*Записывает данные в хранилище по идентификатору*/

				
	$opts=array();
	
		$opts['length']=50;
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtString('ui_id',$opts));
	
				
	$opts=array();
	
		$opts['required']=TRUE;				
		$pm->addParam(new FieldExtText('data',$opts));
	
			
		$this->addPublicMethod($pm);

			
		$pm = new PublicMethod('get');
		
				
	/*Получает данные из хранилища по списку идентификаторов*/

				
	$opts=array();
					
		$pm->addParam(new FieldExtString('ui_id_list',$opts));
	
			
		$this->addPublicMethod($pm);
			
			
		/* delete */
		$pm = new PublicMethod('delete');
		
		$pm->addParam(new FieldExtString('ui_id'
		));		
		
		$pm->addParam(new FieldExtInt('user_id'
		));		
		
		$pm->addParam(new FieldExtInt('count'));
		$pm->addParam(new FieldExtInt('from'));				
		$this->addPublicMethod($pm);					
		$this->setDeleteModelId('UIStorage_Model');

		
	}	
	
	public function set($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT ui_storage_set(ROW(%s,%d,%s)::ui_storages)",
		$p->getDbVal('ui_id'),
		$_SESSION['user_id'],
		$p->getDbVal('data')
		));
	}
	public function get($pm){
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
	
		$id_list = $p->getVal('ui_id_list');
		$id_db_list = '';
		$q = '';
		if (isset($id_list)){
			$ids = explode(',',$id_list);
			foreach($ids as $id) {
				$id_db = NULL;
				FieldSQLString::formatForDb($this->getDbLink(),$id,$id_db);
				$id_db_list.= ($id_db_list)? ',':'';
				$id_db_list.= $id_db;
			}
			$q = sprintf(" AND ui_id IN (%s)",$id_db_list);
		}
		$this->addNewModel(sprintf(
		"SELECT ui_id,data
		FROM ui_storages
		WHERE user_id=%d%s",
		$_SESSION['user_id'],
		$q
		),
		'UIStorageList_Model');		
		
	}
	public function delete($pm){
		$pm->setParamValue('user_id',$_SESSION['user_id']);
		parent::delete($pm);
		/*
		$p = new ParamsSQL($pm,$this->getDbLink());
		$p->addAll();
		
		$this->getDbLinkMaster()->query(sprintf(
		"DELETE FROM ui_storages
		WHERE user_id=%d AND ui_id = %s",
		$_SESSION['user_id'],
		$p->getDbVal('ui_id')
		));
		*/
	}

}
?>
