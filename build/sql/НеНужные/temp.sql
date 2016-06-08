--SELECT ST_GeomFromText(format('POLYGON((%s %s, %s %s, %s %s, %s %s, %s %s))',65.5487853499727, 57.1910286574899,65.5487853499727,57.1906693425101,65.5483366500273,57.1906693425101,65.5483366500273,57.1910286574899,65.5487853499727, 57.1910286574899))
--"{57.1910286574899,65.5487853499727,57.1906693425101,65.5483366500273}"
--SELECT plate from vehicles where id=164

SELECT first_trips.vehicle_id,first_trips.destination_id,first_trips.period AS first_trip_stop_time
,second_trips.period AS second_trip_stop_time
FROM
(
	SELECT vs.vehicle_id,st.date_time AS trip_start, st.destination_id,
	(	SELECT st2.date_time FROM vehicle_schedule_states As st2
		WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
			AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
		ORDER BY st2.date_time LIMIT 1
	) As trip_end,
	stops.lon,stops.lat,stops.period,
	(SELECT
		--ARRAY[lat_upper,lon_upper,lat_lower,lon_lower]
		ST_GeomFromText(format('POLYGON((%s %s, %s %s, %s %s, %s %s, %s %s))',lon_upper,lat_upper,lon_upper,lat_lower,lon_lower,lat_lower,lon_lower,lat_upper,lon_upper,lat_upper))
		FROM add_offset_to_coords(stops.lon, stops.lat, 20) AS (lat_upper double precision,lon_upper double precision,lat_lower double precision,lon_lower double precision)
	) AS coords
		
	FROM vehicle_schedule_states AS st
	LEFT JOIN vehicle_schedules AS vs ON vs.id= st.schedule_id
	LEFT JOIN destinations AS dest ON dest.id=st.destination_id

	INNER JOIN (
		SELECT vehicle_id,lon,lat,period
		FROM vehicle_stops('2013-06-01 07:00','2013-06-30 06:00','00:10',0)
	) AS stops ON stops.vehicle_id=vs.vehicle_id AND stops.period BETWEEN st.date_time AND
			(	SELECT st2.date_time FROM vehicle_schedule_states As st2
				WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
				AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
				ORDER BY st2.date_time LIMIT 1
			)
	
	WHERE st.date_time BETWEEN '2013-06-01 07:00' AND '2013-06-30 06:00'
	AND st.state='busy'::vehicle_states AND st.destination_id<>constant_self_ship_dest_id()
	AND st_contains(dest.zone, ST_GeomFromText(format('POINT(%s %s)',stops.lon,stops.lat), -1))
	ORDER BY vs.vehicle_id,st.date_time,stops.period

) AS first_trips

INNER JOIN
(
	SELECT vs.vehicle_id,st.date_time AS trip_start, st.destination_id,
	(	SELECT st2.date_time FROM vehicle_schedule_states As st2
		WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
			AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
		ORDER BY st2.date_time LIMIT 1
	) As trip_end,
	stops.lon,stops.lat,stops.period
	FROM vehicle_schedule_states AS st
	LEFT JOIN vehicle_schedules AS vs ON vs.id= st.schedule_id

	INNER JOIN (
		SELECT vehicle_id,lon,lat,period
		FROM vehicle_stops('2013-06-01 07:00','2013-07-15 06:00','00:10',0)
	) AS stops ON stops.vehicle_id=vs.vehicle_id AND stops.period BETWEEN st.date_time AND
			(	SELECT st2.date_time FROM vehicle_schedule_states As st2
				WHERE (st2.state IN ('free'::vehicle_states,'out'::vehicle_states,'out_from_shift'::vehicle_states,'left_for_base'::vehicle_states))
				AND st2.date_time>st.date_time AND st2.tracker_id=st.tracker_id
				ORDER BY st2.date_time LIMIT 1
			)
	
	WHERE st.date_time BETWEEN '2013-06-01 07:00' AND '2013-07-15 06:00'
	AND st.state='busy'::vehicle_states AND st.destination_id=constant_self_ship_dest_id()
	ORDER BY vs.vehicle_id,st.date_time,stops.period

) AS second_trips ON second_trips.vehicle_id=first_trips.vehicle_id AND st_contains(first_trips.coords, 
	ST_GeomFromText(format('POINT(%s %s)',second_trips.lon,second_trips.lat), -1))

