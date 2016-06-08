-- Function: recalc_consumption(integer)

-- DROP FUNCTION recalc_consumption(integer)

CREATE OR REPLACE FUNCTION recalc_consumption(IN in_period_id integer)
  RETURNS void AS
$BODY$  
	WITH dates AS (
		SELECT get_shift_start(d.dt::timestamp without time zone) As date_from,
		get_shift_end(get_shift_start(COALESCE(
			(SELECT d2.dt FROM raw_material_cons_rate_dates AS d2 WHERE d2.dt>d.dt ORDER BY d2.dt ASC LIMIT 1),
			now()::timestamp without time zone)
			)) AS date_to
		FROM raw_material_cons_rate_dates AS d
		WHERE d.id=$1
		)
	UPDATE shipments
		SET shipped=true
	WHERE shipped AND ship_date_time BETWEEN (SELECT date_from FROM dates) AND (SELECT date_to FROM dates)
$BODY$  
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION recalc_consumption(integer)
  OWNER TO beton;
