-- Function: get_stat_on_schedule(date)

-- DROP FUNCTION get_stat_on_schedule(date);

CREATE OR REPLACE FUNCTION get_stat_on_schedule(IN in_date date, OUT run_cnt bigint, OUT at_dest_sec bigint, OUT at_run_sec bigint)
  RETURNS record AS
$BODY$
DECLARE st_row RECORD;
	v_run_started boolean;
	st_at_dest timestamp;
	st_shipped timestamp;
	st_schedule_id int;
	v_self_ship_dest_id int;
BEGIN
	v_run_started = false;
	run_cnt = 0;
	at_dest_sec = 0;
	at_run_sec = 0;
	st_schedule_id = 0;
	v_self_ship_dest_id = constant_self_ship_dest_id();
	
	FOR st_row IN
		SELECT vehicle_schedule_states.date_time,vehicle_schedule_states.state,coalesce(vehicle_schedule_states.shipment_id,0) AS shipment_id,
		vehicle_schedule_states.schedule_id AS schedule_id, vehicle_schedule_states.destination_id AS destination_id 
		FROM vehicle_schedule_states
		LEFT JOIN vehicle_schedules ON vehicle_schedules.id = vehicle_schedule_states.schedule_id
		WHERE vehicle_schedules.schedule_date=in_date
		ORDER BY vehicle_schedule_states.schedule_id, vehicle_schedule_states.date_time
	LOOP
		IF st_row.schedule_id<>st_schedule_id THEN
			--new vehicle
			st_at_dest = null;
			st_shipped = null;
			
			v_run_started = false;

			st_schedule_id = st_row.schedule_id;
		END IF;
			
		IF st_row.state='at_dest'::vehicle_states
		AND v_run_started
		AND (st_row.destination_id IS NOT NULL) 
		AND (st_row.destination_id<>v_self_ship_dest_id) THEN
			st_at_dest = st_row.date_time;
			
		ELSIF st_row.state='busy'::vehicle_states
		AND v_run_started THEN
			st_shipped = st_row.date_time;
			
		ELSIF (st_row.state='free'::vehicle_states)
		AND (v_run_started=false) THEN
			--new run			
			st_at_dest = null;
			st_shipped = null;
			
			v_run_started = true;
			
		ELSIF (st_row.state='free'::vehicle_states)
		AND (v_run_started) THEN
			IF st_at_dest IS NOT NULL THEN
				--RAISE EXCEPTION '%',EXTRACT(EPOCH FROM (date_trunc('second',st_row.date_time) - date_trunc('second',st_shipped)));
				at_run_sec = at_run_sec + EXTRACT(EPOCH FROM (date_trunc('second',st_row.date_time) - date_trunc('second',st_shipped)));
				at_dest_sec = at_dest_sec + EXTRACT(EPOCH FROM (date_trunc('second',st_row.date_time) - date_trunc('second',st_at_dest)));

				run_cnt = run_cnt + 1;
			END IF;
			
			--new run
			st_at_dest = null;
			st_shipped = null;
			
			v_run_started = true;			
		END IF;
	END LOOP;

END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION get_stat_on_schedule(date)
  OWNER TO beton;
