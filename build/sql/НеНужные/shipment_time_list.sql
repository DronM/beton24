-- View: shipment_time_list

--DROP VIEW shipment_time_list;

CREATE OR REPLACE VIEW shipment_time_list AS 
	SELECT
		sh.id AS id,
		o.client_id AS client_id,
		cl.name AS client_descr,
		o.destination_id AS destination_id,
		dest.name AS destination_descr,
		sh.quant AS quant,
		
		vh.vh_plate AS vehicle_plate,
		vh.dr_id AS driver_id,
		vh.dr_name AS driver_descr,
		
		vh.assign_date_time AS assign_date_time,

		time5_descr(vh.assign_date_time) AS assign_date_time_descr,
		
		sh.ship_date_time AS ship_date_time,
		time5_descr(sh.ship_date_time) AS ship_date_time_descr,
		
		--dispatcher_fail_min
		CASE 
			WHEN
			ROUND((EXTRACT(EPOCH FROM (				
				COALESCE(
				vh.assign_date_time-
				(SELECT t2.date_time
				FROM shipments AS t1
				LEFT JOIN vehicle_schedule_states AS t2
					ON t2.shipment_id=t1.id
						AND t2.state='busy'
				WHERE t1.date_time<sh.date_time
					AND get_shift_start(t1.date_time)=get_shift_start(sh.date_time)
				ORDER BY t1.date_time DESC
				LIMIT 1
				)
				,'0 seconds'::INTERVAL)
			) )/60)::numeric,0)
			> 0 THEN
			ROUND((EXTRACT(EPOCH FROM (
				COALESCE(
				vh.assign_date_time-
				(SELECT t2.date_time
				FROM shipments AS t1
				LEFT JOIN vehicle_schedule_states AS t2
					ON t2.shipment_id=t1.id
						AND t2.state='busy'
				WHERE t1.date_time<sh.date_time
					AND get_shift_start(t1.date_time)=get_shift_start(sh.date_time)
				ORDER BY t1.date_time DESC
				LIMIT 1
				)
				,'0 seconds'::INTERVAL)
			) )/60)::numeric,0)
			ELSE 0
		END dispatcher_fail_min,
		
		shipment_time_norm(sh.quant::numeric) AS ship_time_norm,
		
		--operator_fail_min
		ROUND((EXTRACT(EPOCH FROM sh.ship_date_time - vh.assign_date_time)/60)::numeric,0)
		-
		shipment_time_norm(sh.quant::numeric)
		AS operator_fail_min,
		
		--total_fail_min
		CASE 
			WHEN
			ROUND((EXTRACT(EPOCH FROM (
				COALESCE(
				vh.assign_date_time-
				(SELECT t2.date_time
				FROM shipments AS t1
				LEFT JOIN vehicle_schedule_states AS t2
					ON t2.shipment_id=t1.id
						AND t2.state='busy'
				WHERE t1.date_time<sh.date_time
					AND get_shift_start(t1.date_time)=get_shift_start(sh.date_time)
				ORDER BY t1.date_time DESC
				LIMIT 1)
				,'0 seconds'::INTERVAL)
			) )/60)::numeric,0)
			> 0 THEN
			ROUND((EXTRACT(EPOCH FROM (
				COALESCE(
				vh.assign_date_time-
				(SELECT t2.date_time
				FROM shipments AS t1
				LEFT JOIN vehicle_schedule_states AS t2
					ON t2.shipment_id=t1.id
						AND t2.state='busy'
				WHERE t1.date_time<sh.date_time
					AND get_shift_start(t1.date_time)=get_shift_start(sh.date_time)
				ORDER BY t1.date_time DESC
				LIMIT 1)
				,'0 seconds'::INTERVAL)
			) )/60)::numeric,0)
			ELSE 0
		END + 	
		(
		ROUND((EXTRACT(EPOCH FROM sh.ship_date_time - vh.assign_date_time)/60)::numeric,0)
		-
		shipment_time_norm(sh.quant::numeric)
		)
		AS total_fail_min
	
	FROM shipments sh
	LEFT JOIN orders o ON o.id=sh.order_id
	LEFT JOIN clients cl ON cl.id=o.client_id	
	LEFT JOIN destinations dest ON dest.id=o.destination_id
	LEFT JOIN (
		SELECT
			t.shipment_id,
			MAX(t.date_time) AS assign_date_time,
			vh.plate AS vh_plate,
			vs.driver_id AS dr_id,
			dr.name AS dr_name
		FROM vehicle_schedule_states t
		LEFT JOIN vehicle_schedules AS vs ON vs.id=t.schedule_id
		LEFT JOIN vehicles AS vh ON vh.id=vs.vehicle_id
		LEFT JOIN drivers AS dr ON dr.id=vs.driver_id
		WHERE t.state='assigned'
		GROUP BY
			t.shipment_id,
			vh.plate,
			vs.driver_id,
			dr.name		
		) AS vh ON vh.shipment_id=sh.id	

	ORDER BY sh.ship_date_time DESC
	;
	
ALTER TABLE shipment_time_list
  OWNER TO beton;
