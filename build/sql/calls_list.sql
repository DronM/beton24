-- VIEW: calls_list

--DROP VIEW calls_list;

CREATE OR REPLACE VIEW calls_list AS
	SELECT
		ac.unique_id,
		ac.caller_id_num AS caller_id_num,
		ac.ext,
		ac.call_type,

		ac.dt AS ring_time,
		ac.start_time AS answer_time,
		ac.end_time AS hangup_time,		

		ac.manager_comment AS call_comment,

		ac.client_id,
		cl.name AS client_descr,
		cl.client_type_id,
		clt.name AS client_type_descr,
		cl.client_kind,
		cl.client_come_from_id,
		clcfr.name AS client_come_from_descr,

		ac.user_id,
		u.name AS user_descr,
		
		--OFFER
		offers.concrete_type_id,
		ct.name AS concrete_type_descr,
		offers.quant,
		offers.unload_speed,
		offers.lang_id,
		offers.total,
		offers.concrete_price,
		offers.destination_price,
		offers.destination_id,
		d.name AS destination_descr,
		offers.unload_price
		offers.pump_vehicle_id,
		vh.owner::text AS vh_owner,
		vh.plate::text AS vh_plate,
		
		
		
	FROM calls AS ac
	LEFT JOIN clients AS cl ON cl.id=ac.client_id
	LEFT JOIN client_types AS clt ON clt.id=cl.client_type_id
	LEFT JOIN client_come_from AS clcfr ON clcfr.id=cl.client_come_from_id
	LEFT JOIN offers ON offers.call_id=ac.uniqu_id
	LEFT JOIN concrete_types AS ct ON ct.id=offers.concrete_type_id
	LEFT JOIN clients cl ON cl.id = offers.client_id
	LEFT JOIN destinations d ON d.id = offers.destination_id
	LEFT JOIN pump_vehicles pvh ON pvh.id = offers.pump_vehicle_id
	LEFT JOIN vehicles vh ON vh.id = pvh.vehicle_id
	
	ORDER BY ac.dt DESC
	;
ALTER VIEW calls_list OWNER TO beton;
