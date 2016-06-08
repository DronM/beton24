-- Function: raw_material_total_report(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION raw_material_total_report(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION raw_material_total_report(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone)
  RETURNS TABLE(
	date_time timestamp without time zone,
	date_time_descr text,
	material_id integer,
	quant_shipment numeric,
	quant_beg numeric,
	quant_procur numeric,
	quant_consump numeric,
	quant_end numeric,
	quant_correct numeric) AS
$BODY$
DECLARE
	v_days_avg interval;
	v_shift_for_avg_from timestamp without time zone;
	v_shift_for_avg_to timestamp without time zone;
	v_sunday_shift_end timestamp without time zone;
	v_plan_shift_start timestamp without time zone;
BEGIN
	v_days_avg = (const_days_for_plan_procur_val()||' days')::interval;
	v_shift_for_avg_from = get_shift_start(now()::timestamp without time zone-v_days_avg);
	v_shift_for_avg_to = get_shift_end(get_shift_start(now()::timestamp without time zone)-'1 day'::interval);
	v_sunday_shift_end = get_shift_end(get_shift_start( in_date_time_to +((7-EXTRACT(DOW FROM now())::int)||' days')::interval));
	v_plan_shift_start = get_shift_end(get_shift_start(now()::timestamp without time zone))+'1 second';
	
	RETURN QUERY
	WITH
		/* список материалов с нужными колонками */
		mat_list AS (
			SELECT id,supply_days_count,name,ord
			FROM raw_materials
			WHERE concrete_part=TRUE
		),

		/* все смены и все материалы */
		shifts_mat AS (
			SELECT
				shift,
				m.id AS material_id,
				m.supply_days_count,
				m.name AS material_descr,
				m.ord
			FROM generate_series(in_date_time_from,v_sunday_shift_end,'24 hours') AS shift
			CROSS JOIN (
				SELECT * FROM mat_list
				) AS m
		),
		
		plan_procur AS (
			SELECT * FROM mat_plan_procur(
				v_plan_shift_start,
				v_sunday_shift_end,
				v_shift_for_avg_from,
				v_shift_for_avg_to,
				NULL
				)
		),
		/* Средний выпуск бетона за X дней
		ship_avg AS (
			SELECT
				CASE
					WHEN COUNT(DISTINCT get_shift_start(ship_date_time))=0 THEN 0
					ELSE ROUND((SUM(quant)/COUNT(DISTINCT get_shift_start(ship_date_time)))::numeric,2)
				END AS quant_avg,
				SUM(quant) AS quant
			FROM shipments
			WHERE shipped=true AND ship_date_time BETWEEN v_shift_for_avg_from AND v_shift_for_avg_to
		),
		*/	
		/* Выпуск бетона по дням + средний выпуск
		за пред. X дней по будущим датам*/
		ship AS (
			(SELECT
				get_shift_start(sh.ship_date_time) AS shift,
				SUM(sh.quant::numeric) AS quant				
			FROM shipments AS sh			
			WHERE sh.ship_date_time BETWEEN in_date_time_from AND in_date_time_to
			GROUP BY shift
			)
			
			UNION
			(SELECT
				pp.shift,
				pp.concrete_avg_quant AS quant
			FROM plan_procur AS pp
			)
			/*
			(SELECT
				shift,
				(SELECT ship_avg.quant_avg FROM ship_avg) AS quant
			FROM generate_series(v_plan_shift_start, v_sunday_shift_end, '24 hours') AS shift
			)
			*/
		),
		
		/* Подробная таблица с движением материалов 
		за период*/
		mat_acts AS 
		(SELECT
			ra.date_time,
			ra.deb,
			ra.material_id,
			ra.quant,
			ra.doc_type,
			ra.doc_id
		FROM ra_materials AS ra
		WHERE ra.date_time BETWEEN in_date_time_from AND in_date_time_to
			AND ra.material_id IN (SELECT id FROM mat_list)
		),

		/* Расход материала для расчета средних значений
		mat_avg AS 
		(SELECT
			cons.material_id,
			SUM(quant) AS quant
		FROM mat_acts AS cons
		WHERE cons.date_time BETWEEN v_shift_for_avg_from AND v_shift_for_avg_to AND cons.deb=FALSE
		GROUP BY cons.material_id
		),
		*/
		
		/* Расход материала свернуто по сменам
		+ плановый расход по будущим датам*/
		consumption AS 
		(	(SELECT
				get_shift_start(cons.date_time) AS shift,
				cons.material_id,
				SUM(quant) AS quant
			FROM mat_acts AS cons
			WHERE cons.deb=FALSE
			GROUP BY shift,cons.material_id
			)
			UNION
			(SELECT
				pp.shift,
				pp.material_id,
				pp.mat_avg_cons AS quant
			FROM plan_procur AS pp
			)			
			/*
			(SELECT
				sh.shift,
				sh.material_id,
				CASE
					WHEN (SELECT COALESCE(ship_avg.quant,0) FROM ship_avg)=0 THEN 0
					ELSE
						ROUND((mat_avg.quant/(SELECT ship_avg.quant FROM ship_avg))::numeric,3)
				END
				
				AS quant
				
			FROM shifts_mat AS sh
			LEFT JOIN mat_avg ON mat_avg.material_id=sh.material_id
			WHERE sh.shift>=v_plan_shift_start			
			)
			*/
		
		),

		/*Корректировки расхода материала*/
		consumption_norm AS 
		(SELECT
			get_shift_start(cons.date_time) AS shift,
			cons.material_id,SUM(quant) AS quant		
		FROM mat_acts AS cons
		WHERE cons.doc_type IS NULL
			AND cons.doc_id IS NULL
		GROUP BY shift,cons.material_id
		),

		/*Поступление материалов
		+ плановый приход по будущим датам*/
		procurement AS
		(	(SELECT
				get_shift_start(procur.date_time) AS shift,
				procur.material_id,
				SUM(quant) AS quant
			FROM mat_acts AS procur
			WHERE procur.deb=TRUE
			GROUP BY shift,procur.material_id)
			UNION
			(SELECT
				pp.shift,
				pp.material_id,
				pp.quant_to_order AS quant
			FROM plan_procur AS pp
			)			
			/*
			(SELECT
				sh.shift,
				sh.material_id,
				CASE	
					--НЕТ ЗАВОЗА
					WHEN (EXTRACT(DOW FROM sh.shift)>0 AND EXTRACT(DOW FROM sh.shift)>sh.supply_days_count)
					OR (EXTRACT(DOW FROM sh.shift)=0 AND sh.supply_days_count<7)
						THEN 0
					WHEN COALESCE(user_mat_store.quant,0)>0 THEN
						user_mat_store.quant
					WHEN (SELECT COALESCE(ship_avg.quant,0) FROM ship_avg)=0 THEN 0
					ELSE
						ROUND(
						(mat_avg.quant/(SELECT ship_avg.quant FROM ship_avg) * 

						(7- sh.supply_days_count+ 1) * 
						
						(SELECT ship_avg.quant_avg FROM ship_avg))::numeric
						,3)
				END
				
				AS quant
				
			FROM shifts_mat AS sh
			LEFT JOIN mat_avg ON mat_avg.material_id=sh.material_id
			LEFT JOIN (SELECT
					mq.material_id,
					mq.quant
				FROM raw_material_min_quants AS mq
				) AS user_mat_store ON user_mat_store.material_id=sh.material_id
			
			WHERE sh.shift>=v_plan_shift_start			
			)
			*/			
		),

		/*Остатки материалов на начало периода*/
		rg_beg AS
		(SELECT rg.material_id,rg.quant
		FROM rg_materials_balance(in_date_time_from::timestamp without time zone,
			ARRAY(SELECT id FROM mat_list)) AS rg
		)

	SELECT
		sub.shift AS date_time,
		date10_descr(sub.shift::date)::text AS date_time_descr,
		sub.material_id AS material_id,

		ship.quant AS quant_shipment,
		/*
		COALESCE(
			(SELECT SUM(ship.quant)
			FROM ship
			WHERE ship.ship_date_time BETWEEN sub.shift AND get_shift_end(sub.shift)
			)
		,0) AS quant_shipment,
		*/
		
		--quant begining
		(
			--balance
			COALESCE((SELECT rg_beg.quant FROM rg_beg WHERE rg_beg.material_id=sub.material_id),0)
			--procur before this shift
			+COALESCE((SELECT SUM(p.quant) FROM procurement AS p WHERE p.material_id=sub.material_id AND p.shift<sub.shift),0)
			--consump before this shift
			-COALESCE((SELECT SUM(c.quant) FROM consumption AS c WHERE c.material_id=sub.material_id AND c.shift<sub.shift),0)
			
		) AS qaunt_beg,

		/* Поступление */
		COALESCE((SELECT SUM(quant) FROM procurement AS p WHERE p.shift=sub.shift AND p.material_id=sub.material_id),0) AS quant_procur,

		/* Расход */
		COALESCE((SELECT SUM(quant) FROM consumption AS c WHERE c.shift=sub.shift AND c.material_id=sub.material_id),0) AS qunat_consump,
		
		--quant end
		(
			--balance
			COALESCE((SELECT rg_beg.quant FROM rg_beg WHERE rg_beg.material_id=sub.material_id),0)
			--procur before and this shift
			+COALESCE((SELECT SUM(p.quant) FROM procurement AS p WHERE p.material_id=sub.material_id AND p.shift<=get_shift_end(sub.shift)),0)
			--consump before and this shift
			-COALESCE((SELECT SUM(c.quant) FROM consumption AS c WHERE c.material_id=sub.material_id AND c.shift<=get_shift_end(sub.shift)),0)
			
		) AS qaunt_end,
		
		COALESCE((SELECT sum(quant)
		FROM consumption_norm AS n
		WHERE n.material_id=sub.material_id
			AND sub.shift=n.shift
		),0) AS quant_correct
		
	FROM shifts_mat AS sub
	LEFT JOIN ship ON ship.shift=sub.shift
	ORDER BY sub.shift,sub.ord;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION raw_material_total_report(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
