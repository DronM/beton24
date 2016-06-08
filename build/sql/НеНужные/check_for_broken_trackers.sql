-- Function: check_for_broken_trackers()

-- DROP FUNCTION check_for_broken_trackers();

CREATE OR REPLACE FUNCTION check_for_broken_trackers(OUT sms_text text, OUT cel_phone text)
  RETURNS record AS
$BODY$
DECLARE
	br_row RECORD;
	SMS_PATTERN text = 'Не рабочие терм.:';
	v_tr_str text = '';
	exist_broken_trackers boolean;
BEGIN
	exist_broken_trackers = false;
	FOR br_row IN
		SELECT * FROM broken_trackers_list_view
	LOOP
		IF NOT exist_broken_trackers THEN
			exist_broken_trackers = true;
		ELSE
			v_tr_str = v_tr_str || ',';
		END IF;

		v_tr_str = v_tr_str || br_row.plate;
	END LOOP;

	IF exist_broken_trackers THEN
		sms_text = SMS_PATTERN || v_tr_str;
		cel_phone = constant_tracker_service_cel_phone();
	END IF;
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION check_for_broken_trackers()
  OWNER TO beton;
