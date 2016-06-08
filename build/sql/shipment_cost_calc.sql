-- Function: shipment_cost_calc(shipments, destinations)

-- DROP FUNCTION shipment_cost_calc(shipments, destinations);

CREATE OR REPLACE FUNCTION shipment_cost_calc(shipments, destinations)
  RETURNS numeric(15,2) AS
$BODY$
	SELECT 0::numeric(15,2);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION shipment_cost_calc(shipments, destinations)
  OWNER TO beton;
