-- Function: get_working_ratio(date)

-- DROP FUNCTION get_working_ratio(date);

CREATE OR REPLACE FUNCTION get_working_ratio(date)
  RETURNS numeric AS
$BODY$
	SELECT
	round( (
			EXTRACT(EPOCH FROM (
				SELECT date_trunc('second',AVG(tm)) FROM at_work_time(
					$1 +constant_first_shift_start_time()::interval,
					CASE
						WHEN $1<>CURRENT_DATE THEN
							$1 +constant_first_shift_start_time()::interval + constant_day_shift_length()::interval
						ELSE
							LEAST(CURRENT_TIMESTAMP::timestamp without time zone, $1 +constant_first_shift_start_time()::interval + constant_day_shift_length()::interval)
					END
					)
				))
		/
			EXTRACT(EPOCH FROM (
				CASE
					WHEN $1<>CURRENT_DATE
						THEN constant_day_shift_length()::interval
					ELSE LEAST(CURRENT_TIMESTAMP::time::interval-constant_first_shift_start_time()::interval, constant_day_shift_length()::interval)
				END
				))
		)::numeric ,2)*100::numeric;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_working_ratio(date)
  OWNER TO beton;
