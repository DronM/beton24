-- View: orders_list_view

-- DROP VIEW orders_list_view;

CREATE OR REPLACE VIEW orders_list_view AS 
	SELECT o.*
	FROM orders_base o
	WHERE o.temp = FALSE
	;
ALTER TABLE orders_list_view OWNER TO beton;
