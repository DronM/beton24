-- Function: clients_process()

-- DROP FUNCTION clients_process();

CREATE OR REPLACE FUNCTION clients_process()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_OP='INSERT' OR TG_OP='UPDATE') THEN
	
		/* пустое полное имя*/
		IF NEW.name_full IS NULL OR NEW.name_full='' THEN
			NEW.name_full = NEW.name;
		END IF;
		IF NEW.create_date IS NULL THEN
			NEW.create_date = now()::date;
		END IF;
		
		RETURN NEW;
	
	ELSIF (TG_OP='DELETE') THEN
		--Удаление контактов клиента
		DELETE FROM client_contacts WHERE client_id = OLD.id;

		RETURN OLD;
	END IF;
	
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION clients_process() OWNER TO beton;
