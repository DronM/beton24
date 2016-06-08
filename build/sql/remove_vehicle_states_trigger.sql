-- Trigger: remove_vehicle_states on vehicle_schedules

-- DROP TRIGGER remove_vehicle_states ON vehicle_schedules;

CREATE TRIGGER remove_vehicle_states
  BEFORE DELETE
  ON vehicle_schedules
  FOR EACH ROW
  EXECUTE PROCEDURE remove_vehicle_states();

