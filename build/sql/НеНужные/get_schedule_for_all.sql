-- Function: get_schedule_for_all(date, date, integer)

-- DROP FUNCTION get_schedule_for_all(date, date, integer);

CREATE OR REPLACE FUNCTION get_schedule_for_all(IN in_date_from date, IN in_date_to date, IN in_vehicle_id integer)
  RETURNS TABLE(day date, day_descr text, dow integer, dow_descr text, week_end integer, plate text, owner text, day_no_shift boolean) AS
$BODY$
BEGIN
	RETURN QUERY
		SELECT dt::date AS day,
		date8_descr(dt::date)::text AS day_descr,
		EXTRACT(DOW FROM dt::date)::int AS dow,
		dow_descr_short(dt::date)::text AS dow_descr,
		CASE EXTRACT(DOW FROM dt::date)
			WHEN 0 THEN 1
			WHEN 6 THEN 1
			ELSE 0
		END AS week_end,
		v.plate::text,
		v.owner::text,
		v.id IS NULL AS day_no_shift

		FROM generate_series(in_date_from,in_date_to,'1 day') AS dt
		LEFT JOIN (
			SELECT DISTINCT ON (s.vehicle_id,s.schedule_date) s.vehicle_id,s.schedule_date
			FROM vehicle_schedules AS s
			WHERE s.schedule_date BETWEEN in_date_from AND in_date_to
			AND	CASE 
					WHEN (in_vehicle_id IS NULL) OR (in_vehicle_id=0) THEN true
					ELSE s.vehicle_id=in_vehicle_id
				END
		) AS sched ON sched.schedule_date=dt::date
		LEFT JOIN vehicles AS v ON v.id=sched.vehicle_id
		ORDER BY dt,owner,plate;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION get_schedule_for_all(date, date, integer)
  OWNER TO beton;
