-- Function: get_order_date_time_to(timestampTZ, numeric, numeric, integer)

-- DROP FUNCTION get_order_date_time_to(timestampTZ, numeric, numeric, integer);

CREATE OR REPLACE FUNCTION get_order_date_time_to(in_date_time timestampTZ, in_quant numeric, unload_speed numeric, interval_min integer)
  RETURNS timestampTZ AS
$BODY$
	SELECT round_minutes($1 +
		to_char( (floor(60* $2/$3)::text || ' minutes')::interval, 'HH24:MI')::interval,$4);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_order_date_time_to(timestampTZ, numeric, numeric, integer)
  OWNER TO beton;
