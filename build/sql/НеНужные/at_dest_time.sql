-- Function: at_dest_time(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION at_dest_time(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION at_dest_time(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone)
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
		AND vehicle_schedule_states.state IN ('at_dest'::vehicle_states,'left_for_base'::vehicle_states)
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

		IF (st_row.state='at_dest'::vehicle_states) AND (NOT v_started) THEN
			--first free
			v_start = st_row.date_time;
			v_started = true;
		ELSIF (st_row.state='left_for_base'::vehicle_states) AND (v_started) THEN
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

/*
BEGIN
	RETURN QUERY
		SELECT v.plate::text AS plate,
		SUM(
			coalesce(
				(
					SELECT sub_st.date_time
					FROM vehicle_schedule_states AS sub_st
					WHERE
					sub_st.schedule_id=st.schedule_id
					AND sub_st.date_time>st.date_time
					AND sub_st.state = 'left_for_base'::vehicle_states
					ORDER BY sub_st.date_time LIMIT 1
				),LEAST(CURRENT_TIMESTAMP,in_date_time_to)
				) - st.date_time			
		) AS tm
		
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		LEFT JOIN vehicles AS v ON v.id=vs.vehicle_id
		WHERE st.date_time BETWEEN in_date_time_from AND in_date_time_to
		AND st.state='at_dest'::vehicle_states
		AND v.feature IS NOT NULL
		AND (v.feature=constant_own_vehicles_feature() OR v.feature=constant_backup_vehicles_feature())
		
		GROUP BY v.plate
		ORDER BY plate;
*/	
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION at_dest_time(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
