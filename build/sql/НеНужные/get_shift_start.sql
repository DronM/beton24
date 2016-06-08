-- Function: get_shift_start(timestampTZ)

-- DROP FUNCTION get_shift_start(timestampTZ);

CREATE OR REPLACE FUNCTION get_shift_start(timestampTZ)
  RETURNS timestampTZ AS
$BODY$
SELECT
	CASE
		WHEN $1::timeTZ<const_shift_start_val() THEN
			$1::date - 1
		ELSE $1::date
	END
	+const_shift_start_val()::timeTZ;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_shift_start(timestampTZ)
  OWNER TO beton;
