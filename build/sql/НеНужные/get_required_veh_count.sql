-- Function: get_required_veh_count()

-- DROP FUNCTION get_required_veh_count();

CREATE OR REPLACE FUNCTION get_required_veh_count()
  RETURNS integer AS
$BODY$
DECLARE
	d_from timestamp;
	d_to timestamp;
	quant_ordered float;
	veh_present bigint;
	v_day_shift_start interval;
	v_day_shift_end interval;
BEGIN
	d_from = CURRENT_DATE + '1 day'::interval + constant_first_shift_start_time()::interval;
	d_to = d_from + constant_day_shift_length()::interval - '00:00:01'::interval;

	v_day_shift_start = constant_first_shift_start_time()::interval;
	v_day_shift_end = v_day_shift_start + constant_day_shift_length()::interval;
	
	--SELECT SUM(quant) INTO quant_ordered FROM orders WHERE date_time BETWEEN d_from AND d_to;
	SELECT SUM(
		CASE	
		    WHEN o.date_time_to <= (o.date_time::date + v_day_shift_end) THEN o.quant
		    ELSE round((o.quant / (date_part('epoch'::text, o.date_time_to - o.date_time) / 60::double precision) * (date_part('epoch'::text, o.date_time::date + v_day_shift_end - o.date_time) / 60::double precision))::numeric, 2)::double precision
		END)
	INTO quant_ordered
	FROM orders o
	WHERE o.date_time BETWEEN d_from AND d_to;
	

	SELECT COUNT(*) INTO veh_present FROM vehicle_schedules AS vs
	LEFT JOIN vehicle_schedule_states st ON
		st.id = (SELECT vehicle_schedule_states.id 
			FROM vehicle_schedule_states
			WHERE vehicle_schedule_states.schedule_id = vs.id
			ORDER BY vehicle_schedule_states.date_time DESC LIMIT 1
		)
	WHERE vs.schedule_date=d_from::date AND (st.state='shift'::vehicle_states OR st.state='shift_added'::vehicle_states OR st.state='free'::vehicle_states);

	RETURN ceil(quant_ordered/25) - veh_present;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION get_required_veh_count()
  OWNER TO beton;
