-- View: shipment_dialog_view

--DROP VIEW shipment_dialog_view;

CREATE OR REPLACE VIEW shipment_dialog_view AS 
	SELECT sh.*
	FROM shipment_base sh
	;
ALTER TABLE shipment_dialog_view
  OWNER TO beton;

