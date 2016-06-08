-- Function: clients_process()

-- DROP FUNCTION clients_process();

CREATE OR REPLACE FUNCTION clients_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_b boolean;
BEGIN
	IF (TG_OP='INSERT' OR TG_OP='UPDATE') THEN
	
		/* пустое полное имя*/
		IF NEW.name_full IS NULL OR NEW.name_full='' THEN
			NEW.name_full = NEW.name;
		END IF;
		IF NEW.create_date IS NULL THEN
			NEW.create_date = now()::date;
		END IF;
		
	END IF;
	
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION clients_process() OWNER TO beton;
