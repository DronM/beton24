-- Function: vehicle_stops(integer, timestamp without time zone, timestamp without time zone, interval)

--DROP FUNCTION vehicle_stops(integer, timestamp without time zone, timestamp without time zone, interval);

CREATE OR REPLACE FUNCTION vehicle_stops(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone, IN stop_dur_interval interval,IN in_vehicle_id integer)
  RETURNS TABLE(vehicle_id int, lon double precision, lat double precision, period timestamp without time zone, duration interval) AS
$BODY$
DECLARE tr_stops_row RECORD;
	v_stop_started boolean;
BEGIN
	vehicle_id = 0;
	FOR tr_stops_row IN	
		SELECT 
			vehicles.id AS vehicle_id, 
			tr.period+age(now(),now() at time zone 'UTC') AS period,
			tr.lon,
			tr.lat,
			tr.speed
		FROM car_tracking AS tr
		LEFT JOIN vehicles ON vehicles.tracker_id=tr.car_id
		WHERE tr.period+age(now(),now() at time zone 'UTC') BETWEEN in_date_time_from AND in_date_time_to
		AND ( (in_vehicle_id>0 AND vehicles.id=in_vehicle_id) OR (in_vehicle_id=0))
		AND tr.gps_valid=1
		ORDER BY tr.car_id,tr.period
	
	LOOP
		IF vehicle_id<>tr_stops_row.vehicle_id THEN
			--new vehicle
			v_stop_started = FALSE;
		END IF;
		
		IF NOT v_stop_started AND tr_stops_row.speed=0 THEN	
			--new stop - check duration
			v_stop_started = true;
			vehicle_id	= tr_stops_row.vehicle_id;
			period		= tr_stops_row.period;
			lon		= tr_stops_row.lon;
			lat		= tr_stops_row.lat;
		ELSIF v_stop_started AND tr_stops_row.speed>0 THEN	
			--end of stop
			v_stop_started = false;
			duration = tr_stops_row.period - period;
			IF duration>=stop_dur_interval THEN
				RETURN NEXT;
			END IF;
		END IF;
		
	END LOOP;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION vehicle_stops(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone, IN stop_dur_interval interval,IN in_vehicle_id integer)
  OWNER TO beton;
