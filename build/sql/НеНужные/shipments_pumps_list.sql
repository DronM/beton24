-- View: shipments_pumps_list

--DROP VIEW shipments_pumps_list;

CREATE OR REPLACE VIEW shipments_pumps_list AS 
	SELECT
		sh.id,
		sh.ship_date_time AS ship_date_time,
		date8_time8_descr(sh.ship_date_time::date) AS ship_date_time_descr,
		o.client_id,
		cl.name AS client_descr,
		o.destination_id,
		d.name AS destination_descr,
		sh.quant AS quant,
		o.unload_price,
		o.pump_vehicle_id,
		vh.owner,
		vh.plate,
		vh.driver_id,
		dr.name AS driver_descr,
		sh.blanks_exist,
		time5_descr(sh.demurrage) AS demurrage
		
	FROM shipments sh
	LEFT JOIN orders o ON o.id=sh.order_id
	LEFT JOIN clients cl ON cl.id=o.client_id	
	LEFT JOIN destinations d ON d.id=o.destination_id	
	LEFT JOIN vehicles vh ON vh.id=o.pump_vehicle_id	
	LEFT JOIN drivers dr ON dr.id=vh.driver_id	
	WHERE o.unload_type='pump' or o.unload_type='band'
	ORDER BY sh.ship_date_time DESC
	;
	
ALTER TABLE shipments_pumps_list
  OWNER TO beton;
