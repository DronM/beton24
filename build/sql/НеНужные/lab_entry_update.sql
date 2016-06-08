/*Function: lab_entry_update(
			integer,text,text,text,text)
*/			
/*
DROP FUNCTION lab_entry_update(
			integer,text,text,text,text);
*/
			
CREATE OR REPLACE FUNCTION lab_entry_update(
			IN in_shipment_id integer,
			IN in_samples text,
			IN in_materials text,
			IN in_ok2 text,
			IN in_time text
			)
  RETURNS void AS
$BODY$
BEGIN
	UPDATE lab_entries
	SET
		samples = in_samples,
		materials = in_materials,
		ok2 = in_ok2,
		time = in_time
	WHERE shipment_id=in_shipment_id;
	IF NOT FOUND THEN
		BEGIN
			INSERT INTO lab_entries
				(shipment_id,samples,materials,ok2,time)
			VALUES (in_shipment_id,in_samples,in_materials,in_ok2,in_time);
		EXCEPTION WHEN OTHERS THEN
			UPDATE lab_entries
			SET
				samples = in_samples,
				materials = in_materials,
				ok2 = in_ok2,
				time = in_time
			WHERE shipment_id=in_shipment_id;
		END;
	END IF;

END;
$BODY$
  LANGUAGE plpgsql VOLATILE COST 100;
ALTER FUNCTION lab_entry_update(integer,text,text,text,text) OWNER TO beton;


