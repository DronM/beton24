-- View: car_tracking_malfunctions

DROP VIEW car_tracking_malfunctions;

CREATE OR REPLACE VIEW car_tracking_malfunctions AS 
	SELECT
		vh.plate,
		vh.tracker_id,
		date8_time8_descr(
			(SELECT tr.recieved_dt
			FROM car_tracking tr
			WHERE tr.car_id=vh.tracker_id
			ORDER BY tr.recieved_dt DESC LIMIT 1
			) + (now()- (now() at time zone 'utc'))
		) AS last_data_dt
	FROM vehicle_schedules AS vs
	LEFT JOIN vehicles AS vh ON vh.id=vs.vehicle_id
	WHERE vs.schedule_date=now()::date
		AND (SELECT vss.state
			FROM vehicle_schedule_states vss
			WHERE vss.schedule_id=vs.id
			ORDER BY vss.date_time
			DESC LIMIT 1
			)='busy'
		AND vh.tracker_id IS NOT NULL AND vh.tracker_id<>''
		AND (SELECT tr.recieved_dt
			FROM car_tracking tr
			WHERE tr.car_id=vh.tracker_id
			ORDER BY tr.recieved_dt
			DESC LIMIT 1
			) < (now() at time zone 'utc') - 
				const_no_tracker_signal_warn_interval_val()::interval
				--'1 second'::interval
		AND vh.tracker_id NOT IN (SELECT tracker_id
						FROM car_tracking_malfucntions
						WHERE dt=now()::date)
	;
ALTER TABLE car_tracking_malfunctions
  OWNER TO beton;
