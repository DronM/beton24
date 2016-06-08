-- Function: get_run_inf_on_schedule(integer)

--DROP FUNCTION get_run_inf_on_schedule(integer);

CREATE OR REPLACE FUNCTION get_run_inf_on_schedule(in_schedule_id integer)
  RETURNS TABLE(
	st_free_start timestampTZ,
	st_assigned timestampTZ,
	st_shipped timestampTZ,
	st_at_dest timestampTZ,
	st_left_for_base timestampTZ,
	st_free_end timestampTZ,
	destination_descr text,
	run_time text,
	veh_id integer
	) AS
$BODY$
DECLARE st_row RECORD;
	v_run_started boolean;
BEGIN
	v_run_started = false;
	FOR st_row IN
		SELECT
			vss.date_time,
			vss.state,
			coalesce(vss.shipment_id,0) AS shipment_id,
			vs.vehicle_id
		FROM vehicle_schedule_states vss
		LEFT JOIN vehicle_schedules vs ON vs.id=vss.schedule_id
		WHERE vs.id=in_schedule_id
		ORDER BY vss.date_time
	LOOP
		IF st_row.state='assigned'::vehicle_states
		AND v_run_started THEN
			st_assigned = st_row.date_time;
			IF (st_row.shipment_id>0) THEN
				SELECT destinations.name INTO destination_descr
				FROM shipments
				LEFT JOIN orders ON orders.id=shipments.order_id
				LEFT JOIN destinations ON destinations.id=orders.destination_id
				WHERE shipments.id=st_row.shipment_id;
			END IF;
			
		ELSIF st_row.state='at_dest'::vehicle_states
		AND v_run_started THEN
			st_at_dest = st_row.date_time;

		ELSIF st_row.state='left_for_base'::vehicle_states
		AND v_run_started THEN
			st_left_for_base = st_row.date_time;
			
		ELSIF st_row.state='busy'::vehicle_states
		AND v_run_started THEN
			st_shipped = st_row.date_time;
			
		ELSIF (st_row.state='free'::vehicle_states)
		AND (v_run_started=false) THEN
			--new run
			st_free_start = st_row.date_time;
			veh_id = st_row.vehicle_id;
			
			st_assigned = null;
			st_at_dest = null;
			st_left_for_base = null;
			st_shipped = null;
			st_free_end = null;			
			destination_descr = '';
			run_time = '';
			
			v_run_started = true;
			
		ELSIF (st_row.state='free'::vehicle_states)
		AND (v_run_started) THEN
			st_free_end = st_row.date_time;
			run_time = to_char(st_free_end - st_shipped,'HH24:MI');			
			RETURN NEXT;

			--new run
			st_free_start = st_row.date_time;
			st_assigned = null;
			st_at_dest = null;
			st_left_for_base = null;
			st_shipped = null;
			st_free_end = null;			
			destination_descr = '';
			run_time = '';
			
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
ALTER FUNCTION get_run_inf_on_schedule(integer)
  OWNER TO beton;
