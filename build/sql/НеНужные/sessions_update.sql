-- Function: sessions_update(IN in_id varchar(128), IN in_set_time varchar(10), IN in_data text, IN in_session_key varchar(128))

--DROP FUNCTION sessions_update(IN in_id varchar(128), IN in_set_time varchar(10), IN in_data text, IN in_session_key varchar(128))

CREATE OR REPLACE FUNCTION sessions_update(IN in_id varchar(128), IN in_set_time varchar(10), IN in_data text, IN in_session_key varchar(128)) RETURNS void as $$
BEGIN
	UPDATE sessions SET
		set_time = in_set_time,
		data = in_data
	WHERE id=in_id;
	
	IF FOUND THEN
		RETURN;
	END IF;
	BEGIN
		INSERT INTO sessions (id,set_time,data,session_key)
			VALUES (in_id,in_set_time,in_data,
			encode(digest(now()::text, 'sha512'::text),'base64'));
	EXCEPTION WHEN OTHERS THEN
		UPDATE sessions SET
			set_time = in_set_time,
			data = in_data,
			session_key = in_session_key
		WHERE id=in_id;
	END;
	RETURN;
END;
$$ language plpgsql;

ALTER FUNCTION sessions_update(IN in_id varchar(128), IN in_set_time varchar(10), IN in_data text, IN in_session_key varchar(128), IN in_pub_key varchar(15))
OWNER TO beton;
