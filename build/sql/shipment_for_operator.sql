-- Function: shipment_for_operator(timestampTZ, timestampTZ)

-- DROP FUNCTION shipment_for_operator(timestampTZ, timestampTZ);

CREATE OR REPLACE FUNCTION shipment_for_operator(timestampTZ,timestampTZ)
  RETURNS TABLE(
	id int,
	order_id int,
	order_number text,
	order_quant numeric,
	vehicle_schedule_id int,
	ship_date_time timestampTZ,
	date_time timestampTZ,
	quant numeric,
	cost numeric,
	shipped bool,
	concrete_type_id int,
	concrete_type_descr text,	
	vh_client_id int,
	vh_client_descr text,
	vh_plate text,
	
	driver_id int,
	driver_descr text,
	
	destination_id int,
	destination_descr text,
	
	client_id int,
	client_descr text,
	
	demurrage_cost numeric,
	
	user_id int,
	user_descr text

  /*
	sys_row boolean,
	quant_shipped numeric,
	quant_ordered numeric,
	id integer,
	client_descr character varying,
	destination_descr character varying,
	concrete_type_descr character varying,
	vehicle_descr text,
	driver_descr text,
	time_descr character varying,
	ship_time_descr character varying,
	date_time timestamp without time zone,
	date date,
	quant double precision,
	shipped boolean
*/	
) AS
$BODY$
	SELECT * FROM shipment_base
	WHERE date_time BETWEEN $1 AND $2;
/*
	SELECT * FROM (
		 (SELECT
			 TRUE AS sys_row,
			 coalesce(SUM(shipments.quant::numeric),0) AS quant_shipped,
			 0 AS quant_ordered,
			 0 AS id,
			 ''::varchar AS client_descr,
			 ''::varchar AS destination_descr, 
			 ''::varchar AS concrete_type_descr, 
			 ''::text AS vehicle_descr, 
			 ''::text AS driver_descr,
			 ''::varchar AS time_descr, 
			 ''::varchar AS ship_time_descr,
			 current_timestamp::timestamp without time zone AS date_time,
			 current_date AS date,
			 0 AS quant,
			 TRUE AS shipped
		 FROM shipments
		 WHERE shipments.ship_date_time BETWEEN in_date_time_from AND in_date_time_to
		 )

		UNION ALL

		 (SELECT
			 TRUE AS sys_row, 
			 0 As quant_shipped,
			 coalesce(SUM(orders.quant::numeric),0) AS quant_ordered,
			 0 AS id,
			 ''::varchar AS client_descr,
			 ''::varchar AS destination_descr, 
			 ''::varchar AS concrete_type_descr, 
			 ''::text AS vehicle_descr, 
			 ''::text AS driver_descr,
			 ''::varchar AS time_descr, 
			 ''::varchar AS ship_time_descr,
			 current_timestamp::timestamp without time zone AS date_time,
			 current_date AS date,
			 0 AS quant,
			 TRUE AS shipped
		 FROM orders WHERE orders.date_time BETWEEN in_date_time_from AND in_date_time_to
		 )

		UNION ALL
		 
		 (SELECT
			FALSE AS sys_row,
			0 AS quant_shipped,
			0 AS quant_ordered,
			sh.id,
			cl.name AS client_descr,
			dest.name AS destination_descr, 
			ct.name AS concrete_type_descr, 
			v.plate::text AS vehicle_descr, 
			d.name::text AS driver_descr,
			time5_descr(sh.date_time::time without time zone)::varchar AS time_descr, 
			''::varchar AS ship_time_descr,
			sh.date_time,
			sh.date_time::date AS date,
			sh.quant,
			FALSE AS shipped
		FROM shipments sh
		LEFT JOIN orders o ON o.id = sh.order_id
		LEFT JOIN clients cl ON cl.id = o.client_id
		LEFT JOIN vehicle_schedules vs ON vs.id = sh.vehicle_schedule_id
		LEFT JOIN drivers d ON d.id = vs.driver_id
		LEFT JOIN vehicles v ON v.id = vs.vehicle_id
		LEFT JOIN destinations dest ON dest.id = o.destination_id
		LEFT JOIN concrete_types ct ON ct.id = o.concrete_type_id
		WHERE sh.shipped = FALSE
		ORDER BY sh.date_time)
		
		UNION ALL
		
		(SELECT 
			FALSE AS sys_row,
			0 AS quant_shipped,
			0 AS quant_ordered,		
			sh.id,
			cl.name AS client_descr,
			dest.name AS destination_descr, 
			ct.name AS concrete_type_descr, 
			v.plate::text AS vehicle_descr, 
			d.name::text AS driver_descr,
			time5_descr(sh.date_time::time without time zone)::varchar AS time_descr, 
			time5_descr(sh.ship_date_time::time without time zone)::varchar AS ship_time_descr, 
			sh.date_time,
			sh.date_time::date AS date,
			sh.quant,
			sh.shipped
		FROM shipments sh
		LEFT JOIN orders o ON o.id = sh.order_id
		LEFT JOIN clients cl ON cl.id = o.client_id
		LEFT JOIN vehicle_schedules vs ON vs.id = sh.vehicle_schedule_id
		LEFT JOIN drivers d ON d.id = vs.driver_id
		LEFT JOIN vehicles v ON v.id = vs.vehicle_id
		LEFT JOIN destinations dest ON dest.id = o.destination_id
		LEFT JOIN concrete_types ct ON ct.id = o.concrete_type_id
		WHERE (sh.ship_date_time BETWEEN in_date_time_from AND in_date_time_to)
		ORDER BY sh.ship_date_time DESC
		)
	) AS subq

	  ORDER BY 
	CASE
	    WHEN subq.sys_row THEN 0
	    WHEN subq.shipped THEN 2
	    ELSE 1
	END;
*/	
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION shipment_for_operator(timestampTZ, timestampTZ)
  OWNER TO beton;
