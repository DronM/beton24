-- Function: shipment_descr(shipments)

-- DROP FUNCTION shipment_descr(shipments);

CREATE OR REPLACE FUNCTION shipment_descr(shipments)
  RETURNS text AS
$BODY$
	SELECT '№ ' || $1.id || ' от ' || date8_descr($1.ship_date_time::date);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION shipment_descr(shipments)
  OWNER TO beton;
