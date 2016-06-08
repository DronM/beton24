-- Function: vehicle_current_heading(integer)

-- DROP FUNCTION vehicle_current_heading(integer);

CREATE OR REPLACE FUNCTION vehicle_current_heading(in_vehicle_id integer)
  RETURNS record AS
$BODY$
DECLARE
	v_return record;
BEGIN
	WITH last_track_data AS (
		SELECT tr.lat,tr.lon,tr.period+AGE(now(),now() at time zone 'UTC') AS period
		FROM car_tracking AS tr
		LEFT JOIN vehicles AS v ON v.tracker_id=tr.car_id
		WHERE v.id=in_vehicle_id
		ORDER BY PERIOD DESC LIMIT 1
	)
	SELECT 
		(SELECT ARRAY[lat,lon] FROM last_track_data) AS current_coord,
		(SELECT period FROM last_track_data) AS current_coord_date_time,
		coord,
		CASE
			WHEN 	(SELECT lat FROM last_track_data)>coord[1][1]
				AND (SELECT lat FROM last_track_data)<coord[1][2]
				AND (SELECT lon FROM last_track_data)>coord[2][1]
				AND (SELECT lon FROM last_track_data)<coord[2][2]
				THEN 
					CASE where_to
						WHEN 0 THEN 'at_base'
						ELSE 'at_dest'
					END
			ELSE 
					CASE where_to
						WHEN 0 THEN 'to_base'
						ELSE 'to_dest'
					END			
			
		END

		INTO v_return
	FROM 
		(SELECT 	
			(SELECT ARRAY[ARRAY[dest.lat_min,dest.lat_max],ARRAY[dest.lon_min,dest.lon_max]] FROM destinations AS dest WHERE dest.id=
				CASE 
					WHEN st.state='out'::vehicle_states OR 
						st.state='free'::vehicle_states OR
						st.state='out_from_shift'::vehicle_states OR
						st.state='at_dest'::vehicle_states OR
						st.state='left_for_base'::vehicle_states				
							THEN (SELECT base_id FROM constant_base_geo_zone_id() AS base_id)
						
					ELSE st.destination_id
				END
			) AS coord,
			
			CASE 
				WHEN st.state='out'::vehicle_states OR 
					st.state='free'::vehicle_states OR
					st.state='out_from_shift'::vehicle_states OR
					st.state='at_dest'::vehicle_states OR
					st.state='left_for_base'::vehicle_states				
						THEN 0
					
				ELSE 1
			END AS where_to
			
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		WHERE vs.vehicle_id=in_vehicle_id
		ORDER BY st.date_time DESC LIMIT 1
	) AS dest;

	RETURN v_return;
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION vehicle_current_heading(integer)
  OWNER TO postgres;
