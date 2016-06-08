-- Function: get_shift_end(timestampTZ)

-- DROP FUNCTION get_shift_end(timestampTZ);

CREATE OR REPLACE FUNCTION get_shift_end(timestampTZ)
  RETURNS timestampTZ AS
$BODY$
	SELECT $1 + constant_shift_length_time() - '00:00:01'::time;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_shift_end(timestampTZ)
  OWNER TO beton;
