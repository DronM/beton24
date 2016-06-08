-- Trigger: shedule_process_before_insert on vehicle_schedules

-- DROP TRIGGER shedule_process_before_insert ON vehicle_schedules;

CREATE TRIGGER shedule_process_before_insert
  BEFORE INSERT
  ON vehicle_schedules
  FOR EACH ROW
  EXECUTE PROCEDURE schedule_process();

