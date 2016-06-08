-- Function: set_vehicle_free()

-- DROP FUNCTION set_vehicle_free();

CREATE OR REPLACE FUNCTION set_vehicle_free()
  RETURNS trigger AS
$BODY$
BEGIN
	DELETE FROM vehicle_schedule_states WHERE shipment_id = OLD.id;

	IF (OLD.shipped=true) THEN
		--register actions	
		PERFORM ra_materials_remove_acts('shipment'::doc_types,OLD.id);
		PERFORM ra_material_consumption_remove_acts('shipment'::doc_types,OLD.id);
	END IF;
	
	RETURN OLD;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION set_vehicle_free()
  OWNER TO beton;
