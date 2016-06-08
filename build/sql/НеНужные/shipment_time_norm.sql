-- Function: shipment_time_norm(numeric)

--DROP FUNCTION shipment_time_norm(numeric);

CREATE OR REPLACE FUNCTION shipment_time_norm(numeric)
  RETURNS int AS
$BODY$
	SELECT t.norm_min
	FROM shipment_time_norms AS t
	WHERE t.id=ROUND($1,0);
	--5+(ROUND($1,0)::integer-1)*2;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION shipment_time_norm(numeric)
  OWNER TO beton;
