-- Function: contacts_process()

-- DROP FUNCTION contacts_process();

CREATE OR REPLACE FUNCTION contacts_process()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_OP='DELETE') THEN
		--Удаление контактов клиента
		DELETE FROM contact_contact_details WHERE contact_id = OLD.id;

		RETURN OLD;
	END IF;
	
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION contacts_process() OWNER TO beton;
