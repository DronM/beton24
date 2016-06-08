-- Function: lab_item_on_rate_period_report(timestamp without time zone, timestamp without time zone, integer, integer)

--DROP FUNCTION lab_item_on_rate_period_report(timestamp without time zone, timestamp without time zone, integer, integer);

CREATE OR REPLACE FUNCTION lab_item_on_rate_period_report(
	IN in_date_time_from timestamp without time zone,
	IN in_date_time_to timestamp without time zone,
	IN in_cnt integer,
	IN in_item_type integer
	)
  RETURNS TABLE(
	period_date date,
	period text,
	concrete_type_id integer,
	concrete_type_descr text,
	val numeric,
	cnt bigint
	) AS
$BODY$
	WITH
	base AS (SELECT * FROM lab_entry_base($1, $2)),
	det AS (
		SELECT
			sub.concrete_type_descr::text,
			sub.concrete_type_id,
			sub.shipment_id,
			sh.ship_date_time::date AS period,
			
			round(avg(sub.ok)) AS ok,
			round(avg(sub.weight)) AS weight,
			
			CASE sum(sub.p7_cnt)
				WHEN 0 THEN 0
				ELSE round(sum(sub.p7)/sum(sub.p7_cnt))
			END AS p7,
			sum(sub.p7_cnt) AS p7_cnt,
			
			CASE sum(sub.p28_cnt)
				WHEN 0 THEN 0
				ELSE round(sum(sub.p28)/sum(sub.p28_cnt))
			END AS p28,
			sum(sub.p28_cnt) AS p28_cnt
			
		FROM base AS sub
		LEFT JOIN shipments AS sh ON sh.id=sub.shipment_id			
		GROUP BY sub.concrete_type_descr,sub.concrete_type_id,sub.shipment_id,period
		)
	
	SELECT
		--date_trunc('MONTH', w.per)::date AS period_date,
		--get_period_rus(date_trunc('MONTH', w.per)::date,'YYYY') AS period,		
		rate_per.d_from AS period_date,
		date8_descr(rate_per.d_from::date)||' - '||date8_descr(rate_per.d_to::date)||' '||COALESCE(rate_per.name,'') AS period,
		w.concrete_type_id,
		w.concrete_type_descr,
		
		(CASE
		WHEN $4=0 THEN coalesce(round(avg(sub_val_ok.ok)),0)
			--ok
			
		WHEN $4=1 THEN coalesce(round(avg(w.weight)),0)
			--weight
			
		WHEN $4=2 THEN coalesce(round(avg(sub_val_p7.p7)),0)
			--p7
			
		WHEN $4=3 THEN 
			coalesce(round(avg(sub_val_p28.p28)),0)
			--p28
			
		WHEN $4=4 THEN coalesce(round(sum(w.cnt)::numeric),0)
			--cnt			
		ELSE 0
		END)::numeric AS val,
		
		sum(w.cnt)::bigint AS cnt
	FROM (
		SELECT
			sb.concrete_type_id,
			sb.concrete_type_descr,
			sb.period AS per,
			round(avg(sb.weight)) AS weight,
			count(DISTINCT(sb.shipment_id)) AS cnt
		FROM det AS sb WHERE sb.weight>0
		GROUP BY sb.concrete_type_id,sb.concrete_type_descr,sb.period
	) As w
	
	LEFT JOIN (
		SELECT 
			rd.dt AS d_from,
			(SELECT t.dt-'1 day'::interval
			FROM raw_material_cons_rate_dates t
			WHERE t.dt > rd.dt
			ORDER BY t.dt ASC
			LIMIT 1
			) AS d_to,
			rd.name			
		FROM raw_material_cons_rate_dates AS rd
	) AS rate_per ON
		w.per BETWEEN rate_per.d_from AND rate_per.d_to
	--ok
	LEFT JOIN (
		SELECT
			sb.concrete_type_id,
			sb.period AS per,
			round(avg(sb.ok)) AS ok
		FROM det AS sb WHERE sb.ok>0
		GROUP BY sb.concrete_type_id,sb.period
		) AS sub_val_ok ON sub_val_ok.concrete_type_id=w.concrete_type_id AND sub_val_ok.per=w.per

	--p7
	LEFT JOIN (
		SELECT
			sb.concrete_type_id,
			sb.period AS per,
			round(avg(sb.p7)) AS p7
		FROM det AS sb WHERE sb.p7>0
		GROUP BY sb.concrete_type_id,sb.period
		) AS sub_val_p7 ON sub_val_p7.concrete_type_id=w.concrete_type_id AND sub_val_p7.per=w.per

	--p28
	LEFT JOIN (
		SELECT
			sb.concrete_type_id,
			sb.period AS per,
			round(avg(sb.p28)) AS p28
		FROM det AS sb WHERE sb.p28>0
		GROUP BY sb.concrete_type_id,sb.period
		) AS sub_val_p28 ON sub_val_p28.concrete_type_id=w.concrete_type_id AND sub_val_p28.per=w.per
		
	GROUP BY w.concrete_type_id,w.concrete_type_descr,period,period_date
	
	HAVING sum(w.cnt)>=$3
	ORDER BY w.concrete_type_descr,period_date;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION lab_item_on_rate_period_report(timestamp without time zone, timestamp without time zone, integer, integer)
  OWNER TO beton;
