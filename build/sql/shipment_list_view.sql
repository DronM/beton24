-- View: shipment_list_view

-- DROP VIEW shipment_list_view;

CREATE OR REPLACE VIEW shipment_list_view AS 
	SELECT sh.*
	FROM shipment_base sh
	;
ALTER TABLE shipment_list_view OWNER TO beton;

