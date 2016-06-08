-- View: orders_temp_list

 DROP VIEW orders_temp_list;

CREATE OR REPLACE VIEW orders_temp_list AS 
	SELECT
		o.*,
		otc.name AS order_temp_descr
	FROM orders_base o
	LEFT JOIN order_temp_comments As otc ON otc.id=o.order_temp_comment_id
	WHERE o.temp = TRUE;

ALTER TABLE orders_temp_list OWNER TO beton;
