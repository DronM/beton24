-- Function: lab_entry_report(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION lab_entry_report(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION lab_entry_report(
	IN in_date_time_from timestamp without time zone,
	IN in_date_time_to timestamp without time zone)
  RETURNS TABLE(
	concrete_type_descr text,
	ok numeric,
	weight numeric,
	p7 numeric,
	p7_avg_dev numeric,
	p28 numeric,
	p28_avg_dev numeric,
	cnt numeric) AS
$BODY$
	WITH
	base AS (
		SELECT * FROM lab_entry_base($1,$2)
	),
	det AS (
		SELECT
			sub.concrete_type_descr::text,
			sub.concrete_type_id,
			sub.shipment_id,
			round(avg(sub.ok)) AS ok,
			round(avg(sub.weight)) AS weight,
			
			CASE sum(p7_cnt)
				WHEN 0 THEN 0
				ELSE round(sum(sub.p7)/sum(sub.p7_cnt))
			END AS p7,
			
			CASE sum(p28_cnt)
				WHEN 0 THEN 0
				ELSE round(sum(sub.p28)/sum(sub.p28_cnt))
			END AS p28,

			COUNT(DISTINCT(sub.shipment_id)) AS cnt
		FROM base AS sub			
		GROUP BY sub.concrete_type_descr,sub.concrete_type_id,sub.shipment_id
		),
	det_p7_cnt AS (SELECT COUNT(*) AS cnt FROM det AS det1 WHERE det1.p7>0),	
	det_p28_cnt AS (SELECT COUNT(*) AS cnt FROM det AS det1 WHERE det1.p28>0)
		
	(
	SELECT
	det.concrete_type_descr,
	ROUND(
	CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.ok>0 AND sb.concrete_type_id=det.concrete_type_id)
		WHEN 0 THEN 0
		ELSE sum(det.ok)/(SELECT COUNT(*) FROM det AS sb WHERE sb.ok>0 AND sb.concrete_type_id=det.concrete_type_id)
	END,0) AS ok,

	ROUND(
	CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.weight>0 AND sb.concrete_type_id=det.concrete_type_id)
		WHEN 0 THEN 0
		ELSE sum(det.weight)/(SELECT COUNT(*) FROM det AS sb WHERE sb.weight>0 AND sb.concrete_type_id=det.concrete_type_id)
	END,0) AS weight,

	ROUND(
	CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.p7>0 AND sb.concrete_type_id=det.concrete_type_id)
		WHEN 0 THEN 0
		ELSE sum(det.p7)/(SELECT COUNT(*) FROM det AS sb WHERE sb.p7>0 AND sb.concrete_type_id=det.concrete_type_id)
	END,0) AS p7,

	round(COALESCE(dev_p7.p,0),0) AS p7_dev,

	ROUND(
	CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.p28>0 AND sb.concrete_type_id=det.concrete_type_id)
		WHEN 0 THEN 0
		ELSE sum(det.p28)/(SELECT COUNT(*) FROM det AS sb WHERE sb.p28>0 AND sb.concrete_type_id=det.concrete_type_id)
	END,0) AS p28,

	ROUND(COALESCE(dev_p28.p,0),0) AS p28_dev,

	sum(det.cnt) AS cnt
	
	FROM det
	LEFT JOIN 
	(		
		SELECT
			dev.concrete_type_id,
			avg(
			CASE 
				WHEN dev.p7>(SELECT avg(sb.p7) FROM det AS sb WHERE sb.concrete_type_id=dev.concrete_type_id AND sb.p7>0)
				THEN dev.p7-(SELECT avg(sb.p7) FROM det AS sb WHERE sb.concrete_type_id=dev.concrete_type_id AND sb.p7>0)
				ELSE (SELECT avg(sb.p7) FROM det AS sb WHERE sb.concrete_type_id=dev.concrete_type_id AND sb.p7>0)-dev.p7
			END) p

		FROM det AS dev WHERE dev.p7>0			
		GROUP BY dev.concrete_type_id						
	) AS dev_p7 ON dev_p7.concrete_type_id=det.concrete_type_id
	
	LEFT JOIN 
	(
		SELECT
			dev.concrete_type_id,
			avg(
			CASE 
				WHEN dev.p28>(SELECT avg(sb.p28) FROM det AS sb WHERE sb.concrete_type_id=dev.concrete_type_id AND sb.p28>0)
				THEN dev.p28-(SELECT avg(sb.p28) FROM det AS sb WHERE sb.concrete_type_id=dev.concrete_type_id AND sb.p28>0)
				ELSE (SELECT avg(sb.p28) FROM det AS sb WHERE sb.concrete_type_id=dev.concrete_type_id AND sb.p28>0)-dev.p28
			END) p

		FROM det AS dev WHERE dev.p28>0			
		GROUP BY dev.concrete_type_id
	) AS dev_p28 ON dev_p28.concrete_type_id=det.concrete_type_id
	
	GROUP BY det.concrete_type_descr,det.concrete_type_id,dev_p7.p,dev_p28.p
	ORDER BY det.concrete_type_descr)
	
	UNION ALL
	
	SELECT 'ИТОГО', --concrete_type_descr
		null, --ok
		null, --weight
	
		--p7
		CASE
		WHEN (SELECT det_p7_cnt.cnt FROM det_p7_cnt)=0 THEN 0
		ELSE ROUND(SUM(det.p7)/(SELECT det_p7_cnt.cnt FROM det_p7_cnt))
		END AS p7,
		null AS p7_avg_dev,
		
		--p28
		CASE
		WHEN (SELECT det_p28_cnt.cnt FROM det_p28_cnt)=0 THEN 0
		ELSE ROUND(SUM(det.p28)/(SELECT det_p28_cnt.cnt FROM det_p28_cnt))
		END AS p28,
		null AS p28_avg_dev,
		
		--count
		SUM(det.cnt) AS cnt FROM det;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 20;
ALTER FUNCTION lab_entry_report(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
