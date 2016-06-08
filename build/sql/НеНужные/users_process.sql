-- Function: users_process()

-- DROP FUNCTION users_process();

CREATE OR REPLACE FUNCTION users_process()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_WHEN='BEFORE' AND TG_OP='DELETE') THEN
		DELETE FROM logins
		WHERE user_id = OLD.id;
		
		RETURN OLD;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION users_process()
  OWNER TO beton;
