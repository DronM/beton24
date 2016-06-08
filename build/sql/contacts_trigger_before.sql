-- Trigger: contacts_trigger_before on contacts

--DROP TRIGGER contacts_trigger_before ON contacts;

CREATE TRIGGER contacts_trigger_before
  BEFORE DELETE
  ON contacts
  FOR EACH ROW
  EXECUTE PROCEDURE contacts_process();
