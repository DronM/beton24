CREATE OR REPLACE FUNCTION lab_entry_details_trigger()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_WHEN='AFTER' AND TG_OP='INSERT') THEN
		INSERT INTO lab_entry_details (shipment_id,id) VALUES (NEW.shipment_id,1),(NEW.shipment_id,2),(NEW.shipment_id,3),(NEW.shipment_id,4);
		RETURN NEW;
	ELSIF (TG_WHEN='AFTER' AND TG_OP='DELETE') THEN
		DELETE FROM lab_entry_details WHERE shipment_id = OLD.shipment_id;
		RETURN OLD;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION lab_entry_details_trigger() OWNER TO beton;
