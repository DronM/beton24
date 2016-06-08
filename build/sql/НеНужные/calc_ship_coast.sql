-- Function: calc_ship_coast(shipments, destinations, boolean)

-- DROP FUNCTION calc_ship_coast(shipments, destinations, boolean);

CREATE OR REPLACE FUNCTION calc_ship_coast(in_shipment shipments, in_destination destinations, for_account boolean)
  RETURNS numeric AS
$BODY$
BEGIN
--for_account - for account purposes
	RETURN
		CASE
			WHEN NOT for_account AND in_destination.id=constant_self_ship_dest_id() THEN
				constant_ship_coast_for_self_ship_destination()
			ELSE
				COALESCE(round(GREATEST(constant_min_quant_for_ship_coast()::numeric, in_shipment.quant::numeric) * in_destination.price::numeric, 2), 0::numeric)
		END;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION calc_ship_coast(shipments, destinations, boolean)
  OWNER TO beton;
