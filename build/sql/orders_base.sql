-- View: orders_base

DROP VIEW orders_base CASCADE;

CREATE OR REPLACE VIEW orders_base AS 
	SELECT
		o.id,
		order_num(o) AS number,
		
		o.client_id,		
		cl.name AS client_descr,
		
		o.destination_id,
		d.name AS destination_descr,
		
		o.concrete_type_id,
		concr.name AS concrete_type_descr,
		
		o.pump_vehicle_id,
		pvh.vehicle_id AS vh_id,
		
		o.address,
		
		o.user_id,
		u.name AS user_descr,
		
		o.unload_type,		
		
		vhcl.id AS vh_client_id,
		vhcl.name::text AS vh_client_descr,
		vh.plate::text AS vh_plate,
 
		o.comment_text AS comment_text,
						
		o.unload_speed,
		
		o.date_time,
		o.date_time_to,
		
		o.quant,
		o.quant_init,
		
		COALESCE(
			(SELECT sum(shipments.quant) AS sum		
			FROM shipments
			WHERE shipments.order_id = o.id
			AND shipments.shipped = true),
			0::numeric
		) AS quant_done, 
		
		CASE
		    WHEN (o.quant - COALESCE(
					(SELECT
						sum(shipments.quant) AS sum
					FROM shipments
					WHERE shipments.order_id = o.id
						AND shipments.shipped = true
					), 0::numeric)
					) > 0::numeric
					AND (now()
						- (
							(SELECT shipments.ship_date_time
							FROM shipments
							WHERE shipments.order_id = o.id
							AND shipments.shipped = true
							ORDER BY shipments.ship_date_time DESC
							LIMIT 1)
						)::timestampTZ) > const_order_mark_if_no_ship_val()
				THEN TRUE
		    ELSE FALSE
		END AS no_ship_mark, 
		
		order_status(o) AS status,
			
		CASE
		    WHEN o.pay_cash THEN o.total
		    ELSE 0::numeric
		END AS total, 
		o.total_edit,
		o.under_control,
		
		o.payed,
		o.pay_cash,
		
		o.contact_id AS contact_id,
		o.temp,
		o.order_temp_comment_id,
		otc.name AS order_temp_comment_descr,
		
		order_edit(o) AS order_edit
		
	FROM orders o
	LEFT JOIN clients cl ON cl.id = o.client_id
	LEFT JOIN destinations d ON d.id = o.destination_id
	LEFT JOIN concrete_types concr ON concr.id = o.concrete_type_id
	LEFT JOIN pump_vehicles pvh ON pvh.id = o.pump_vehicle_id
	LEFT JOIN vehicles vh ON vh.id = pvh.vehicle_id
	LEFT JOIN clients vhcl ON vhcl.id = vh.client_id
	LEFT JOIN users u ON u.id = o.user_id
	LEFT JOIN order_temp_comments otc ON otc.id = o.order_temp_comment_id		
	;
ALTER TABLE orders_base
  OWNER TO beton;
