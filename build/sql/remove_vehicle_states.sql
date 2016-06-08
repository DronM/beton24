-- Function: remove_vehicle_states()

-- DROP FUNCTION remove_vehicle_states();

CREATE OR REPLACE FUNCTION remove_vehicle_states()
  RETURNS trigger AS
$BODY$
BEGIN
	DELETE FROM vehicle_schedule_states WHERE (schedule_id=OLD.id);
	RETURN OLD;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION remove_vehicle_states()
  OWNER TO beton;

