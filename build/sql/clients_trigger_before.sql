-- Trigger: clients_trigger_before on clients

--DROP TRIGGER clients_trigger_before ON clients;

CREATE TRIGGER clients_trigger_before
  BEFORE INSERT OR UPDATE OR DELETE
  ON clients
  FOR EACH ROW
  EXECUTE PROCEDURE clients_process();
