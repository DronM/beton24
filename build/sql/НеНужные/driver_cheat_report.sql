-- Function: calc_demurrage_coast(interval)


--DROP FUNCTION driver_cheat_report(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone, in_cheat_end_date_time timestamp without time zone,
--	IN in_stop_dur_minute interval, IN in_stop_spot_offset Int, IN in_vehicle_id int);


CREATE OR REPLACE FUNCTION driver_cheat_report(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone, in_cheat_end_date_time timestamp without time zone,
	IN in_stop_dur_minute interval, IN in_stop_spot_offset Int, IN in_vehicle_id int)
  RETURNS TABLE(
		vehicle_id int,
		vehicle_plate text,
		driver_id int,
		driver_name text,
		destination_id int,
		destination_name text,
		first_trip_stop_time timestamp without time zone,
		second_trip_stop_time timestamp without time zone
	) AS
$BODY$
BEGIN
	RETURN QUERY
	SELECT
		first_trips.vehicle_id,
		v.plate::text AS vehicle_plate,
		dr.id AS driver_id,
		dr.name::text AS driver_name,
		first_trips.destination_id,
		cheat_dest.name::text AS destination_name,
		first_trips.period AS first_trip_stop_time,
		second_trips.period AS second_trip_stop_time
	FROM
	(
		SELECT vs.vehicle_id,
			vs.driver_id,
			st.date_time AS trip_start,
			st.destination_id,
			stops.period,
		/*
		(	SELECT st2.date_time FROM vehicle_schedule_states As st2
			WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
				AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
			ORDER BY st2.date_time LIMIT 1
		) As trip_end,
		*/
		--stops.lon,stops.lat,stops.period,
		(SELECT
			--ARRAY[lat_upper,lon_upper,lat_lower,lon_lower]
			ST_GeomFromText(format('POLYGON((%s %s, %s %s, %s %s, %s %s, %s %s))',lon_upper,lat_upper,lon_upper,lat_lower,lon_lower,lat_lower,lon_lower,lat_upper,lon_upper,lat_upper))
			FROM add_offset_to_coords(stops.lon, stops.lat, in_stop_spot_offset) AS (lat_upper double precision,lon_upper double precision,lat_lower double precision,lon_lower double precision)
		) AS coords
			
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id= st.schedule_id
		LEFT JOIN destinations AS dest ON dest.id=st.destination_id

		INNER JOIN (
			SELECT tmp_stops.vehicle_id,tmp_stops.lon,tmp_stops.lat,tmp_stops.period
			FROM vehicle_stops(in_date_time_from,in_date_time_to,in_stop_dur_minute,in_vehicle_id) AS tmp_stops
		) AS stops ON stops.vehicle_id=vs.vehicle_id AND stops.period BETWEEN st.date_time AND
				(	SELECT st2.date_time FROM vehicle_schedule_states As st2
					WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
					AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
					ORDER BY st2.date_time LIMIT 1
				)
		
		WHERE st.date_time BETWEEN in_date_time_from AND in_date_time_to
		AND (in_vehicle_id=0 OR (in_vehicle_id>0 AND vs.vehicle_id=in_vehicle_id))
		AND st.state='busy'::vehicle_states AND st.destination_id<>constant_self_ship_dest_id()
		AND st_contains(dest.zone, ST_GeomFromText(format('POINT(%s %s)',stops.lon,stops.lat), -1))
		ORDER BY vs.vehicle_id,st.date_time,stops.period

	) AS first_trips

	INNER JOIN
	(
		SELECT vs.vehicle_id,
			st.date_time AS trip_start,
			st.destination_id,
			stops.period,
			stops.lon,
			stops.lat
		/*
		(	SELECT st2.date_time FROM vehicle_schedule_states As st2
			WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
				AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
			ORDER BY st2.date_time LIMIT 1
		) As trip_end,
		*/		
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id= st.schedule_id

		INNER JOIN (
			SELECT tmp_stops.vehicle_id,tmp_stops.lon,tmp_stops.lat,tmp_stops.period
			FROM vehicle_stops(in_date_time_from,in_cheat_end_date_time,in_stop_dur_minute,in_vehicle_id) AS tmp_stops
		) AS stops ON stops.vehicle_id=vs.vehicle_id AND stops.period BETWEEN st.date_time AND
				(	SELECT st2.date_time FROM vehicle_schedule_states As st2
					WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
					AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
					ORDER BY st2.date_time LIMIT 1
				)
		
		WHERE st.date_time BETWEEN in_date_time_from AND in_cheat_end_date_time
		AND (in_vehicle_id=0 OR (in_vehicle_id>0 AND vs.vehicle_id=in_vehicle_id))
		AND st.state='busy'::vehicle_states AND st.destination_id=constant_self_ship_dest_id()
		ORDER BY vs.vehicle_id,st.date_time,stops.period

	) AS second_trips ON second_trips.vehicle_id=first_trips.vehicle_id AND st_contains(first_trips.coords, 
		ST_GeomFromText(format('POINT(%s %s)',second_trips.lon,second_trips.lat), -1))
		
	LEFT JOIN destinations AS cheat_dest ON cheat_dest.id=first_trips.destination_id
	LEFT JOIN vehicles AS v ON v.id=first_trips.vehicle_id
	LEFT JOIN drivers AS dr ON dr.id=first_trips.driver_id
	;

	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION driver_cheat_report(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone, in_cheat_end_date_time timestamp without time zone,
	IN in_stop_dur_minute interval, IN in_stop_spot_offset Int, IN in_vehicle_id int)
  OWNER TO beton;
