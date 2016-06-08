-- View: lab_cur_vehicle_list

DROP VIEW lab_cur_vehicle_list;

CREATE OR REPLACE VIEW lab_cur_vehicle_list AS 
	SELECT 
		sub.vehicle_descr,
		sub.driver_descr,
		sub.quant,
		sub.state,
		sub.state_descr
	FROM (
		SELECT DISTINCT ON (st.schedule_id)
			v.plate AS vehicle_descr,
			get_short_str(dr.name::text,7) AS driver_descr,
			sh.quant,
			st.date_time,
			st.state,
			get_vehicle_states_descr(st.state) AS state_descr
			
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules vs ON vs.id=st.schedule_id
		LEFT JOIN vehicles v ON v.id=vs.vehicle_id
		LEFT JOIN drivers dr ON dr.id=vs.driver_id
		LEFT JOIN shipments sh ON sh.id=st.shipment_id
		WHERE vs.schedule_date=now()::date
			AND st.state NOT IN ('out','out_from_shift')
		ORDER BY st.schedule_id,st.date_time DESC
	) AS sub
	ORDER BY sub.date_time
	;
ALTER TABLE lab_cur_vehicle_list OWNER TO beton;