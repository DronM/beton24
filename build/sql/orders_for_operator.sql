-- Function: orders_for_operator(timestampTZ)

--DROP FUNCTION orders_for_operator(timestampTZ);

CREATE OR REPLACE FUNCTION orders_for_operator(timestampTZ)
  RETURNS TABLE(
	id int,
	order_id int,
	order_number text,
	order_quant numeric,
	vehicle_schedule_id int,
	ship_date_time timestampTZ,
	date_time timestampTZ,
	quant numeric,
	cost numeric,
	shipped bool,
	concrete_type_id int,
	concrete_type_descr text,	
	vh_id int,
	vh_client_id int,
	vh_client_descr text,
	vh_plate text,
	
	driver_id int,
	driver_descr text,
	
	destination_id int,
	destination_descr text,
	
	client_id int,
	client_descr text,
	
	demurrage_cost numeric,
	
	user_id int,
	user_descr text,
	
	demurrage time,
	is_late bool
	) AS
$BODY$
	SELECT 
		sh.id,
		sh.order_id AS order_id,
		o.number::text AS order_number,
		o.quant AS order_quant,
		sh.vehicle_schedule_id,
		sh.ship_date_time,
		sh.date_time,
		sh.quant::numeric,
		shipment_cost_calc(sh.*, dest.*) AS cost,
		sh.shipped,
		
		o.concrete_type_id AS concrete_type_id,
		concr.name::text AS concrete_type_descr,
		
		v.id AS vh_id,
		v.client_id AS vh_client_id,
		vcl.name::text AS vh_client_descr,
		v.plate::text AS vh_plate,
		
		d.id driver_id,
		d.name::text AS driver_descr,
		
		dest.id AS destination_id,
		dest.name::text AS destination_descr,
		
		cl.id AS client_id,
		cl.name::text AS client_descr,
		
		demurrage_cost_calc(sh.demurrage::interval) AS demurrage_cost,
		
		sh.user_id,
		u.name::text AS user_descr,
		
		sh.demurrage,
		
		--расчет is_late
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
		AS is_late

	FROM shipments sh
	LEFT JOIN order_for_operator_queue AS que ON que.shipment_id=sh.id
	
	LEFT JOIN orders o ON o.id = sh.order_id
	LEFT JOIN concrete_types concr ON concr.id = o.concrete_type_id
	LEFT JOIN clients cl ON cl.id = o.client_id
	LEFT JOIN vehicle_schedules vs ON vs.id = sh.vehicle_schedule_id
	LEFT JOIN destinations dest ON dest.id = o.destination_id
	LEFT JOIN drivers d ON d.id = vs.driver_id
	LEFT JOIN vehicles v ON v.id = vs.vehicle_id
	LEFT JOIN clients vcl ON vcl.id = v.client_id
	LEFT JOIN users u ON u.id = sh.user_id
	
	
	WHERE sh.date_time
		BETWEEN get_shift_start($1) AND get_shift_end($1)
		AND NOT sh.id IN (SELECT t.shipment_id FROM shipment_on_load t LIMIT 1)
		AND NOT sh.shipped
	ORDER BY coalesce(que.date_time,sh.date_time)
	;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION orders_for_operator(timestampTZ)
  OWNER TO beton;
