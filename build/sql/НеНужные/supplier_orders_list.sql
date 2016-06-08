--SELECT * FROM supplier_orders_list1('2014-11-01 07:00','2014-11-22 07:00',5)
-- Function: supplier_orders_list(timestamp without time zone, timestamp without time zone,integer)

DROP FUNCTION supplier_orders_list(timestamp without time zone, timestamp without time zone,integer);

CREATE OR REPLACE FUNCTION supplier_orders_list(
	IN in_date_time_from timestamp without time zone,
	IN in_date_time_to timestamp without time zone,
	IN in_material_id integer)
  RETURNS TABLE(
	shift timestamp without time zone,
	shift_descr text,
	material_id integer,
	supplier_id integer,
	supplier_proc_rate numeric,
	quant_to_order_tot numeric,	
	quant_to_order numeric,
	vehicles_to_order integer,
	sms_delivered boolean,
	quant_procur numeric,
	quant_balance numeric
	) AS
$BODY$
DECLARE
	data_row RECORD;
	v_material_id integer;
	v_shift timestamp;
	v_veh_rest integer;
	v_veh_to_order integer;
BEGIN

	FOR data_row IN
	WITH
		cur_shift_from AS (
		SELECT get_shift_start(now()::timestamp without time zone) AS shift
		),	
		shift_for_avg_from AS (
		SELECT get_shift_start(now()::timestamp without time zone-(const_days_for_plan_procur_val()||' days')::interval) AS shift
		),
		shift_for_avg_to AS (
		SELECT get_shift_end((SELECT t.shift FROM cur_shift_from t)-'1 day'::interval) AS shift
		),		
		--shift_to AS (SELECT LEAST($2,(SELECT get_shift_end((SELECT max(date)+const_first_shift_start_time_val() FROM supplier_orders)))) AS shift),
		mat_list AS (
			SELECT
				mr.material_id,
				mr.supplier_id,
				mr.rate,
				m.order_start,
				m.supply_volume
			FROM raw_material_procur_rates AS mr
			LEFT JOIN raw_materials m ON m.id=mr.material_id
			WHERE
				(($3 IS NULL OR $3=0) AND m.concrete_part=TRUE)
				OR mr.material_id=$3
		),
		old_orders AS (
			SELECT
				o.date,
				o.material_id,
				o.supplier_id,
				o.quant AS quant,
				o.vehicles AS vehicles,
				o.sms_confirmed AS sms_delivered
			FROM supplier_orders o
			WHERE o.date>
				least($1::date,
						(SELECT min(m.order_start)
						FROM raw_materials m
						WHERE m.id IN (SELECT DISTINCT t.material_id FROM mat_list t)
						)
					)
				AND o.date<=$2::date
				AND o.material_id IN (SELECT DISTINCT t.material_id FROM mat_list t)
		)
		
	SELECT
		ord_shift AS shift,
		date8_descr(ord_shift::date)::text AS shift_descr,
		mat_list.material_id,
		mat_list.supplier_id,
		mat_list.rate,
		mat_list.supply_volume,
		
		so.quant AS quant_ordered,
		so.vehicles AS vehicles_ordered,
		so.sms_delivered AS sms_delivered,
		
		COALESCE(pp.quant_to_order,0) AS quant_to_order_tot,

		--Необходимо заказать
		CASE
			WHEN so.quant IS NULL THEN
			/*Расчет:
			(Весь заказ за пред.время с даты отсчета
			+текущий заказ)*ДоляПоставщика-
			БылоЗаказаноПоставщиком
			*/
			(
				(
					--Было заказано всего по всем поставщикам
					COALESCE(
						(SELECT sum(old_ord.quant)
						FROM old_orders AS old_ord
						WHERE old_ord.material_id=mat_list.material_id
						AND old_ord.date>mat_list.order_start					
						)
					,0)
					--надо заказать сейчас всего
					+COALESCE(pp.quant_to_order,0)
				)
				--доля поставщика
				* mat_list.rate
			)
			--Было заказано всего по поставщику
			- COALESCE(
				(SELECT sum(old_ord.quant)
				FROM old_orders AS old_ord
				WHERE
					old_ord.material_id=mat_list.material_id
					AND old_ord.supplier_id=mat_list.supplier_id
					AND old_ord.date>mat_list.order_start
				)
			,0)
			
			
			--или что уже заказано, если был сформирован заказ
			ELSE so.quant
		END AS quant_to_order,
		
		--Фактический приход
		COALESCE(proc.quant,0) AS quant_procur
		
	FROM generate_series(
		$1,
		$2,
		'24 hours') AS ord_shift
	CROSS JOIN
		(SELECT * FROM mat_list
		) AS mat_list
	LEFT JOIN (SELECT * FROM old_orders) AS so
		ON so.date=ord_shift::date
		AND so.material_id=mat_list.material_id
		AND so.supplier_id=mat_list.supplier_id	
	LEFT JOIN (
		SELECT *
		FROM mat_plan_procur(
			$2,
			(SELECT t.shift FROM shift_for_avg_from t),
			(SELECT t.shift FROM shift_for_avg_to t),
			$3)
		) AS pp ON pp.shift=ord_shift AND pp.material_id=mat_list.material_id
	LEFT JOIN (
		SELECT
			get_shift_start(ra.date_time) AS shift,
			d.supplier_id,
			ra.material_id,
			SUM(ra.quant) AS quant
		FROM ra_materials AS ra
		LEFT JOIN doc_material_procurements AS d ON d.id=ra.doc_id
		WHERE ra.date_time >=$1
			AND ra.date_time<=$2
			AND ra.deb=TRUE AND doc_type='material_procurement'::doc_types
		GROUP BY get_shift_start(ra.date_time),d.supplier_id,ra.material_id		
	) AS proc ON proc.shift=ord_shift
		AND proc.supplier_id=mat_list.supplier_id
		AND proc.material_id=mat_list.material_id
		
	ORDER BY material_id,ord_shift,quant_to_order DESC
	
	LOOP
		IF (v_material_id IS NULL
		OR (data_row.material_id<>v_material_id
			OR data_row.shift<>v_shift)
		) THEN
			
			v_material_id = data_row.material_id;
			v_shift = data_row.shift;
			v_veh_rest = CEIL(
				data_row.quant_to_order_tot/
				data_row.supply_volume
				);
		END IF;
		
		v_veh_to_order = LEAST(
				CEIL(data_row.quant_to_order/
				data_row.supply_volume),
				v_veh_rest
		);
		v_veh_rest = v_veh_rest - v_veh_to_order;
		/*
		IF (shift='2014-11-21 07:00:00') THEN
			RAISE 'v_veh_rest=%',v_veh_rest;
		END IF;
		*/
		shift				= data_row.shift;
		shift_descr			= data_row.shift_descr;
		material_id			= data_row.material_id;
		supplier_id			= data_row.supplier_id;
		supplier_proc_rate	= data_row.rate;
		quant_to_order_tot	= data_row.quant_to_order_tot;
		IF data_row.quant_ordered IS NULL THEN
			quant_to_order	= v_veh_to_order*data_row.supply_volume;
			vehicles_to_order = v_veh_to_order;
		ELSE
			quant_to_order = data_row.quant_ordered;
			vehicles_to_order = data_row.vehicles_ordered;
		END IF;
		quant_procur		= data_row.quant_procur;
		quant_balance		= quant_to_order-quant_procur;
		sms_delivered		= data_row.sms_delivered;
		
		RETURN NEXT;
	END LOOP;	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  CALLED ON NULL INPUT
  COST 100
  ROWS 1000;
ALTER FUNCTION supplier_orders_list1(timestamp without time zone, timestamp without time zone,integer)
  OWNER TO beton;
