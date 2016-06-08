-- Function: get_run_inf_on_vehicle(integer, timestampTZ)

-- DROP FUNCTION get_run_inf_on_vehicle(integer, timestampTZ);

CREATE OR REPLACE FUNCTION get_run_inf_on_vehicle(IN in_vehicle_id integer, IN in_date_time timestampTZ)
  RETURNS TABLE(
	st_free_start timestampTZ,
	st_assigned timestampTZ,
	st_shipped timestampTZ,
	st_at_dest timestampTZ,
	st_free_end timestampTZ
	) AS
$BODY$
DECLARE shift_start timestamp;
	shift_end timestamp;
	st_row RECORD;
	v_run_started boolean;
BEGIN
	SELECT d1,d2 INTO shift_start,shift_end FROM get_shift_bounds(in_date_time) AS (d1 timestampTZ, d2 timestampTZ);

	v_run_started = false;
	FOR st_row IN
		SELECT vehicle_schedule_states.date_time,vehicle_schedule_states.state
		FROM vehicle_schedule_states
		LEFT JOIN vehicle_schedules ON vehicle_schedules.id = vehicle_schedule_states.schedule_id
		WHERE (vehicle_schedule_states.date_time
			BETWEEN shift_start AND shift_end
			)
			AND (vehicle_schedules.vehicle_id=in_vehicle_id)
	LOOP
		IF st_row.state='assigned'::vehicle_states
		AND v_run_started THEN
			st_assigned = st_row.date_time;
			
		ELSIF st_row.state='at_dest'::vehicle_states
		AND v_run_started THEN
			st_at_dest = st_row.date_time;
			
		ELSIF st_row.state='busy'::vehicle_states
		AND v_run_started THEN
			st_shipped = st_row.date_time;
			
		ELSIF (st_row.state='free'::vehicle_states)
		AND (v_run_started=false) THEN
			--new run
			st_free_start = st_row.date_time;
			
			st_assigned = null;
			st_at_dest = null;
			st_shipped = null;
			st_free_end = null;			
			
			v_run_started = true;
			
		ELSIF (st_row.state='free'::vehicle_states)
		AND (v_run_started) THEN
			st_free_end = st_row.date_time;
			RETURN NEXT;

			--new run
			st_free_start = st_row.date_time;
			st_assigned = null;
			st_at_dest = null;
			st_shipped = null;
			st_free_end = null;			
			v_run_started = true;			
		END IF;
	END LOOP;

	IF v_run_started THEN
		RETURN NEXT;
	END IF;
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION get_run_inf_on_vehicle(integer, timestampTZ)
  OWNER TO beton;
