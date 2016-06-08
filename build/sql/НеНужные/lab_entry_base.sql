-- Function: lab_entry_base(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION lab_entry_base(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION lab_entry_base(
	IN in_date_time_from timestamp without time zone,
	IN in_date_time_to timestamp without time zone)
  RETURNS TABLE(
	concrete_type_id integer,
	concrete_type_descr text,
	shipment_id integer,
	ok integer,
	weight numeric,
	p7 numeric,
	p28 numeric,
	p7_cnt integer,
	p28_cnt integer
	) AS
$BODY$
	SELECT
		concr.id AS concrete_type_id,
		concr.name::text AS concrete_type_descr,
		lab.shipment_id AS shipment_id,
		COALESCE(lab.ok,0) AS ok,
		COALESCE(lab.weight,0::numeric) AS weight,		
		CASE
			WHEN (concr.pres_norm IS NOT NULL AND concr.pres_norm>0) AND (lab.id<3) THEN
				COALESCE(lab.kn/concr.mpa_ratio/ concr.pres_norm*100,0)
			ELSE 0
		END		
		AS p7,
		CASE
			WHEN (concr.pres_norm IS NOT NULL AND concr.pres_norm>0) AND (lab.id>=3) THEN
				COALESCE(lab.kn/concr.mpa_ratio/ concr.pres_norm*100,0)
			ELSE 0
		END		
		AS p28,
		CASE
			WHEN (concr.pres_norm IS NOT NULL AND concr.pres_norm>0) AND (lab.id<3) AND ((lab.kn/concr.mpa_ratio/ concr.pres_norm*100)>0) THEN 1
			ELSE 0
		END AS p7_cnt,
		
		CASE
			WHEN (concr.pres_norm IS NOT NULL AND concr.pres_norm>0) AND (lab.id>=3) AND ((lab.kn/concr.mpa_ratio/ concr.pres_norm*100)>0) THEN 1
			ELSE 0
		END AS p28_cnt
	FROM lab_entry_details AS lab
	LEFT JOIN shipments AS sh ON sh.id=lab.shipment_id
	LEFT JOIN orders AS o ON o.id=sh.order_id
	LEFT JOIN concrete_types AS concr ON concr.id=o.concrete_type_id
	WHERE sh.date_time BETWEEN $1 AND $2 AND (lab.ok>0 OR lab.weight>0);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION lab_entry_base(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
