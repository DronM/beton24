-- Function: get_schedule_on_vehicle(date, date, integer)

-- DROP FUNCTION get_schedule_on_vehicle(date, date, integer);

CREATE OR REPLACE FUNCTION get_schedule_on_vehicle(IN in_date_from date, IN in_date_to date, IN in_vehicle_id integer)
  RETURNS TABLE(day date, day_descr text, dow integer, shift integer) AS
$BODY$
BEGIN
	RETURN QUERY
		SELECT dates::date AS day,
			date8_descr(dates::date)::text AS day_descr,
			
			CASE EXTRACT(DOW FROM dates) 
				WHEN 0 THEN 7
				ELSE EXTRACT(DOW FROM dates)::int
			END AS dow,
			
			vs.shift AS shift

		FROM generate_series(in_date_from,in_date_to,'1 day') AS dates
		LEFT JOIN
			(SELECT 1 AS shift,vehicle_schedules.schedule_date FROM vehicle_schedules
			WHERE vehicle_schedules.vehicle_id=in_vehicle_id AND vehicle_schedules.schedule_date BETWEEN in_date_from AND in_date_to
			) AS vs ON vs.schedule_date = dates::date
		ORDER BY day;
 	

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION get_schedule_on_vehicle(date, date, integer)
  OWNER TO beton;
