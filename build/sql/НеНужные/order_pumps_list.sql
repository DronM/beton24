-- View: order_pumps_list
--DROP VIEW order_pumps_list;

CREATE OR REPLACE VIEW order_pumps_list AS 
	SELECT
		order_num(o.*) AS number,
		cl.name::text AS client_descr,
		o.client_id,
		d.name::text AS destination_descr,
		concr.name AS concrete_type_descr,
		get_unload_types_descr(o.unload_type) AS unload_type_descr,
		o.comment_text AS comment_text,
		o.descr AS descr,
		o.phone_cel,
		o.date_time,
		o.quant,
		o.user_id,
		u.name AS user_descr,
		o.create_date_time,
		o.id AS order_id,
		op.viewed,
		op.comment
	FROM orders o
	LEFT JOIN order_pumps AS op ON o.id=op.order_id
	LEFT JOIN clients cl ON cl.id = o.client_id
	LEFT JOIN destinations d ON d.id = o.destination_id
	LEFT JOIN concrete_types concr ON concr.id = o.concrete_type_id
	LEFT JOIN users u ON u.id = o.user_id     
	WHERE o.pump_vehicle_id IS NOT NULL
	ORDER BY o.date_time;

ALTER TABLE order_pumps_list
  OWNER TO beton;
