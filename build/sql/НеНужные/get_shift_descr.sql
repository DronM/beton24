-- Function: get_shift_descr(timestamp without time zone)

-- DROP FUNCTION get_shift_descr(timestamp without time zone);

CREATE OR REPLACE FUNCTION get_shift_descr(timestamp without time zone)
  RETURNS text AS
$BODY$
DECLARE res text;
BEGIN
	SELECT date5_time5_descr(shift_start) || ' - ' ||  date5_time5_descr(shift_end) INTO res
	FROM get_shift_bounds($1) AS (shift_start timestamp,shift_end timestamp);
	RETURN res;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION get_shift_descr(timestamp without time zone)
  OWNER TO beton;
