-- View: order_dialog_view

--DROP VIEW order_dialog_view;
-- CASCADE;

CREATE OR REPLACE VIEW order_dialog_view AS 
	SELECT
		o.*
	FROM orders_base o
	;
ALTER TABLE order_dialog_view
  OWNER TO beton;
