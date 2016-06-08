--Function: ui_storage_set(ui_storages)

--DROP FUNCTION ui_storage_set(ui_storages)
			
CREATE OR REPLACE FUNCTION ui_storage_set(ui_storages)
  RETURNS void AS
$BODY$
BEGIN
	UPDATE ui_storages
	SET
		data = $1.data
	WHERE ui_id=$1.ui_id AND user_id=$1.user_id;
	
	IF NOT FOUND THEN
		BEGIN
			INSERT INTO ui_storages
				(ui_id,user_id,data)
			VALUES ($1.ui_id,$1.user_id,$1.data);
		EXCEPTION WHEN OTHERS THEN
			UPDATE ui_storages
				SET data = $1.data
			WHERE ui_id=$1.ui_id AND user_id=$1.user_id;
		END;
	END IF;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE COST 100;
ALTER FUNCTION ui_storage_set(ui_storages)
OWNER TO beton;


