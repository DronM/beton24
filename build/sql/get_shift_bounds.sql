-- Function: get_shift_bounds(timestampTZ)

-- DROP FUNCTION get_shift_bounds(timestampTZ);

CREATE OR REPLACE FUNCTION get_shift_bounds(timestampTZ)
  RETURNS record AS
$BODY$
WITH start_time AS (
	SELECT
		(CASE
			WHEN $1::timeTZ<const_shift_start_val() THEN
				$1::date - 1
			ELSE $1::date
		END
		+const_shift_start_val()::timeTZ)::timestampTZ
		AS val
)
SELECT
	(
	--from
	(SELECT val FROM start_time),
	--to
	(SELECT val FROM start_time)
	+const_shift_length_val() - '00:00:01'::interval
	);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_shift_bounds(timestampTZ)
  OWNER TO beton;
