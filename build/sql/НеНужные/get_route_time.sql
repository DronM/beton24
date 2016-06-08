-- Function: get_route_time(integer)

-- DROP FUNCTION get_route_time(integer);

CREATE OR REPLACE FUNCTION get_route_time(integer)
  RETURNS time without time zone AS
$BODY$
	SELECT coalesce(d.time_route,'00:00'::time) * 2 + constant_vehicle_unload_time() FROM shipments AS sh
	LEFT JOIN orders AS o ON o.id=sh.order_id
	LEFT JOIN destinations AS d ON d.id=o.destination_id
	WHERE sh.id=$1;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_route_time(integer)
  OWNER TO beton;
