-- View: shipment_for_order_list_view

--DROP VIEW shipment_for_order_list_view;

CREATE OR REPLACE VIEW shipment_for_order_list_view AS 
	SELECT sh.id,
		d.name::text AS driver_name,
		v.plate::text AS veh_plate,
		v.id::text AS veh_id,
		vs.id AS vehicle_schedule_id,
		sh.quant,
		sh.shipped,
		o.id AS order_id,
	(SELECT d1 FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)) AS state_assigned,
	sh.ship_date_time AS state_shipped,
	(SELECT d2 FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)) As state_left_for_dest,
	(SELECT d3 FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)) AS state_at_dest,
	(SELECT d4 FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)) AS state_left_for_base,
	(SELECT d5 FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states, st_date_time timestampTZ)) AS state_free,
	(SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ)) AS state,
	
	(	
		--отгружен и не успел доехать
		(
		(SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))='busy' AND
		( (SELECT st_date_time FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))+
			coalesce(dest.time_route::interval,'00:00'::interval)
		) < now()
		)
		OR
		--едет обратно и не успел доехать
		(
		(SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))='left_for_base' AND
		( (SELECT st_date_time FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))+
			coalesce(dest.time_route::interval,'00:00'::interval)
		) < now()
		)
		OR
		--у клиента и не успел рагрузиться
		(
		(SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))='left_for_base' AND
		( (SELECT st_date_time FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))+
			coalesce(dest.time_route::interval,'00:00'::interval)+
			const_vehicle_unload_time_val()
		) < now()
		)
		--назначен и не отгружен - косяк оператора
		
		--
	) AS is_late,

	CASE
		WHEN (SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))='busy' THEN
			(SELECT st_date_time FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))+
				coalesce(dest.time_route::interval,'00:00'::interval)
		WHEN (SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))='left_for_base' THEN
			(SELECT st_date_time FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))::timestampTZ+
			coalesce(dest.time_route::interval,'00:00'::interval)
		WHEN (SELECT st FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))='left_for_base' THEN
			(SELECT st_date_time FROM get_run_inf_on_shipment(vs.id,sh.id) AS (d1 timestampTZ,d2 timestampTZ,d3 timestampTZ,d4 timestampTZ,d5 timestampTZ, st vehicle_states,st_date_time timestampTZ))+
			coalesce(dest.time_route::interval,'00:00'::interval)+
			const_vehicle_unload_time_val()
				
		ELSE NULL::timestampTZ
	END AS next_state_date_time
	
	FROM shipments sh
		LEFT JOIN orders o ON o.id = sh.order_id
		LEFT JOIN destinations dest ON dest.id = o.destination_id
		LEFT JOIN clients cl ON cl.id = o.client_id
		LEFT JOIN vehicle_schedules vs ON vs.id = sh.vehicle_schedule_id
		LEFT JOIN drivers d ON d.id = vs.driver_id
		LEFT JOIN vehicles v ON v.id = vs.vehicle_id
	ORDER BY sh.date_time;

ALTER TABLE shipment_for_order_list_view
  OWNER TO beton;
