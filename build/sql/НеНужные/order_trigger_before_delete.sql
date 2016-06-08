-- Trigger: order_trigger_before_delete on orders

-- DROP TRIGGER order_trigger_before_delete ON orders;

CREATE TRIGGER order_trigger_before_delete
  BEFORE DELETE
  ON orders
  FOR EACH ROW
  EXECUTE PROCEDURE order_delete();
