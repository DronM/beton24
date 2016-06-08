-- Function: shipments_set_on_load(shipment_id int)

-- DROP FUNCTION shipment_set_on_load(shipment_id int);

CREATE OR REPLACE FUNCTION shipment_set_on_load(shipment_id int)
  RETURNS VOID AS
$BODY$  	
BEGIN
	--RAISE '%',$1;
	IF $1 IS NULL OR $1=0 THEN     
		DELETE FROM shipment_on_load;
	ELSE
		DELETE FROM order_for_operator_queue t WHERE t.-------шщдэшщъдхъщжэъшэж
		ю.
		лэю.
		лю.
		дю
		ээ
		длъъъshipment_id=$1;
		
		UPDATE shipment_on_load SET shipment_id=$1;
		IF FOUND THEN
			RETURN;
		END IF;
		BEGIN
			INSERT INTO shipment_on_load (shipment_id) VALUES ($1);
		EXCEPTION WHEN OTHERS THEN
			UPDATE shipment_on_load SET shipment_id=$1;
		END;
	END IF;
    RETURN;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE CALLED ON NULL INPUT
  COST 100;
ALTER FUNCTION shipment_set_on_load(shipment_id int) OWNER TO beton;
