-- Trigger: client_tels_trigger_before on client_tels

--DROP TRIGGER client_tels_trigger_before ON client_tels;

CREATE TRIGGER client_tels_trigger_before
  BEFORE INSERT OR UPDATE
  ON client_tels
  FOR EACH ROW
  EXECUTE PROCEDURE client_tels_process();
