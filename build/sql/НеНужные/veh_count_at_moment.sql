-- Function: veh_count_at_moment(timestamp without time zone)

-- DROP FUNCTION veh_count_at_moment(timestamp without time zone);

CREATE OR REPLACE FUNCTION veh_count_at_moment(IN in_date_time timestamp without time zone, OUT busy_cnt bigint, OUT free_cnt bigint)
  RETURNS record AS
$BODY$
BEGIN
--TABLE(busy_cnt bigint, free_cnt bigint)
	--RETURN QUERY
		SELECT 
			SUM(
			CASE 
				WHEN st.state='busy'::vehicle_states OR st.state='at_dest'::vehicle_states OR st.state='left_for_base'::vehicle_states THEN 1
				ELSE 0
			END),

			SUM(
			CASE 
				WHEN st.state='free'::vehicle_states OR st.state='assigned'::vehicle_states THEN 1
				ELSE 0
			END)
	

		INTO busy_cnt,free_cnt
				
		FROM vehicle_schedules vs

		LEFT JOIN vehicles AS v ON v.id=vs.vehicle_id

		LEFT JOIN vehicle_schedule_states st ON
			st.id = (SELECT vehicle_schedule_states.id 
				FROM vehicle_schedule_states
				WHERE vehicle_schedule_states.schedule_id = vs.id
				AND vehicle_schedule_states.date_time<in_date_time
				ORDER BY vehicle_schedule_states.date_time DESC LIMIT 1
			)
		WHERE vs.schedule_date=in_date_time::date
		AND is_vehicle_main(v.feature);

	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION veh_count_at_moment(timestamp without time zone)
  OWNER TO beton;
