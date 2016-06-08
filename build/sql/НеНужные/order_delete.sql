-- Function: order_delete()

-- DROP FUNCTION order_delete();

CREATE OR REPLACE FUNCTION order_delete()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_OP='DELETE') THEN
		DELETE FROM order_pumps WHERE order_id=OLD.id;
		RETURN OLD;
	END IF;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION order_delete()
  OWNER TO beton;
