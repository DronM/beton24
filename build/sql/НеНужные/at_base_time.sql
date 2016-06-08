-- Function: at_base_time(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION at_base_time(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION at_base_time(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone)
  RETURNS TABLE(plate text, tm interval) AS
$BODY$
DECLARE st_row RECORD;
	v_started boolean = false;
	v_vehicle_id int = 0;
	v_start timestamp;
BEGIN
	FOR st_row IN
		SELECT vehicles.id AS vehicle_id, vehicles.plate::text AS vehicle_descr, vehicle_schedule_states.date_time,vehicle_schedule_states.state
		FROM vehicle_schedule_states
		LEFT JOIN vehicle_schedules ON vehicle_schedules.id = vehicle_schedule_states.schedule_id
		LEFT JOIN vehicles ON vehicles.id = vehicle_schedules.vehicle_id
		WHERE vehicle_schedule_states.date_time BETWEEN in_date_time_from AND in_date_time_to
		AND vehicle_schedule_states.state IN ('busy'::vehicle_states,'free'::vehicle_states)
		ORDER BY vehicles.id,vehicle_schedule_states.date_time
	LOOP
		
		IF v_vehicle_id <> st_row.vehicle_id THEN
			--new vehicle
			IF v_started THEN
				tm = (LEAST(in_date_time_to,CURRENT_TIMESTAMP) - v_start)::interval;
				RETURN NEXT;
			END IF;
			
			v_vehicle_id = st_row.vehicle_id;
			v_started = false;
			plate = st_row.vehicle_descr;
			tm = '00:00'::interval;
		END IF;

		IF (st_row.state='free'::vehicle_states) AND (NOT v_started) THEN
			--first free
			v_start = st_row.date_time;
			v_started = true;
		ELSIF (st_row.state='busy'::vehicle_states) AND (v_started) THEN
			--end of base time
			v_started = false;
			tm = st_row.date_time - v_start;
			RETURN NEXT;
		END IF;
		
	END LOOP;

	IF v_started THEN
		tm = (LEAST(in_date_time_to,CURRENT_TIMESTAMP) - v_start)::interval;
		RETURN NEXT;
	END IF;

END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION at_base_time(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
