-- Trigger: users_trigger_before on users

-- DROP TRIGGER users_trigger_before ON users;

CREATE TRIGGER users_trigger_before
  BEFORE DELETE
  ON users
  FOR EACH ROW
  EXECUTE PROCEDURE users_process();
