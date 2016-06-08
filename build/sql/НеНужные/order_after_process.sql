-- Function: order_after_process()

-- DROP FUNCTION order_after_process();

CREATE OR REPLACE FUNCTION order_after_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_f boolean;
BEGIN	
	IF (TG_WHEN='AFTER'
	AND (TG_OP='INSERT' OR (TG_OP='UPDATE'
		AND NEW.phone_cel<>''
		AND (
			(NEW.client_id<>OLD.client_id)
			OR (NEW.phone_cel<>OLD.phone_cel)
		)
		)
		)
	)THEN		
		SELECT
			TRUE
		INTO v_f FROM client_tels
		WHERE client_id = NEW.client_id
			AND tel=NEW.phone_cel;
		
		IF v_f IS NULL THEN
			
			BEGIN
				INSERT INTO client_tels
					(client_id,tel,name)
				VALUES (NEW.client_id,NEW.phone_cel,NEW.descr);
			EXCEPTION WHEN OTHERS THEN
			END;
		END IF;
		
	END IF;
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION order_after_process()
  OWNER TO beton;
