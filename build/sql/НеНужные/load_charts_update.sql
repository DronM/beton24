-- Function: load_charts_update(IN in_date date, IN in_image bytea, IN in_state int)

--DROP FUNCTION load_charts_update(IN in_date date, IN in_image bytea, IN in_state int)

CREATE OR REPLACE FUNCTION load_charts_update(IN in_date date, IN in_image bytea, IN in_state int) RETURNS void as $$
BEGIN
	UPDATE load_charts SET image = in_image, state=in_state WHERE id=in_date;
	
	IF FOUND THEN
		RETURN;
	END IF;
	BEGIN
		INSERT INTO load_charts(id, image, state) VALUES (in_date, in_image, in_state);
	EXCEPTION WHEN OTHERS THEN
		UPDATE load_charts SET image = in_image, state=in_state WHERE id=in_date;
		END;
	RETURN;
END;
$$ language plpgsql;

ALTER FUNCTION load_charts_update(IN in_date date, IN in_image bytea, IN in_state int)
OWNER TO beton;
