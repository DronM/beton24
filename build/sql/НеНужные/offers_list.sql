-- VIEW: offers_list

--DROP VIEW offers_list;

CREATE OR REPLACE VIEW offers_list AS
	SELECT
		o.id,
		o.client_id,
		cl.name AS client_descr,
		o.destination_id,
		dest.name AS destination_descr,
		o.concrete_type_id,
		ct.name AS concrete_type_descr,
		o.unload_type,
		o.comment_text,
		o.date_time,
		o.date_time_to,
		o.quant,
		o.unload_speed,
		o.total,
		o.concrete_price,
		o.destination_price,
		o.unload_price,
		o.pump_vehicle_id,
		vh.owner vh_owner,
		vh.plate vh_plate,
		o.pay_cash,
		o.total_edit,
		o.payed dataType,
		o.under_control,
		o.address
	FROM offers o
	LEFT JOIN clients AS cl ON cl.id=o.client_id
	LEFT JOIN destinations AS dest ON dest.id=o.destination_id
	LEFT JOIN concrete_types AS ct ON ct.id=o.concrete_type_id
	LEFT JOIN pump_vehicles_list pv ON pv.id = o.pump_vehicle_id
	LEFT JOIN vehicles vh ON vh.id = pv.vehicle_id	
	ORDER BY o.date_time;
ALTER VIEW offers_list OWNER TO beton;
