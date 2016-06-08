<?php

require_once(FRAME_WORK_PATH.'basic_classes/ModelSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLInt.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLString.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLText.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLFloat.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLDateTime.php');
require_once(FRAME_WORK_PATH.'basic_classes/FieldSQLBool.php');

class OrderFromClientList_Model extends ModelSQL{
	
	public function __construct($dbLink){
		parent::__construct($dbLink);
		
		$this->setDbName("");
		
		$this->setTableName("orders_from_clients_list");
		
		$f_id=new FieldSQlInt($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"id"
		,array(
		
			'alias'=>"Код"
		,
			'id'=>"id"
				
		
		));
		$this->addField($f_id);

		$f_date_time=new FieldSQlDateTime($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"date_time"
				
		
		));
		$this->addField($f_date_time);

		$f_date_time_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"date_time_descr"
		,array(
		
			'alias'=>"Дата"
		,
			'id'=>"date_time_descr"
				
		
		));
		$this->addField($f_date_time_descr);

		$f_name=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"name"
		,array(
		
			'alias'=>"Клиент"
		,
			'id'=>"name"
				
		
		));
		$this->addField($f_name);

		$f_tel=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel"
		,array(
		
			'alias'=>"Телефон"
		,
			'length'=>15,
			'id'=>"tel"
				
		
		));
		$this->addField($f_tel);

		$f_tel_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"tel_descr"
		,array(
		
			'alias'=>"Телефон"
		,
			'length'=>15,
			'id'=>"tel_descr"
				
		
		));
		$this->addField($f_tel_descr);

		$f_concrete_type=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"concrete_type"
		,array(
		
			'alias'=>"Марка"
		,
			'length'=>15,
			'id'=>"concrete_type"
				
		
		));
		$this->addField($f_concrete_type);

		$f_dest=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"dest"
		,array(
		
			'alias'=>"Объект"
		,
			'id'=>"dest"
				
		
		));
		$this->addField($f_dest);

		$f_total=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total"
		,array(
		
			'alias'=>"Сумма"
		,
			'length'=>15,
			'id'=>"total"
				
		
		));
		$this->addField($f_total);

		$f_total_descr=new FieldSQlString($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"total_descr"
		,array(
		
			'alias'=>"Сумма"
		,
			'id'=>"total_descr"
				
		
		));
		$this->addField($f_total_descr);

		$f_quant=new FieldSQlFloat($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"quant"
		,array(
		
			'alias'=>"Количество"
		,
			'length'=>15,
			'id'=>"quant"
				
		
		));
		$this->addField($f_quant);

		$f_pump=new FieldSQlBool($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"pump"
		,array(
		
			'alias'=>"Есть насос"
		,
			'defaultValue'=>"false"
		,
			'id'=>"pump"
				
		
		));
		$this->addField($f_pump);

		$f_comment_text=new FieldSQlText($this->getDbLink(),$this->getDbName(),$this->getTableName()
		,"comment_text"
		,array(
		
			'alias'=>"Комментарий"
		,
			'id'=>"comment_text"
				
		
		));
		$this->addField($f_comment_text);

		
		
		
	}

}
?>
