-- View: vehicle_current_pos_all

--DROP VIEW vehicle_current_pos_all;

CREATE OR REPLACE VIEW vehicle_current_pos_all AS 
	SELECT
		v.id AS vehicle_id,
		v.plate::text AS vehicle_plate,
		vcl.name::text AS vehicle_owner,
		vm.name::text AS vehicle_make,
		( SELECT car_tracking.period
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS period,
		( SELECT car_tracking.longitude
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS lon_str,
		( SELECT car_tracking.latitude
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS lat_str,
		( SELECT round(car_tracking.speed, 0) AS round
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS speed,
		( SELECT car_tracking.ns
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS ns,
		( SELECT car_tracking.ew
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS ew,
		( SELECT car_tracking.received_dt
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS received_dt,
		( SELECT car_tracking.odometer
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS odometer,
		( SELECT car_tracking.engine_on
			FROM car_tracking
			WHERE car_tracking.car_id::text = v.tracker_id::text
			ORDER BY car_tracking.period DESC
			LIMIT 1
		) AS engine_on,
		( SELECT car_tracking.voltage
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS voltage,
		( SELECT car_tracking.heading
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS heading,
		( SELECT car_tracking.lon
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS lon,
		( SELECT car_tracking.lat
			   FROM car_tracking
			  WHERE car_tracking.car_id::text = v.tracker_id::text
			  ORDER BY car_tracking.period DESC
			 LIMIT 1
		) AS lat
	FROM vehicles v
	LEFT JOIN clients vcl ON vcl.id=v.client_id
	LEFT JOIN vehicle_makes vm ON vm.id=v.vehicle_make_id
	WHERE v.tracker_id IS NOT NULL AND v.tracker_id::text <> ''::text
	ORDER BY v.plate;
ALTER TABLE vehicle_current_pos_all
  OWNER TO beton;
