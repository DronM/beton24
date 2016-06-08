-- Function: calls_process()

-- DROP FUNCTION calls_process();

CREATE OR REPLACE FUNCTION calls_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_search text;
BEGIN
	IF (TG_OP='INSERT') THEN
		NEW.dt = now()::timestamp;
		
		--********* Client ********************
		IF NEW.call_type='in'::call_types THEN
			v_search = NEW.caller_id_num;
		ELSE
			v_search = NEW.ext;
			IF (char_length(v_search)>3 AND char_length(v_search)<10) THEN
				v_search = const_city_ext_val()::text||v_search;
			END IF;
			
		END IF;

		IF (char_length(v_search)>3) THEN
				
			SELECT
				cd.id,
				COALESCE(ccd.client_id,cct.client_id),
				ctcd.contact_id
			INTO
				NEW.contact_detail_id,
				NEW.client_id,
				NEW.contact_id
			FROM contact_details cd
			LEFT JOIN client_contact_details AS ccd ON ccd.contact_detail_id=cd.id
			LEFT JOIN contact_contact_details AS ctcd ON ctcd.contact_detail_id=cd.id
			LEFT JOIN client_contacts AS cct ON cct.contact_id=ctcd.contact_id
			WHERE cct.value=v_search
			LIMIT 1;	
		END IF;
		--********* Client ********************
		
	ELSIF (TG_OP='UPDATE') THEN
		--****** User ****************
		IF NEW.call_type='in'::call_types THEN
			v_search = NEW.ext;
		ELSE
			v_search = NEW.caller_id_num;
		END IF;

		NEW.user_id = (SELECT id
				FROM users
			WHERE tel_ext=v_search
			LIMIT 1
		);
		
		
		--************ USER TO ***************
		/*
		IF NEW.call_type='out'::call_types
		AND char_length(NEW.ext)<=3 THEN
			--Внутренний номер
			NEW.user_id_to = (SELECT id
					FROM users
				WHERE tel_ext=NEW.ext
			);
			
		END IF;
		*/
	END IF;
	
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION calls_process() OWNER TO beton;
