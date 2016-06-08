-- Function: oper_week_report(int, interval)

--DROP FUNCTION oper_week_report(int, interval);

CREATE OR REPLACE FUNCTION oper_week_report(IN in_days_for_avg int, in_param_change interval)
  RETURNS TABLE(
	days_for_avg int,
	material_id int, material_descr text, supply_days_count int,
	concrete_ship_period_avg numeric,
	mat_cons_day_avg numeric,
	mat_min_quant numeric, user_data_mat_min_quant numeric,
	day_descr text[],day_mat_quant numeric[], day_mat_cons numeric[], day_mat_procur numeric[]
	) AS
$BODY$
DECLARE
	v_i int;
	v_quant_end numeric;
	v_do_param_change boolean;
	data_row RECORD;
	v_days_avg interval;
	v_shift_for_avg_start timestamp without time zone;
	v_shift_for_avg_end timestamp without time zone;
	v_monday_shift_start timestamp without time zone;
	v_sunday_shift_end timestamp without time zone;
	v_dow int;
	v_mat_plan_cons numeric;
	v_mat_plan_procur numeric;
BEGIN
	v_days_avg = (in_days_for_avg || ' days')::interval;
	v_shift_for_avg_start = get_shift_start(now()::timestamp without time zone-v_days_avg);
	v_shift_for_avg_end = get_shift_end(get_shift_start(now()::timestamp without time zone)-'1 day'::interval);
	v_monday_shift_start = get_shift_start(now()::timestamp without time zone)-(EXTRACT(DOW FROM now())-1||' days')::interval;
	v_sunday_shift_end = get_shift_end(get_shift_start(now()::timestamp without time zone+((7-EXTRACT(DOW FROM now())::int)||' days')::interval));
	v_dow = EXTRACT(DOW FROM now())::int;
	v_quant_end = 0;
	
	FOR data_row IN
		WITH
		ship_cnt AS (SELECT
			COUNT(DISTINCT get_shift_start(ship_date_time)) AS cnt
			FROM shipments
			WHERE shipped=true
			AND ship_date_time BETWEEN v_shift_for_avg_start AND v_shift_for_avg_end
		),
		ship AS (SELECT
			COALESCE(ROUND(SUM(quant)::numeric),0) AS quant,
			CASE
				WHEN (SELECT ship_cnt.cnt FROM ship_cnt)=0 THEN 0
				ELSE
					COALESCE(ROUND(SUM(quant)::numeric/
					(SELECT ship_cnt.cnt FROM ship_cnt)
					),0)
			END AS quant_avg
			FROM shipments WHERE shipped=true AND ship_date_time BETWEEN v_shift_for_avg_start AND v_shift_for_avg_end
		),
		mat_week_acts AS (
			SELECT 
				get_shift_start(ra.date_time) AS shift,
				ra.material_id,
				ROUND(
				SUM(	CASE
						WHEN ra.deb THEN ra.quant
						ELSE 0
					END
				),2) AS quant_procur,
				ROUND(
				SUM(	CASE
						WHEN ra.deb=false THEN ra.quant
						ELSE 0
					END
				),2) AS quant_consump				
			FROM ra_materials AS ra WHERE ra.date_time BETWEEN v_monday_shift_start AND v_sunday_shift_end
			GROUP BY ra.material_id,shift	
		)
	
		SELECT 
			m.id AS material_id,
			m.name::text AS material_descr,
			m.supply_days_count,
			
			--total shipment
			(SELECT quant FROM ship) AS concrete_ship_period_total,
			
			--average 10 days concrete quant
			COALESCE((SELECT quant_avg FROM ship),0) AS concrete_ship_period_avg,
			
			mat_cons.quant AS mat_cons_period_quant,
			
			-- user data
			COALESCE(user_data.quant,0::numeric) AS user_data_mat_min_quant,
			
			-- monday morning quant
			COALESCE(rg.quant,0) As day1_quant,
			
			ARRAY(SELECT generate_series(v_monday_shift_start::date ,v_sunday_shift_end::date,'1 day')) AS day_descr,
			
			ARRAY[
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=v_monday_shift_start),0),
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=(v_monday_shift_start+'1 day'::interval)),0),
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=(v_monday_shift_start+'2 days'::interval)),0),
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=(v_monday_shift_start+'3 days'::interval)),0),
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=(v_monday_shift_start+'4 days'::interval)),0),
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=(v_monday_shift_start+'5 days'::interval)),0),
			COALESCE((SELECT mwc.quant_consump FROM mat_week_acts AS mwc WHERE mwc.material_id=m.id AND mwc.shift=(v_monday_shift_start+'6 days'::interval)),0)
			] AS day_mat_cons,
			
			ARRAY[
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=v_monday_shift_start),0),
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=(v_monday_shift_start+'1 day'::interval)),0),
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=(v_monday_shift_start+'2 days'::interval)),0),
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=(v_monday_shift_start+'3 days'::interval)),0),
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=(v_monday_shift_start+'4 days'::interval)),0),
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=(v_monday_shift_start+'5 days'::interval)),0),
			COALESCE((SELECT mwp.quant_procur FROM mat_week_acts AS mwp WHERE mwp.material_id=m.id AND mwp.shift=(v_monday_shift_start+'6 days'::interval)),0)
			] AS day_mat_procur,
			1
			
		FROM raw_materials AS m
		
		LEFT JOIN raw_material_min_quants AS user_data ON user_data.material_id=m.id AND user_data.week_day=v_monday_shift_start::date
		
		LEFT JOIN (
			SELECT ra.material_id,SUM(ra.material_quant) AS quant
			FROM ra_material_consumption AS ra WHERE ra.date_time BETWEEN v_shift_for_avg_start AND v_shift_for_avg_end
			GROUP BY ra.material_id	
			) AS mat_cons ON mat_cons.material_id=m.id

		LEFT JOIN (
			SELECT b.material_id AS material_id,ROUND(b.quant,2) AS quant
			FROM rg_materials_balance(v_monday_shift_start,'{}') AS b
			) AS rg ON rg.material_id=m.id
		
		WHERE m.concrete_part=true
		ORDER BY m.id
	LOOP
		IF (data_row.supply_days_count IS NULL OR data_row.supply_days_count=0) THEN
			RAISE 'Для материала % не задано количество дней завоза.',data_row.material_descr;
		END IF;
		days_for_avg				= in_days_for_avg;
		material_id					= data_row.material_id;
		material_descr				= data_row.material_descr;
		supply_days_count			= data_row.supply_days_count;
		concrete_ship_period_avg	= data_row.concrete_ship_period_avg;
		user_data_mat_min_quant		= data_row.user_data_mat_min_quant;
		
		IF (concrete_ship_period_avg=0) THEN
			mat_cons_day_avg		= 0;
			mat_min_quant			= 0;
		ELSE
			mat_cons_day_avg		= ROUND(data_row.mat_cons_period_quant/data_row.concrete_ship_period_total,2);
			mat_min_quant			= mat_cons_day_avg * (7-supply_days_count+1) * concrete_ship_period_avg;
		END IF;
				
		IF (user_data_mat_min_quant>0) THEN
			v_mat_plan_procur = user_data_mat_min_quant;
		ELSE
			v_mat_plan_procur = mat_min_quant;
		END IF;
		
		v_mat_plan_cons = concrete_ship_period_avg*mat_cons_day_avg;
		v_i=0;
		WHILE v_i<=7 LOOP
			v_i = v_i + 1;
			
			day_descr[v_i] = date5_descr(data_row.day_descr[v_i]::date)::text;
			
			--morninig quantity 
			IF v_i=1 THEN
				day_mat_quant[1] = data_row.day1_quant;
				v_quant_end = day_mat_quant[1];
			ELSE
				day_mat_quant[v_i] = v_quant_end;
			END IF;
			
			v_do_param_change = (now()>v_monday_shift_start::date+((v_i-1||' days')::interval)+in_param_change);
			
			-- material consumption				
			IF v_do_param_change
			OR (data_row.day_mat_cons[v_i]>v_mat_plan_cons) THEN
				--fact consumption
				day_mat_cons[v_i] = data_row.day_mat_cons[v_i];
			ELSE
				--plan consumption
				day_mat_cons[v_i] = v_mat_plan_cons;
			END IF;
			
			-- material procurement
			/*Меняется на факт завоз в 8:00
			или если факт завоз>план.завоз
			*/
			IF v_do_param_change
			OR (data_row.day_mat_procur[v_i]>v_mat_plan_procur) THEN
				day_mat_procur[v_i] = data_row.day_mat_procur[v_i];
			
			/*Если на начало меньше дневного расхода
			*/
			ELSIF day_mat_quant[v_i]<day_mat_cons[v_i] THEN
				day_mat_procur[v_i] = day_mat_cons[v_i]*2-day_mat_quant[v_i]+(v_mat_plan_procur-day_mat_cons[v_i]-day_mat_quant[v_i])/supply_days_count;
				
			ELSIF (day_mat_quant[v_i]>day_mat_cons[v_i])
			AND (day_mat_quant[v_i]<(v_mat_plan_procur+day_mat_cons[v_i])) THEN
				day_mat_procur[v_i] = day_mat_cons[v_i]+(v_mat_plan_procur-day_mat_quant[v_i])/supply_days_count;
				
			ELSIF day_mat_quant[v_i]>(v_mat_plan_procur+day_mat_cons[v_i]) THEN
				day_mat_procur[v_i] = 0;
			END IF;
			
			day_mat_quant[v_i] = ROUND(day_mat_quant[v_i],2);
			day_mat_procur[v_i] = ROUND(day_mat_procur[v_i],2);
			day_mat_cons[v_i] = COALESCE(ROUND(day_mat_cons[v_i],2),0);
			
			v_quant_end = v_quant_end+day_mat_procur[v_i]-day_mat_cons[v_i];
		END LOOP;
		
		RETURN NEXT;
	END LOOP;
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION oper_week_report(int, interval)
  OWNER TO beton;
