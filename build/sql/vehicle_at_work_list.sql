-- Function: vehicle_at_work_list(date)

--DROP FUNCTION vehicle_at_work_list(date);

CREATE OR REPLACE FUNCTION vehicle_at_work_list(date)
  RETURNS TABLE(
	--position
	vehicle_id int,
	vehicle_plate text,
	vehicle_owner text,
	vehicle_make text,
	period timestampTZ,
	lon_str varchar(13),
	lat_str varchar(13),
	speed numeric,
	ns character(1),
	ew character(1),
	received_dt timestampTZ,
	odometer int,
	engine_on character(1),
	voltage numeric,
	heading numeric,
	lon double precision,
	lat double precision,
	--inf
	driver_id int,
	driver_descr text,
	driver_tel text,
	shipment_id int,
	ship_date_time timestampTZ,
	ship_quant numeric,
	order_quant numeric,
	concrete_type_id int,
	order_total numeric,
	order_payed boolean,
	order_under_control boolean,
	order_pay_cash boolean,
	order_number text,
	order_user_id int,
	order_user_descr text,
	concrete_type_descr text,
	destination_id int,
	vehicle_tracker_id text,
	state text
  )
  AS
$BODY$
	SELECT 	
		vp_all.*,
		vs.driver_id,
		dr.name::text AS driver_descr,
		dr.phone_cel::text AS driver_tel,
		vss.shipment_id,
		sh.date_time AS ship_date_time,
		sh.quant::numeric AS ship_quant,
		o.quant::numeric AS order_quant,
		o.concrete_type_id,
		o.total As order_total,
		o.payed AS order_payed,
		o.under_control AS order_under_control,
		o.pay_cash AS order_pay_cash,
		o.number::text As ordr_number,
		o.user_id AS order_user_id,
		u.name::text AS ordr_user_descr,
		ct.name::text AS concrete_type_descr,
		vss.destination_id,
		vss.tracker_id As vehicle_tracker_id,
		vss.state::text AS vehicle_state
	 FROM 
	  (SELECT destination_id,tracker_id,shipment_id,state,date_time,schedule_id,rank()  
		 OVER (PARTITION BY schedule_id ORDER BY date_time DESC) FROM vehicle_schedule_states
		WHERE tracker_id IS NOT NULL AND tracker_id<>''
			AND date_time::date=$1
	  ) AS vss
	 LEFT JOIN shipments sh ON sh.id=vss.shipment_id
	 LEFT JOIN orders o ON sh.order_id=o.id
	 LEFT JOIN concrete_types ct ON ct.id=o.concrete_type_id
	 LEFT JOIN users u ON u.id=o.user_id
	 LEFT JOIN vehicle_schedules vs ON vs.id=vss.schedule_id
	 LEFT JOIN drivers dr ON dr.id=vs.driver_id
	 LEFT JOIN vehicle_current_pos_all vp_all ON vp_all.vehicle_id=vs.vehicle_id
	 WHERE vss.rank = 1;
	 
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION vehicle_at_work_list(date)
  OWNER TO beton;
