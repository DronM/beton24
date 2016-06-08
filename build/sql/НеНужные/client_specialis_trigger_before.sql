-- Trigger: specialist_requests_trigger_before on ast_calls

--DROP TRIGGER specialist_requests_trigger_before ON ast_calls;

CREATE TRIGGER specialist_requests_trigger_before
  BEFORE INSERT OR UPDATE
  ON specialist_requests
  FOR EACH ROW
  EXECUTE PROCEDURE specialist_requests_process();
