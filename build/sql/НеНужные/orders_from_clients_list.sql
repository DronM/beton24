-- View: orders_from_clients_list

DROP VIEW orders_from_clients_list;

CREATE OR REPLACE VIEW orders_from_clients_list AS 
	SELECT
		o.id,
		o.date_time,
		date8_time5_descr(o.date_time) AS date_time_descr,
		o.name,
		o.tel,
		'8'||'-'||substr(trim(o.tel),1,3)||'-'||substr(trim(o.tel),4,3)||'-'||substr(trim(o.tel),7,2)||'-'||substr(trim(o.tel),9,2) AS tel_descr,
		o.concrete_type,
		o.dest,
		o.total,
		format_money(o.total) AS total_descr,
		o.quant,
		o.pump,
		o.comment_text,
		CASE o.viewed
			WHEN TRUE THEN 'viewed'
			ELSE ''
		END AS viewed
   FROM orders_from_clients o;

ALTER TABLE orders_from_clients_list OWNER TO beton;