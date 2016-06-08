-- VIEW: orders_for_operator_list

--DROP VIEW orders_for_operator_list;

/* УДАЛИТЬ */
CREATE OR REPLACE VIEW orders_for_operator_list AS
	SELECT
		sh.*
	FROM shipment_base sh
	--LEFT JOIN order_for_operator_queue AS q ON q.shipment_id=sh.id
	;
ALTER VIEW orders_for_operator_list OWNER TO beton;

