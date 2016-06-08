-- Function: client_tels_process()

-- DROP FUNCTION client_tels_process();

CREATE OR REPLACE FUNCTION client_tels_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_b boolean;
BEGIN
	IF (TG_OP='INSERT' OR TG_OP='UPDATE') THEN
	
		/* пустое имя в имя клиента!*/
		IF NEW.name IS NULL OR NEW.name='' THEN
			SELECT name INTO NEW.name
			FROM clients WHERE id=NEW.client_id;
		END IF;
		
		--проверка на повтор телефона у клиента
		/*
		IF (SELECT TRUE
			FROM client_tels AS t
			WHERE
				t.client_id=NEW.client_id
				AND t.tel=NEW.tel		
		) THEN
			RAISE EXCEPTION 'Контакт с телефоном % уже есть у клиента!',NEW.tel;
		END IF;
		*/
	END IF;
	
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION client_tels_process() OWNER TO beton;
