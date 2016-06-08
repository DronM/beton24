-- Trigger: calls_trigger_before on calls

--DROP TRIGGER calls_trigger_before ON calls;

CREATE TRIGGER calls_trigger_before
  BEFORE INSERT OR UPDATE
  ON calls
  FOR EACH ROW
  EXECUTE PROCEDURE calls_process();
