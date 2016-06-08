-- View: shipment_total_list

--DROP VIEW shipment_total_list;

CREATE OR REPLACE VIEW shipment_total_list AS 
	SELECT
		sh.ship_date_time::date AS ship_date,
		date5_descr(sh.ship_date_time::date) AS ship_date_descr,
		o.number AS order_number,
		sh.id AS ship_id,
		
		o.client_id,
		cl.name AS client_descr,
		
		o.destination_id AS destination_id,
		dest.name AS destination_descr,
		
		o.concrete_type_id,
		ct.name AS concrete_type_descr,
		
		sh.quant,
		
		cl.manager_id AS manager_id,
		men.name AS manager_descr,
		
		'' AS dispatcher_descr,
		
		o.descr AS order_contact,
		
		o.phone_cel,
		
		'' AS comment_text,
		
		o.payed,
		
		ship_st.driver_id,
		ship_st.driver_descr,
		ship_st.vehicle_descr,

		o.pump_vehicle_id,
		pvehveh.plate AS pump_vehicle_descr,
		pvehveh.owner AS pump_vehicle_owner,
		pvehveh.driver_id AS pump_vehicle_driver_id,
		pvehveh.name AS pump_vehicle_driver_descr,
		
		sh.demurrage AS veh_demurrage,
		'' AS pump_demurrage,
		sh.blanks_exist AS veh_blanks_exist,
		'' AS pump_blanks_exist,
		
		o.client_mark,
		
		assign_st.date_time AS assign_date_time,
		date5_time5_descr(assign_st.date_time) AS assign_date_time_descr,

		sh.date_time AS ship_date_time,
		date5_time5_descr(sh.date_time) AS ship_date_time_descr,

		at_dest_st.date_time AS at_dest_date_time,
		date5_time5_descr(at_dest_st.date_time) AS at_dest_date_time_descr,
		
		left_for_base_st.date_time AS left_for_base_date_time,
		date5_time5_descr(left_for_base_st.date_time) AS left_for_base_date_time_descr,
		
		time5_descr(dest.time_route) AS route_time_norm,
		time5_descr(at_dest_st.date_time-left_for_dest_st.date_time) AS route_time_fact,
		time5_descr((at_dest_st.date_time-left_for_dest_st.date_time)-dest.time_route) AS route_time_balance,
		
		'' AS status,
		
		shipment_time_norm(sh.quant) AS ship_time_norm,
		time5_descr(sh.ship_date_time-assign_st.date_time) AS ship_time_fact,
		
		--опоздание диспетчера
		ROUND((EXTRACT(EPOCH FROM (
		COALESCE(
		assign_st.date_time-
		(SELECT t2.date_time
		FROM shipments AS t1
		LEFT JOIN vehicle_schedule_states AS t2
			ON t2.shipment_id=t1.id AND t2.state='busy'
		WHERE t1.date_time<sh.date_time
			AND get_shift_start(t1.date_time)=get_shift_start(sh.date_time)
		ORDER BY t1.date_time DESC
		LIMIT 1
		)
		,'0 seconds'::INTERVAL)
		) )/60)::numeric,0)
		AS dispatcher_fail_min,
		
		--operator_fail_min
		ROUND((EXTRACT(EPOCH FROM sh.ship_date_time - assign_st.date_time)/60)::numeric,0)
		-
		shipment_time_norm(sh.quant::numeric)
		AS operator_fail_min,
		
		
	FROM shipments sh
	LEFT JOIN orders o ON o.id=sh.order_id
	LEFT JOIN clients cl ON o.client_id=cl.id
	LEFT JOIN destinations dest ON dest.id=o.destination_id
	LEFT JOIN concrete_types ct ON ct.id=o.concrete_type_id
	LEFT JOIN pump_vehicles pveh ON pveh.id=o.pump_vehicle_id
	LEFT JOIN vehicles pvehveh ON pvehveh.id=pvehveh.vehicle_id
	LEFT JOIN drivers AS pvehdr ON pvehdr.id=pvehveh.driver_id
	LEFT JOIN users men ON men.id=cl.manager_id
	LEFT JOIN (
		SELECT
			st.date_time,
			st.shipment_id,
			vs.driver_id,
			dr.name AS driver_descr,
			vh.plate AS vehicle_descr
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		LEFT JOIN vehicles AS vh ON vh.id=vs.vehicle_id
		LEFT JOIN drivers AS dr ON dr.id=vs.driver_id
		WHERE st.state='shipment'
	) ship_st ON ship_st.shipment_id=sh.id
	
	--назначен
	LEFT JOIN (
		SELECT
			st.date_time,
			st.shipment_id
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		WHERE st.state='assigned'
	) assign_st ON assign_st.shipment_id=sh.id
	
	--прибыл
	LEFT JOIN (
		SELECT
			st.date_time,
			st.shipment_id
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		WHERE st.state='at_dest'
	) at_dest_st ON at_dest_st.shipment_id=sh.id
	
	--выехал к клиенту
	LEFT JOIN (
		SELECT
			st.date_time,
			st.shipment_id
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		WHERE st.state='left_for_dest'
	) left_for_dest_st ON left_for_dest_st.shipment_id=sh.id
		
	--убыл
	LEFT JOIN (
		SELECT
			st.date_time,
			st.shipment_id
		FROM vehicle_schedule_states AS st
		LEFT JOIN vehicle_schedules AS vs ON vs.id=st.schedule_id
		WHERE st.state='left_for_base'
	) left_for_base_st ON left_for_base_st.shipment_id=sh.id
	
	;
ALTER TABLE shipment_total_list
  OWNER TO beton;
