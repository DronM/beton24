-- View: orders_make_list_view

--DROP VIEW orders_make_list_view;
-- CASCADE;

CREATE OR REPLACE VIEW orders_make_list_view AS 
	SELECT
		o.id,
		
		o.client_id,
		cl.name AS client_descr,
		
		o.destination_id,
		d.name AS destination_descr,
		
		o.concrete_type_id,
		concr.name AS concrete_type_descr,
		
		o.unload_type,		
		
		vhcl.name::text AS vh_owner,
		vh.plate::text AS vh_plate,
 
		o.comment_text AS comment_text,
		
		o.contact_id AS contact_id,
		ct.first_name AS contact_first_name,
		ct.middle_name AS contact_middle_name,
		ct.last_name AS contact_last_name,
		ct.post AS contact_post,
		ct.description AS contact_description,
		cont_det.name AS contact_detail_main_name,
		cont_det.value AS contact_detail_main_value,
		cont_det.contact_type AS contact_detail_main_type,
		
		o.unload_speed,
		o.date_time,
		o.date_time_to,
		o.quant,
		COALESCE(
			(SELECT sum(shipments.quant) AS sum		
			FROM shipments
			WHERE shipments.order_id = o.id
			AND shipments.shipped = true),
			0::numeric
		) AS quant_done, 
		
        CASE
            WHEN now() > o.date_time AND now() < o.date_time_to THEN round((o.quant / (date_part('epoch'::text, o.date_time_to - o.date_time) / 60::numeric) * (date_part('epoch'::text, now() - o.date_time) / 60::numeric))::numeric, 2)::double precision
            WHEN now() > o.date_time_to THEN o.quant
            ELSE 0::numeric
        END AS quant_ordered_before_now, 
        
        CASE
            WHEN o.date_time::timeTZ >= const_shift_start_val() AND o.date_time::timeTZ < (const_shift_start_val()::timeTZ + const_shift_length_val()::interval)::timeTZ AND o.date_time_to::timeTZ >= const_shift_start_val() AND o.date_time_to::timeTZ < (const_shift_start_val() + const_shift_length_val()) THEN o.quant
            WHEN o.date_time::timeTZ >= const_shift_start_val() AND o.date_time::timeTZ < (const_shift_start_val()::timeTZ + const_shift_length_val()::interval)::timeTZ AND o.date_time::timeTZ < (const_shift_start_val() + const_shift_length_val())::timeTZ THEN round((o.quant / (date_part('epoch'::text, o.date_time_to - o.date_time) / 60::numeric) * (date_part('epoch'::text, o.date_time::date + (const_shift_start_val() + const_shift_length_val()) - o.date_time) / 60::numeric))::numeric, 2)::numeric
            ELSE 0::numeric
        END AS quant_ordered_day,
        
	(SELECT
		COALESCE(sum(shipments.quant), 0::numeric) AS sum
        FROM shipments
	WHERE shipments.order_id = o.id
		AND shipments.ship_date_time < now()
	) AS quant_shipped_before_now,
		
	(SELECT
		COALESCE(sum(shipments.quant), 0::numeric) AS sum
        FROM shipments
        WHERE shipments.order_id = o.id
			AND shipments.ship_date_time::timeTZ >= const_shift_start_val() AND shipments.ship_date_time::timeTZ <= (const_shift_start_val() + const_shift_length_val())::timeTZ
	) AS quant_shipped_day_before_now, 
		
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
		
	o.payed,
	
	order_payed_inf(o) AS payed_inf
	
	FROM orders o
	LEFT JOIN clients cl ON cl.id = o.client_id
	LEFT JOIN destinations d ON d.id = o.destination_id
	LEFT JOIN concrete_types concr ON concr.id = o.concrete_type_id
	LEFT JOIN pump_vehicles pvh ON pvh.id = o.pump_vehicle_id
	LEFT JOIN vehicles vh ON vh.id = pvh.vehicle_id
	LEFT JOIN clients vhcl ON vhcl.id = vh.client_id
	LEFT JOIN contacts ct ON ct.id = o.contact_id
	LEFT JOIN (SELECT
			ctctd.contact_id,
			ctd.name,
			ctd.value,
			ctd.contact_type
		FROM contact_contact_details ctctd
		LEFT JOIN contact_details AS ctd ON ctd.id=ctctd.contact_detail_id
		WHERE ctctd.main=TRUE
	) AS cont_det ON cont_det.contact_id=o.contact_id
	WHERE o.temp = FALSE
	ORDER BY o.date_time;

ALTER TABLE orders_make_list_view
  OWNER TO beton;
