/*Function: lab_avg_vals_report(
		timestamp without time zone,
		timestamp without time zone,
		cnt_for_avg int,
		concrete_type_ids integer[]
		)
*/
/*
DROP Function lab_avg_vals_report(
		timestamp without time zone,
		timestamp without time zone,
		cnt_for_avg int,
		concrete_type_ids integer[]
		);

*/
/*
возвращает таблицу средних значений
за период по списку материалов
за определенное кол-во дней для средней
*/

CREATE OR REPLACE FUNCTION lab_avg_vals_report(
		timestamp without time zone,
		timestamp without time zone,
		cnt_for_avg int,
		concrete_type_ids integer[]
		)
  RETURNS TABLE(	
	concrete_type_id integer,
	concrete_type_descr text,
	shipment_date date,
	ok numeric,
	weight numeric,
	p7 numeric,
	p28 numeric,
	cnt numeric
	) AS
$BODY$
	WITH
	base AS (
		SELECT b.*
		FROM lab_entry_base($1,$2) AS b
		WHERE
			($4 IS NULL)
			OR
			(b.concrete_type_id = ANY ($4))
	),
	det AS (
		SELECT
			sub.concrete_type_descr::text,
			sub.concrete_type_id,
			sub.shipment_id,
			sh.date_time::date AS shipment_date,
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
		LEFT JOIN shipments AS sh ON sh.id=sub.shipment_id
		GROUP BY
			sub.concrete_type_descr,
			sub.concrete_type_id,
			sub.shipment_id,
			sh.date_time::date
	)
	SELECT
		det.concrete_type_id,
		det.concrete_type_descr,
		det.shipment_date,
		
		--ok
		AVG(
			ROUND(
			CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.ok>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
				WHEN 0 THEN 0
				ELSE SUM(det.ok)/(SELECT COUNT(*) FROM det AS sb WHERE sb.ok>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
			END,0)
		)
		OVER (
			ORDER BY det.shipment_date
			ROWS BETWEEN $3-1 preceding AND CURRENT ROW
		) AS ok,
			
		--weight
		AVG(	
			ROUND(
			CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.weight>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
				WHEN 0 THEN 0
				ELSE sum(det.weight)/(SELECT COUNT(*) FROM det AS sb WHERE sb.weight>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
			END,0)
		) 
		OVER (
			ORDER BY det.shipment_date
			ROWS BETWEEN $3-1 preceding AND CURRENT ROW
		) AS weight,

		--p7
		AVG(
			ROUND(
			CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.p7>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
				WHEN 0 THEN 0
				ELSE sum(det.p7)/(SELECT COUNT(*) FROM det AS sb WHERE sb.p7>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
			END,0)
		)
		OVER (
			ORDER BY det.shipment_date
			ROWS BETWEEN $3-1 preceding AND CURRENT ROW
		) AS p7,

		AVG(
			ROUND(
			CASE (SELECT COUNT(*) FROM det AS sb WHERE sb.p28>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
				WHEN 0 THEN 0
				ELSE sum(det.p28)/(SELECT COUNT(*) FROM det AS sb WHERE sb.p28>0 AND sb.concrete_type_id=det.concrete_type_id AND sb.shipment_date=det.shipment_date)
			END,0)
		)
		OVER (
			ORDER BY det.shipment_date
			ROWS BETWEEN $3-1 preceding AND CURRENT ROW
		) AS p28,
		

		AVG(
			sum(det.cnt)
		)
		OVER (
			ORDER BY det.shipment_date
			ROWS BETWEEN $3-1 preceding AND CURRENT ROW
		) AS cnt
		
	FROM det
	GROUP BY
		det.concrete_type_descr,
		det.concrete_type_id,
		det.shipment_date
	ORDER BY
		det.concrete_type_descr,
		det.shipment_date;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 20
  CALLED ON NULL INPUT;
ALTER FUNCTION lab_avg_vals_report(
		timestamp without time zone,
		timestamp without time zone,
		cnt_for_avg int,
		concrete_type_ids integer[]
		)
OWNER TO beton;
