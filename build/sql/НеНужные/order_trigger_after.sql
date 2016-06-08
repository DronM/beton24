-- Trigger: order_trigger_after on orders

-- DROP TRIGGER order_trigger_after ON orders;

CREATE TRIGGER order_trigger_after
  AFTER INSERT OR UPDATE
  ON orders
  FOR EACH ROW
  EXECUTE PROCEDURE order_after_process();
