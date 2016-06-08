-- View: shipment_for_order_list_view

--DROP VIEW shipment_for_order_list_view;

CREATE OR REPLACE VIEW shipment_for_order_list_view AS 
	SELECT
		sh.*,
		(SELECT get_run_inf_on_shipment.d1
		FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) AS state_assigned,
		
		(SELECT get_run_inf_on_shipment.d2
		FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) AS state_left_for_dest,
		
		(SELECT get_run_inf_on_shipment.d3
		FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) AS state_at_dest,
		
		(SELECT get_run_inf_on_shipment.d4
		FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) AS state_left_for_base,
		
		(SELECT get_run_inf_on_shipment.d5
		FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) AS state_free,
		
		
		(SELECT get_run_inf_on_shipment.st
		   FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) AS state,
		
		--расчет is_late
		/*
		(
			(SELECT get_run_inf_on_shipment.st
			FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
			)
		) = 'busy'::vehicle_states
		AND
		((SELECT get_run_inf_on_shipment.st_date_time
		   FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		  ) + COALESCE(dest.time_route::interval, '00:00:00'::interval)
		) < now()
		OR
		(SELECT get_run_inf_on_shipment.st
		 FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) = 'left_for_base'::vehicle_states
		AND
		((SELECT get_run_inf_on_shipment.st_date_time
		   FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		 ) + COALESCE(dest.time_route::interval, '00:00:00'::interval)
		) < now()
		OR
		(SELECT get_run_inf_on_shipment.st
		   FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		) = 'left_for_base'::vehicle_states
		AND
		(( SELECT get_run_inf_on_shipment.st_date_time
		   FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)
		 ) + COALESCE(dest.time_route::interval, '00:00:00'::interval) + const_vehicle_unload_time_val()::interval
		) < now()
		AS is_late,
		*/
		
		CASE
		    WHEN (( SELECT get_run_inf_on_shipment.st
		       FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ))) = 'busy'::vehicle_states THEN (( SELECT get_run_inf_on_shipment.st_date_time
		       FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ))) + COALESCE(dest.time_route::interval, '00:00:00'::interval)
		    WHEN (( SELECT get_run_inf_on_shipment.st
		       FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ))) = 'left_for_base'::vehicle_states THEN (( SELECT get_run_inf_on_shipment.st_date_time
		       FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ))) + COALESCE(dest.time_route::interval, '00:00:00'::interval)
		    WHEN (( SELECT get_run_inf_on_shipment.st
		       FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ))) = 'left_for_base'::vehicle_states THEN (( SELECT get_run_inf_on_shipment.st_date_time
		       FROM get_run_inf_on_shipment(vs.id, sh.id) get_run_inf_on_shipment(d1 timestampTZ, d2 timestampTZ, d3 timestampTZ, d4 timestampTZ, d5 timestampTZ, st vehicle_states, st_date_time timestampTZ))) + COALESCE(dest.time_route::interval, '00:00:00'::interval) + const_vehicle_unload_time_val()::interval
		    ELSE NULL::timestampTZ
		END AS next_state_date_time
	FROM shipment_base sh
	LEFT JOIN orders o ON o.id = sh.order_id
	LEFT JOIN destinations dest ON dest.id = o.destination_id
	LEFT JOIN clients cl ON cl.id = o.client_id
	LEFT JOIN vehicle_schedules vs ON vs.id = sh.vehicle_schedule_id
	LEFT JOIN drivers d ON d.id = vs.driver_id
	LEFT JOIN vehicles v ON v.id = vs.vehicle_id
	ORDER BY sh.date_time;

ALTER TABLE shipment_for_order_list_view
  OWNER TO beton;

