-- Function: specialist_requests_process()

-- DROP FUNCTION specialist_requests_process();

CREATE OR REPLACE FUNCTION specialist_requests_process()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_OP='INSERT') THEN
	
		NEW.client_id = (
			SELECT ccd.client_id
			FROM client_contact_details ccd
			WHERE ccd.contact_detail=
				(
				SELECT  cd.id FROM contact_details cd
				WHERE cd.value = RIGHT(NEW.tel,11)
				)
		);		
	END IF;
	
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION specialist_requests_process()
  OWNER TO beton;
