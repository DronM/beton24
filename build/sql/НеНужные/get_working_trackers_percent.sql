-- Function: get_working_trackers_percent(integer)

-- DROP FUNCTION get_working_trackers_percent(integer);

CREATE OR REPLACE FUNCTION get_working_trackers_percent(in_min integer)
  RETURNS numeric AS
$BODY$
DECLARE
	v_allowed_interval interval;
	res numeric;
BEGIN
	v_allowed_interval = (in_min || ' minutes')::interval;
	
	WITH last_veh_states AS (
		SELECT v.tracker_id
		FROM vehicle_schedules vs
		LEFT JOIN vehicle_schedule_states st ON
			st.id = (SELECT vehicle_schedule_states.id 
				FROM vehicle_schedule_states
				WHERE vehicle_schedule_states.schedule_id = vs.id
				ORDER BY vehicle_schedule_states.date_time DESC LIMIT 1
			)
		LEFT JOIN vehicles v ON v.id = vs.vehicle_id
		WHERE vs.schedule_date=get_shift_start(CURRENT_TIMESTAMP::timestamp without time zone)::date
		AND (st.state='free'::vehicle_states OR st.state='busy'::vehicle_states OR st.state='at_dest'::vehicle_states OR st.state='left_for_base'::vehicle_states OR st.state='assigned'::vehicle_states)
		AND v.tracker_id IS NOT NULL AND v.tracker_id<>''

	),
	last_veh_states_cnt AS (SELECT COUNT(*)::numeric AS cnt FROM last_veh_states)
		SELECT
			CASE
				WHEN (SELECT cnt FROM last_veh_states_cnt)>0 AND COUNT(*)>=0 THEN
					100-round(COUNT(*)::numeric/(SELECT cnt FROM last_veh_states_cnt)* 100,2)
				ELSE 100
			END
			INTO res
						  
		FROM last_veh_states
		WHERE (
			SELECT now()-(tr.period+age(now(),now() at time zone 'UTC'))
			FROM car_tracking AS tr WHERE tr.car_id=last_veh_states.tracker_id ORDER BY period DESC LIMIT 1
			)>v_allowed_interval;

	RETURN res;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION get_working_trackers_percent(integer)
  OWNER TO beton;
