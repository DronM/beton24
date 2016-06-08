-- View: orders_make_list_view

--DROP VIEW orders_make_list_view;
-- CASCADE;

CREATE OR REPLACE VIEW orders_make_list_view AS 
	SELECT
		o.*
	FROM orders_base o
	WHERE o.temp=FALSE
	ORDER BY o.date_time
	;
ALTER TABLE orders_make_list_view
  OWNER TO beton;
