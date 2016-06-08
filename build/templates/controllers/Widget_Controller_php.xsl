<?xml version="1.0" encoding="UTF-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:import href="Controller_php.xsl"/>

<!-- -->
<xsl:variable name="CONTROLLER_ID" select="'Widget'"/>
<!-- -->

<xsl:output method="text" indent="yes"
			doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" 
			doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/>
			
<xsl:template match="/">
	<xsl:apply-templates select="metadata/controllers/controller[@id=$CONTROLLER_ID]"/>
</xsl:template>

<xsl:template match="controller"><![CDATA[<?php]]>
<xsl:call-template name="add_requirements"/>

require_once('models/PlantLoadChart_Model.php');
require_once(FRAME_WORK_PATH.'basic_classes/ConditionParamsSQL.php');
require_once(FRAME_WORK_PATH.'basic_classes/ModelWhereSQL.php');

class <xsl:value-of select="@id"/>_Controller extends ControllerSQL{
	const ER_PARAM_NOT_FOUND = "Параметр не найден.@1000";
	const ER_PARAM_ERROR = "Дата начала больше даты окончания.@1000";
	
	public function __construct($dbLinkMaster=NULL){
		parent::__construct($dbLinkMaster);<xsl:apply-templates/>
	}	
	<xsl:call-template name="extra_methods"/>
}
<![CDATA[?>]]>
</xsl:template>

<xsl:template name="extra_methods">
	private function plant_load_chart_data_to_model($times_str,$norm_str,$orders_str,$shipments_str,$veh_counts_str){
		$model = new PlantLoadChart_Model($this->getDbLink());
		$model->query(sprintf(
		"SELECT
			'%s' AS times,
			'%s' AS norms,
			'%s' AS orders,
			'%s' AS shipments,
			'%s' AS veh_counts",
		$times_str,$norm_str,$orders_str,$shipments_str,$veh_counts_str
		),
		TRUE);
		$this->addModel($model);	
	}

	private function make_load_chart($dateTimeFrom,$dateTimeTo,$dateTimeFromDb,$dateTimeToDb){		
		$dbLink = $this->getDbLink();
		
		$consts = $dbLink->query_first(
		"SELECT
			constant_max_hour_load() AS max_h_load,
			constant_chart_step_min() AS step_min");
		if (!$consts||!is_array($consts)){
			throw new Exception("Constants not defined!");
		}
		$query_orders =sprintf(
			"SELECT 
				date_time,date_time_to,
				quant,unload_speed
			FROM orders
			WHERE date_time BETWEEN %s AND %s AND temp=FALSE
			ORDER BY date_time",
			$dateTimeFromDb,
			$dateTimeToDb
		);
		$query_shipments = sprintf(
		"SELECT
			ship_date_time,
			quant AS quant_shipped
			FROM shipments
			WHERE ship_date_time BETWEEN %s AND %s
			ORDER BY ship_date_time",
			$dateTimeFromDb,
			$dateTimeToDb
			);			
			
		$chart_data = array();		
		$QUANT_NORM_ON_STEP = ceil($consts['max_h_load']*$consts['step_min']/60);		
		$STEP_SEC = $consts['step_min']*60;
		
		//all points to chart
		for ($i=$dateTimeFrom;$i &lt;= $dateTimeTo+1;$i+=$STEP_SEC){
			$chart_data[$i] = array("time"=>date('H:i',$i),
				"orders"=>0,"shipments"=>0,
				"norm"=>$QUANT_NORM_ON_STEP);
		}
		$chart_data[$i-$STEP_SEC]["orders"] = NULL;
		$chart_data[$i-$STEP_SEC]["shipments"] = NULL;
		
		//orders
		$chart_data[$dateTimeFrom]["orders"] = 0;//$QUANT_NORM_ON_STEP;
		$dbLink->query($query_orders);
		while ($ar = $dbLink->fetch_array()){
			$order_unload_speed = $ar['unload_speed']*$consts['step_min']/60;
			$quant = $ar['quant'];
			
			$time_from = strtotime($ar['date_time'])+1;
			$time_from = ceil($time_from / $STEP_SEC) * $STEP_SEC;
			$time_to = strtotime($ar['date_time_to'])+1;
			$time_to = ceil($time_to / $STEP_SEC) * $STEP_SEC;
			$time_to = min($time_to,$dateTimeTo+1);
			
			for ($i=$time_from;$i &lt; $time_to;$i+=$STEP_SEC){
				$ind = ceil($i / $STEP_SEC) * $STEP_SEC;
				
				$quant_cur = min($quant,$order_unload_speed);				
				$chart_data[$ind]["orders"]+= $quant_cur;
				$quant-=$quant_cur;			
				if ( (($i+$STEP_SEC)>=$time_to)
					&amp;&amp; $quant &gt; 0){
					//last iteration
					$chart_data[$ind]["orders"]+= $quant;
				}
			}
		}
		
		//shipment
		$chart_data[$dateTimeFrom]["shipments"] = 0;//$QUANT_NORM_ON_STEP;
		$dbLink->query($query_shipments);
		while ($ar = $dbLink->fetch_array()){
			$seconds = strtotime($ar['ship_date_time']);
			$ind = ceil($seconds / $STEP_SEC) * $STEP_SEC;
			$chart_data[$ind]["shipments"]+= $ar["quant_shipped"];
		}
		
		$shipments = array();
		$norm = array();
		$orders = array();
		$times = array();				
		$veh_counts = array();				
		foreach ($chart_data as $d){
			array_push($times,$d["time"]);
			array_push($norm,$d["norm"]);
			//сделать расчет!!!
			array_push($veh_counts,0);
			array_push($orders,$d["orders"]);
			array_push($shipments,$d["shipments"]);
		}
		
		$times_str = implode(',',$times);
		$orders_str = implode(',',$orders);
		$shipments_str = implode(',',$shipments);
		$norm_str = implode(',',$norm);
		$veh_counts_str = implode(',',$veh_counts);
		
		//все в КЭШ
		$this->getDbLinkMaster()->query(sprintf(
		"SELECT widget_plant_load_charts_update(%s::timestamp,%s::timestamp,'%s'::text,'%s'::text,'%s'::text,'%s'::text,'%s'::text)",
			$dateTimeFromDb,$dateTimeToDb,
			$times_str,$norm_str,$orders_str,$shipments_str,$veh_counts_str
		));
		
		//возврат клиенту
		$this->plant_load_chart_data_to_model(
			$times_str,$norm_str,
			$orders_str,$shipments_str,$veh_counts_str
		);
	}

	private static function clearPlantLoadCache($dbLinkMaster,$withQuery){
		$dbLinkMaster->query(
		$withQuery." UPDATE widget_plant_load_charts
		SET state=0
		WHERE date_time_from=(SELECT d1 FROM dates)
		AND date_time_to=(SELECT d2 FROM dates)"
		);
	}
	
	private static function clearPlantLoadCacheOnField($dbLinkMaster,$tableName,$fieldName,$id){
		Widget_Controller::clearPlantLoadCache(
			$dbLinkMaster,
			sprintf(
			"WITH dates AS (
				SELECT d1,d2
				FROM get_shift_bounds(
					(SELECT %s FROM %s WHERE id=%d))
				AS (d1 timestampTZ, d2 timestampTZ)
			)",
			$fieldName,$tableName,$id
			)
		);
	}
	public static function clearPlantLoadCacheOnOrderId($dbLink,$id){
		Widget_Controller::clearPlantLoadCacheOnField($dbLink,'orders','date_time',$id);
	}		
	public static function clearPlantLoadCacheOnShipId($dbLink,$id){
		Widget_Controller::clearPlantLoadCacheOnField($dbLink,'shipments','ship_date_time',$id);
	}		
	public static function clearPlantLoadCachOnDate($dbLink,$dateTimeDb){
		Widget_Controller::clearPlantLoadCache(
			$dbLink,
			sprintf(
			"WITH dates AS (
				SELECT
					d1,d2
				FROM get_shift_bounds(%s::timestampTZ)
				AS (d1 timestampTZ, d2 timestampTZ)
			)",
			$dateTimeDb
			)
		);	
	}	

	public function get_plant_load($pm){
		$cond = new ConditionParamsSQL($pm,$this->getDbLink(),array('date_time'=>DT_DATETIME));
		if (!$cond){
			throw new Exception(Widget_Controller::ER_PARAM_NOT_FOUND);
		}
		$date_time_from_db = $cond->getDbVal('date_time','&gt;=');
		if (!$date_time_from_db){
			throw new Exception(Widget_Controller::ER_PARAM_NOT_FOUND);
		}		
		$date_time_from = $cond->getVal('date_time','&gt;=');
		
		$date_time_to_db = $cond->getDbVal('date_time','&lt;=');
		if (!$date_time_to_db){
			throw new Exception(Widget_Controller::ER_PARAM_NOT_FOUND);
		}		
		$date_time_to = $cond->getVal('date_time','&lt;=');
		
		if ($date_time_from_db>$date_time_to_db){
			throw new Exception(Widget_Controller::ER_PARAM_ERROR);
		}		
		
		$q = sprintf(sprintf(
			"SELECT * FROM widget_plant_load_charts
			WHERE date_time_from &gt;= get_shift_start(%s)
			AND date_time_to &lt;= get_shift_end(get_shift_start(%s))",
			$date_time_from_db,
			$date_time_to_db
		));
		
		$link = $this->getDbLink();
		
	//chart_check:	
	
		$ar = $link->query_first($q);
		if (is_array($ar)&amp;&amp;count($ar)){
			//есть данные,какой статус?
			$TRIES = 3;
			$WAIT_MS = 1000;
			while ($ar['state']==0){
				$TRIES--;
				if ($TRIES&lt;0){
					break;
				}
				usleep($WAIT_MS);				
				$ar = $link->query_first($q);
			}
			if ($ar['state']==2){
				$this->plant_load_chart_data_to_model(
					$ar['times'],$ar['norms'],
					$ar['orders'],$ar['shipments'],
					$ar['veh_counts']
				);			
			}
			else{
				//так и нет ответа - построим заново
				$this->make_load_chart($date_time_from,$date_time_to,
					$date_time_from_db,$date_time_to_db);
			}
		}
		else{
			try{
				//нет данных - вставка и блокировка
				$this->getDbLinkMaster()->query(sprintf(
				"INSERT INTO widget_plant_load_charts
				(date_time_from,date_time_to,state)
				VALUES (%s,%s,0)",
				$date_time_from_db,
				$date_time_to_db
				));
			}
			catch (Exception $e){
				//ошибка вставки - кто то успел
				//goto chart_check;
			}
			
			$this->make_load_chart($date_time_from,$date_time_to,
				$date_time_from_db,$date_time_to_db);
		}
	}
</xsl:template>

</xsl:stylesheet>
