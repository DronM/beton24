-- Function: get_working_vehicles_count(date)

-- DROP FUNCTION get_working_vehicles_count(date);

CREATE OR REPLACE FUNCTION get_working_vehicles_count(start_shift_date date)
  RETURNS bigint AS
$BODY$
	SELECT COUNT(*)
	FROM vehicle_schedules AS vs
	LEFT JOIN vehicle_schedule_states st ON
		st.id = (SELECT vehicle_schedule_states.id 
			FROM vehicle_schedule_states
			WHERE vehicle_schedule_states.schedule_id = vs.id
			ORDER BY vehicle_schedule_states.date_time DESC LIMIT 1
		)
	
	WHERE vs.schedule_date=$1
	AND st.state IN ('free'::vehicle_states,'assigned'::vehicle_states,'busy'::vehicle_states,'at_dest'::vehicle_states,'left_for_base'::vehicle_states);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_working_vehicles_count(date)
  OWNER TO beton;
