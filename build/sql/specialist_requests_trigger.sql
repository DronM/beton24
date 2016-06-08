-- Trigger: specialist_requests_trigger_before on specialist_requests

DROP TRIGGER specialist_requests_trigger_before ON specialist_requests;

CREATE TRIGGER specialist_requests_trigger_before
  BEFORE INSERT
  ON specialist_requests
  FOR EACH ROW
  EXECUTE PROCEDURE specialist_requests_process();
