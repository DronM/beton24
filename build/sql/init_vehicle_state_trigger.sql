-- Trigger: init_vehicle_state on vehicle_schedules

-- DROP TRIGGER init_vehicle_state ON vehicle_schedules;

CREATE TRIGGER init_vehicle_state
  AFTER INSERT
  ON vehicle_schedules
  FOR EACH ROW
  EXECUTE PROCEDURE init_vehicle_state();
