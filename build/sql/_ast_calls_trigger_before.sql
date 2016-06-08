-- Trigger: ast_calls_trigger_before on ast_calls

--DROP TRIGGER ast_calls_trigger_before ON ast_calls;

CREATE TRIGGER ast_calls_trigger_before
  BEFORE INSERT OR UPDATE
  ON ast_calls
  FOR EACH ROW
  EXECUTE PROCEDURE ast_calls_process();
