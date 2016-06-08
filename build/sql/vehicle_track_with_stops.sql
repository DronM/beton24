-- Function: vehicle_track_with_stops(integer, timestampTZ, timestampTZ, interval)

--DROP FUNCTION vehicle_track_with_stops(integer, timestampTZ, timestampTZ, interval);

CREATE OR REPLACE FUNCTION vehicle_track_with_stops(
	in_vehicle_id integer,
	in_date_time_from timestampTZ,
	in_date_time_to timestampTZ,
	stop_dur_interval interval
	)
  RETURNS TABLE(
	vehicle_id integer,
	plate text,
	period timestampTZ,
	speed numeric,
	ns character,
	ew character,
	received_dt timestampTZ,
	odometer integer,
	voltage numeric,
	heading numeric,
	lon double precision,
	lat double precision
	) AS
$BODY$
DECLARE tr_stops_row RECORD;
	tr_stops_curs refcursor;
	v_stop_started boolean;
BEGIN
	OPEN tr_stops_curs SCROLL FOR
		SELECT 
			vehicles.id AS vehicle_id,
			vehicles.plate::text AS plate,
			tr.period AS period,
			--tr.longitude::text As lon_str,
			--tr.latitude::text AS lat_str,
			round(tr.speed,0)::numeric AS speed,
			tr.ns,
			tr.ew,
			tr.received_dt AS received_dt,
			tr.odometer,
			tr.voltage,
			tr.heading,
			tr.lon,
			tr.lat
		FROM car_tracking AS tr
		LEFT JOIN vehicles ON vehicles.tracker_id=tr.car_id
		WHERE tr.period BETWEEN in_date_time_from AND in_date_time_to
		AND vehicles.id=in_vehicle_id
		AND tr.gps_valid=1;

	v_stop_started = false;
	LOOP
		FETCH NEXT FROM tr_stops_curs INTO tr_stops_row;
		IF  FOUND=false THEN
			--no more rows
			EXIT;
		END IF;

		IF NOT v_stop_started AND tr_stops_row.speed>0 THEN
			--move point
			vehicle_id	= tr_stops_row.vehicle_id;
			plate		= tr_stops_row.plate;
			period		= tr_stops_row.period;
			--lon_str		= tr_stops_row.lon_str;
			--lat_str		= tr_stops_row.lat_str;
			speed		= tr_stops_row.speed;
			ns		= tr_stops_row.ns;
			ew 		= tr_stops_row.ew;
			received_dt	= tr_stops_row.received_dt;
			odometer	= tr_stops_row.odometer;
			voltage		= tr_stops_row.voltage;
			heading		= tr_stops_row.heading;
			lon		= tr_stops_row.lon;
			lat		= tr_stops_row.lat;
			RETURN NEXT;
		ELSIF NOT v_stop_started AND tr_stops_row.speed=0 THEN	
			--new stop - check duration
			v_stop_started = true;
			vehicle_id	= tr_stops_row.vehicle_id;
			plate		= tr_stops_row.plate;
			period		= tr_stops_row.period;
			--lon_str		= tr_stops_row.lon_str;
			--lat_str		= tr_stops_row.lat_str;
			speed		= tr_stops_row.speed;
			ns			= tr_stops_row.ns;
			ew 			= tr_stops_row.ew;
			received_dt	= tr_stops_row.received_dt;
			odometer	= tr_stops_row.odometer;
			voltage		= tr_stops_row.voltage;
			heading		= tr_stops_row.heading;
			lon		= tr_stops_row.lon;
			lat		= tr_stops_row.lat;
		ELSIF v_stop_started AND tr_stops_row.speed>0 THEN	
			--end of stop
			v_stop_started = false;
			
			IF (tr_stops_row.period - period)::interval>=stop_dur_interval THEN
				RETURN NEXT;
			END IF;
		END IF;
	END LOOP;

	IF v_stop_started THEN	
		--end of stop or end of period
		IF (tr_stops_row.period - period)::interval>=stop_dur_interval THEN
			RETURN NEXT;
		END IF;
	END IF;

	CLOSE tr_stops_curs;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION vehicle_track_with_stops(integer, timestampTZ, timestampTZ, interval)
  OWNER TO beton;
