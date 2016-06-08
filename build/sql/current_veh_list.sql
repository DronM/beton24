-- Function: current_veh_list(date)

--DROP FUNCTION current_veh_list(date);

CREATE OR REPLACE FUNCTION current_veh_list(date)
  RETURNS TABLE(
	id integer,	
	--ТС
	driver_id integer,
	vehicle_id integer,
	vh_plate text,	
	--вледелец
	vh_owner_id integer,
	vh_owner_descr text,
	vh_owner_tel_name text,
	vh_owner_tel_value text,
	vh_owner_email_name text,
	vh_owner_email_value text,
	--Водитель
	vh_driver_descr text,
	vh_driver_tel_name text,
	vh_driver_tel_value text,
	vh_driver_email_name text,
	vh_driver_email_value text,
	--Доп.инф
	state vehicle_states,
	state_date_time timestampTZ,
	is_late boolean,
	is_late_at_dest boolean,
	
	idle_time integer,
	waiting_time integer,
	out_time timestampTZ,
	
	load_capacity numeric,
	runs bigint,
	tracker_no_data boolean,
	no_tracker boolean,
	out_comment text,
	schedule_date date
	) AS
$BODY$
	--*****************************
	WITH all_states AS (
		SELECT 
			st.date_time, --нужно для сортировок
			vs.id,
			--ТС
			v.driver_id,
			v.id AS vh_id, 
			v.plate::text AS vh_plate,
			
			--Владелец
			v.client_id AS vh_owner_id,
			vcl.name::text AS vh_owner_descr,
			owner_tel.name AS vh_owner_tel_name,
			owner_tel.value AS vh_owner_tel_value,	
			owner_mail.name AS vh_owner_email_name,
			owner_mail.value AS vh_owner_email_value,
			
			--Водитель
			d.name::text AS vh_driver_descr,
			dr_tel.name AS vh_driver_tel_name,
			dr_tel.value AS vh_driver_tel_value,	
			dr_mail.name AS vh_driver_email_name,
			dr_mail.value AS vh_driver_email_value,
			
			st.state,
			st.date_time AS state_date_time,

			--Опаздывает
			CASE 					
				WHEN
					--Занят и время статуса + время до объекта просрочено, не доехал до объекта за расчетное время
					(st.state = 'busy'::vehicle_states
					AND (st.date_time + coalesce(dest.time_route,'00:00'::time))::timestampTZ < CURRENT_TIMESTAMP
					)
					
					OR
					
					--Выехал на базу с объекта и время статуса + время до объекта просрочено, не доехал до базы за расчетное время
					(st.state = 'left_for_base'::vehicle_states
					AND (st.date_time +  coalesce(dest.time_route,'00:00'::time)) < CURRENT_TIMESTAMP
					)
					
					THEN TRUE
				ELSE FALSE
			END AS is_late,

			--Опаздывает на объекте
			CASE
				--на объекте и просрочил время разгрузки
				WHEN st.state = 'at_dest'::vehicle_states
				AND (st.date_time + (coalesce(dest.time_route,'00:00'::time)*1 + const_vehicle_unload_time_val())::interval)::timestampTZ < CURRENT_TIMESTAMP
					THEN TRUE
				ELSE FALSE
			END AS is_late_at_dest,
			
			--Расчетное время возвращения
			/*
			CASE
				--shift - no inf
				WHEN st.state = 'shift'::vehicle_states OR st.state = 'shift_added'::vehicle_states
					THEN ''::text

				-- out_from_shift && out inf=out time
				WHEN st.state = 'out_from_shift'::vehicle_states OR st.state = 'out'::vehicle_states
					THEN ''::text

				--free && assigned inf= time elapsed
				WHEN st.state = 'free'::vehicle_states OR st.state = 'assigned'::vehicle_states
					THEN (CURRENT_TIMESTAMP-st.date_time)::text

				--busy && late inf = -
				--WHEN st.state = 'busy'::vehicle_states AND (st.date_time + (coalesce(dest.time_route,'00:00'::time)*2+constant_vehicle_unload_time())::interval )::timestamp with time zone < CURRENT_TIMESTAMP
					--THEN '-'::text || time5_descr((CURRENT_TIMESTAMP - (st.date_time + (coalesce(dest.time_route,'00:00'::time)*2+constant_vehicle_unload_time())::interval)::timestamp with time zone)::time without time zone)::text
					
				WHEN st.state = 'busy'::vehicle_states
					AND (st.date_time + coalesce(dest.time_route::interval,'00:00'::interval)+const_vehicle_unload_time_val()::interval )::timestampTZ < CURRENT_TIMESTAMP
					THEN (coalesce(dest.time_route::interval,'00:00'::interval)+const_vehicle_unload_time_val()::interval)::text
					
				-- busy not late
				WHEN st.state = 'busy'::vehicle_states
					THEN (coalesce(dest.time_route::interval,'00:00'::interval)+const_vehicle_unload_time_val()::interval)::text

				--at dest && late inf=route_time
				WHEN st.state = 'at_dest'::vehicle_states
					AND (st.date_time + (coalesce(dest.time_route::interval,'00:00'::interval)*1+const_vehicle_unload_time_val()) ) < CURRENT_TIMESTAMP
					THEN coalesce(dest.time_route::interval,'00:00'::interval)::text

				--at dest NOT late
				WHEN st.state = 'at_dest'::vehicle_states
					THEN ((st.date_time + (coalesce(dest.time_route::interval,'00:00'::interval)+const_vehicle_unload_time_val()::interval)) - CURRENT_TIMESTAMP)::text

				--left_for_base && LATE
				WHEN st.state = 'left_for_base'::vehicle_states AND (st.date_time + coalesce(dest.time_route::interval,'00:00'::interval) ) < CURRENT_TIMESTAMP
					THEN (CURRENT_TIMESTAMP - (st.date_time::time::interval + coalesce(dest.time_route::interval,'00:00'::interval)))::text

				--left_for_base NOT late
				WHEN st.state = 'left_for_base'::vehicle_states
					THEN ((st.date_time + coalesce(dest.time_route::interval,'00:00'::interval) ) - CURRENT_TIMESTAMP)::text
			    
				ELSE NULL
			    
			END AS return_inf, 
			*/
			
			/* Время которое экипаж свободен*/
			CASE
				WHEN st.state = 'free'::vehicle_states THEN
					EXTRACT (EPOCH FROM now() - st.date_time)::int/60
				ELSE NULL
			END AS idle_time,
			
			/* время через которое экипаж освободится*/
			CASE
				/* просто назначен - двойная дорога + разгрузка*/
				WHEN st.state = 'busy'::vehicle_states THEN
					EXTRACT (EPOCH FROM
						coalesce(dest.time_route::interval,'00:00'::interval)*2 + const_vehicle_unload_time_val()::interval
					)::int/60
				
				/* выехал с базы - дорога + разгрузка + обратная дорога*/ 
				WHEN st.state = 'left_for_dest'::vehicle_states THEN
					EXTRACT (EPOCH FROM
						coalesce(dest.time_route::interval,'00:00'::interval)*2 + const_vehicle_unload_time_val()::interval
					)::int/60				
				
				/* на месте - разгрузка + обратная дорога*/ 
				WHEN st.state = 'at_dest'::vehicle_states THEN
					EXTRACT (EPOCH FROM
						coalesce(dest.time_route::interval,'00:00'::interval)*2 + const_vehicle_unload_time_val()::interval
					)::int/60				
				
				/* выехал на базу - дорога*/	
				WHEN st.state = 'left_for_base'::vehicle_states THEN
					EXTRACT (EPOCH FROM
						coalesce(dest.time_route::interval,'00:00'::interval)
					)::int/60
				ELSE NULL
			END AS waiting_time,
			
			/* время выхода со смены*/
			CASE
				WHEN st.state = 'out_from_shift'::vehicle_states OR st.state = 'out'::vehicle_states THEN
					st.date_time
				ELSE NULL
			END AS out_time,
			
			v.load_capacity::numeric,
			
			(SELECT COUNT(*) FROM shipments
				WHERE (shipments.vehicle_schedule_id = vs.id AND shipments.shipped)
			) AS runs,

			(SELECT 
				(now()-tr.period)>const_no_tracker_signal_warn_interval_val()
				FROM car_tracking AS tr WHERE tr.car_id=v.tracker_id ORDER BY tr.period DESC LIMIT 1
			) AS tracker_no_data,
			
			(v.tracker_id IS NULL OR v.tracker_id='') AS no_tracker,
			
			out_comments.comment_text AS out_comment
			
		FROM vehicle_schedules vs
		
		LEFT JOIN drivers d ON d.id = vs.driver_id
		LEFT JOIN vehicles v ON v.id = vs.vehicle_id

		LEFT JOIN vehicle_schedule_states st ON
			st.id = (SELECT vehicle_schedule_states.id 
				FROM vehicle_schedule_states
				WHERE vehicle_schedule_states.schedule_id = vs.id
				ORDER BY vehicle_schedule_states.date_time DESC LIMIT 1
			)
		LEFT JOIN shipments AS sh ON sh.id=st.shipment_id
		LEFT JOIN orders AS o ON o.id=sh.order_id		
		LEFT JOIN destinations AS dest ON dest.id=o.destination_id
		LEFT JOIN clients vcl ON vcl.id = v.client_id
		LEFT JOIN out_comments ON out_comments.vehicle_schedule_id=vs.id
			
		--main tel
		LEFT JOIN (
			SELECT
				ccd.driver_id,
				cd.name,
				cd.value
			FROM driver_contact_details AS ccd
			LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
			WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
		) AS dr_tel ON dr_tel.driver_id=d.id

		--email
		LEFT JOIN (
			SELECT
				ccd.driver_id,
				cd.name,
				cd.value
			FROM driver_contact_details AS ccd
			LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
			WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
		) AS dr_mail ON dr_mail.driver_id=d.id

		--main owner tel
		LEFT JOIN (
			SELECT
				ccd.client_id,
				cd.name,
				cd.value
			FROM client_contact_details AS ccd
			LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
			WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
		) AS owner_tel ON owner_tel.client_id=vcl.id

		--main owner email
		LEFT JOIN (
			SELECT
				ccd.client_id,
				cd.name,
				cd.value
			FROM client_contact_details AS ccd
			LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
			WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
		) AS owner_mail ON owner_mail.client_id=vcl.id					
		
		WHERE vs.schedule_date=$1
	)

	--assigned
	(SELECT 
		all_states.id,
		--ТС
		all_states.driver_id,
		all_states.vh_id,
		all_states.vh_plate,	
		--вледелец
		all_states.vh_owner_id,
		all_states.vh_owner_descr,
		all_states.vh_owner_tel_name,
		all_states.vh_owner_tel_value,
		all_states.vh_owner_email_name,
		all_states.vh_owner_email_value,
		--Водитель
		all_states.vh_driver_descr,
		all_states.vh_driver_tel_name,
		all_states.vh_driver_tel_value,
		all_states.vh_driver_email_name,
		all_states.vh_driver_email_value,
		--Доп.инф
		all_states.state,
		all_states.state_date_time,
		all_states.is_late,
		all_states.is_late_at_dest,
		
		all_states.idle_time,
		all_states.waiting_time,
		all_states.out_time,
		
		all_states.load_capacity,
		all_states.runs,
		all_states.tracker_no_data,
		all_states.no_tracker,
		all_states.out_comment,
		$1
	FROM all_states WHERE all_states.state='assigned'::vehicle_states
	ORDER BY CURRENT_TIMESTAMP-all_states.date_time DESC)

	UNION ALL

	--free
	(SELECT 
		all_states.id,
		--ТС
		all_states.driver_id,
		all_states.vh_id,
		all_states.vh_plate,	
		--вледелец
		all_states.vh_owner_id,
		all_states.vh_owner_descr,
		all_states.vh_owner_tel_name,
		all_states.vh_owner_tel_value,
		all_states.vh_owner_email_name,
		all_states.vh_owner_email_value,
		--Водитель
		all_states.vh_driver_descr,
		all_states.vh_driver_tel_name,
		all_states.vh_driver_tel_value,
		all_states.vh_driver_email_name,
		all_states.vh_driver_email_value,
		--Доп.инф
		all_states.state,
		all_states.state_date_time,
		all_states.is_late,
		all_states.is_late_at_dest,
		
		all_states.idle_time,
		all_states.waiting_time,
		all_states.out_time,
		
		all_states.load_capacity,
		all_states.runs,
		all_states.tracker_no_data,
		all_states.no_tracker,
		all_states.out_comment,
		$1
	FROM all_states WHERE all_states.state='free'::vehicle_states
	ORDER BY CURRENT_TIMESTAMP-all_states.date_time DESC)

	UNION ALL

	--late
	(SELECT 
		all_states.id,
		--ТС
		all_states.driver_id,
		all_states.vh_id,
		all_states.vh_plate,	
		--вледелец
		all_states.vh_owner_id,
		all_states.vh_owner_descr,
		all_states.vh_owner_tel_name,
		all_states.vh_owner_tel_value,
		all_states.vh_owner_email_name,
		all_states.vh_owner_email_value,
		--Водитель
		all_states.vh_driver_descr,
		all_states.vh_driver_tel_name,
		all_states.vh_driver_tel_value,
		all_states.vh_driver_email_name,
		all_states.vh_driver_email_value,
		--Доп.инф
		all_states.state,
		all_states.state_date_time,
		all_states.is_late,
		all_states.is_late_at_dest,
		
		all_states.idle_time,
		all_states.waiting_time,
		all_states.out_time,
		
		all_states.load_capacity,
		all_states.runs,
		all_states.tracker_no_data,
		all_states.no_tracker,
		all_states.out_comment,
		$1
	FROM all_states WHERE all_states.is_late
	ORDER BY CURRENT_TIMESTAMP-all_states.date_time DESC)


	UNION ALL

	--busy && at_dest(late/not late) && left_for_base
	(SELECT 
		all_states.id,
		--ТС
		all_states.driver_id,
		all_states.vh_id,
		all_states.vh_plate,	
		--вледелец
		all_states.vh_owner_id,
		all_states.vh_owner_descr,
		all_states.vh_owner_tel_name,
		all_states.vh_owner_tel_value,
		all_states.vh_owner_email_name,
		all_states.vh_owner_email_value,
		--Водитель
		all_states.vh_driver_descr,
		all_states.vh_driver_tel_name,
		all_states.vh_driver_tel_value,
		all_states.vh_driver_email_name,
		all_states.vh_driver_email_value,
		--Доп.инф
		all_states.state,
		all_states.state_date_time,
		all_states.is_late,		
		all_states.is_late_at_dest,
		all_states.idle_time,
		all_states.waiting_time,
		all_states.out_time,
		all_states.load_capacity,
		all_states.runs,
		all_states.tracker_no_data,
		all_states.no_tracker,
		all_states.out_comment,
		$1
	FROM all_states WHERE (all_states.state='busy'::vehicle_states OR all_states.state='at_dest'::vehicle_states OR all_states.state='left_for_base'::vehicle_states) AND (NOT all_states.is_late)
	)


	UNION ALL

	--shift && shift_added
	(SELECT 
		all_states.id,
		--ТС
		all_states.driver_id,
		all_states.vh_id,
		all_states.vh_plate,	
		--вледелец
		all_states.vh_owner_id,
		all_states.vh_owner_descr,
		all_states.vh_owner_tel_name,
		all_states.vh_owner_tel_value,
		all_states.vh_owner_email_name,
		all_states.vh_owner_email_value,
		--Водитель
		all_states.vh_driver_descr,
		all_states.vh_driver_tel_name,
		all_states.vh_driver_tel_value,
		all_states.vh_driver_email_name,
		all_states.vh_driver_email_value,
		--Доп.инф
		all_states.state,
		all_states.state_date_time,
		all_states.is_late,
		all_states.is_late_at_dest,
		
		all_states.idle_time,
		all_states.waiting_time,
		all_states.out_time,

		all_states.load_capacity,
		all_states.runs,
		all_states.tracker_no_data,
		all_states.no_tracker,
		all_states.out_comment,
		$1
	FROM all_states WHERE all_states.state='shift'::vehicle_states OR all_states.state='shift_added'::vehicle_states
	ORDER BY all_states.vh_plate)

	UNION ALL

	--out
	(SELECT 
		all_states.id,
		--ТС
		all_states.driver_id,
		all_states.vh_id,
		all_states.vh_plate,	
		--вледелец
		all_states.vh_owner_id,
		all_states.vh_owner_descr,
		all_states.vh_owner_tel_name,
		all_states.vh_owner_tel_value,
		all_states.vh_owner_email_name,
		all_states.vh_owner_email_value,
		--Водитель
		all_states.vh_driver_descr,
		all_states.vh_driver_tel_name,
		all_states.vh_driver_tel_value,
		all_states.vh_driver_email_name,
		all_states.vh_driver_email_value,
		--Доп.инф
		all_states.state,
		all_states.state_date_time,
		all_states.is_late,
		all_states.is_late_at_dest,

		all_states.idle_time,
		all_states.waiting_time,
		all_states.out_time,

		all_states.load_capacity,
		all_states.runs,
		all_states.tracker_no_data,
		all_states.no_tracker,
		all_states.out_comment,
		$1
	FROM all_states WHERE all_states.state='out_from_shift'::vehicle_states OR all_states.state='out'::vehicle_states
	)
	;
	
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION current_veh_list(date)
  OWNER TO beton;
