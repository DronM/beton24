-- View: lab_entry_30days_2

DROP VIEW lab_entry_30days_2;

CREATE OR REPLACE VIEW lab_entry_30days_2 AS 
	WITH
		start_h AS (SELECT EXTRACT(HOUR FROM const_first_shift_start_time_val()) AS h),
		end_h AS (
			SELECT EXTRACT(HOUR FROM const_first_shift_start_time_val())
				+EXTRACT(HOUR FROM const_day_shift_length_val()) AS h
		),
		sub AS (	
			SELECT 
				det.concrete_type_id,
				ct.name AS concrete_name,
				(upper(SUBSTR(ct.name,1,2))='ПБ') AS is_pb,
				SUM(det.cnt) AS cnt,
				SUM(det.day_cnt) AS day_cnt,
				SUM(det.selected_cnt) AS selected_cnt,
				ROUND(AVG(det.ok)) AS ok,
				ROUND(AVG(det.p7)) AS p7,
				ROUND(AVG(det.p28)) AS p28
			FROM (	
				SELECT 
					o.concrete_type_id,
					
					--все авто
					1 AS cnt,

					--выходные и не рабочее время
					CASE
						WHEN EXTRACT(DOW FROM sh.ship_date_time)=0 OR EXTRACT(DOW FROM sh.ship_date_time)=6 THEN 0
						WHEN
							EXTRACT(HOUR FROM sh.ship_date_time)<(SELECT t.h FROM start_h t)
							OR EXTRACT(HOUR FROM sh.ship_date_time)>=(SELECT t.h FROM end_h t) THEN 0
						ELSE 1
					END AS day_cnt,

					--Отобранные по будням
					CASE
						WHEN
							EXTRACT(DOW FROM sh.ship_date_time)>0
							AND EXTRACT(DOW FROM sh.ship_date_time)<6
							--AND ( COALESCE(lab.ok,0)+COALESCE(lab.weight,0) )>0
							AND lab.id IS NOT NULL
							AND
							(EXTRACT(HOUR FROM sh.ship_date_time)>=(SELECT t.h FROM start_h t)
							OR EXTRACT(HOUR FROM sh.ship_date_time)<(SELECT t.h FROM end_h t)
							)
							THEN 1
						ELSE 0
					END AS selected_cnt,
					
					lab.p7,
					lab.p28,
					lab.ok
					
				FROM shipments sh
				LEFT JOIN vehicle_schedules AS vs ON vs.id=sh.vehicle_schedule_id
				LEFT JOIN orders AS o ON o.id=sh.order_id
				LEFT JOIN concrete_types AS ct ON ct.id=o.concrete_type_id
				--LEFT JOIN lab_entry_details AS lab ON lab.shipment_id=sh.id
				LEFT JOIN lab_entry_list_view AS lab ON lab.shipment_id=sh.id
				WHERE
					sh.ship_date_time BETWEEN now()::timestamp-(const_lab_days_for_avg_val()||' days')::interval AND now()::timestamp
					AND ct.pres_norm>0
			) AS det	

			LEFT JOIN concrete_types AS ct ON ct.id=det.concrete_type_id

			GROUP BY 
				det.concrete_type_id,
				ct.name
		),
		sub2 AS (	
			SELECT 
				det.concrete_type_id,
				ct.name AS concrete_name,
				(upper(SUBSTR(ct.name,1,2))='ПБ') AS is_pb,
				SUM(det.cnt) AS cnt,
				SUM(det.day_cnt) AS day_cnt,
				SUM(det.selected_cnt) AS selected_cnt,
				ROUND(AVG(det.ok)) AS ok,
				ROUND(AVG(det.p7)) AS p7,
				ROUND(AVG(det.p28)) AS p28
			FROM (	
				SELECT 
					o.concrete_type_id,
					
					--все авто
					1 AS cnt,

					--выходные и не рабочее время
					CASE
						WHEN EXTRACT(DOW FROM sh.ship_date_time)=0 OR EXTRACT(DOW FROM sh.ship_date_time)=6 THEN 0
						WHEN
							EXTRACT(HOUR FROM sh.ship_date_time)<(SELECT t.h FROM start_h t)
							OR EXTRACT(HOUR FROM sh.ship_date_time)>=(SELECT t.h FROM end_h t) THEN 0
						ELSE 1
					END AS day_cnt,

					--Отобранные по будням
					CASE
						WHEN
							EXTRACT(DOW FROM sh.ship_date_time)>0
							AND EXTRACT(DOW FROM sh.ship_date_time)<6
							--AND ( COALESCE(lab.ok,0)+COALESCE(lab.weight,0) )>0
							AND lab.id IS NOT NULL
							AND
							(EXTRACT(HOUR FROM sh.ship_date_time)>=(SELECT t.h FROM start_h t)
							OR EXTRACT(HOUR FROM sh.ship_date_time)<(SELECT t.h FROM end_h t)
							)
							THEN 1
						ELSE 0
					END AS selected_cnt,
					
					lab.p7,
					lab.p28,
					lab.ok
					
				FROM shipments sh
				LEFT JOIN vehicle_schedules AS vs ON vs.id=sh.vehicle_schedule_id
				LEFT JOIN orders AS o ON o.id=sh.order_id
				LEFT JOIN concrete_types AS ct ON ct.id=o.concrete_type_id
				--LEFT JOIN lab_entry_details AS lab ON lab.shipment_id=sh.id
				LEFT JOIN lab_entry_list_view AS lab ON lab.shipment_id=sh.id
				WHERE
					sh.ship_date_time BETWEEN now()::timestamp-(const_lab_days_for_avg_val()*2||' days')::interval
						AND now()::timestamp-(const_lab_days_for_avg_val()||' days')::interval
					AND ct.pres_norm>0
			) AS det	

			LEFT JOIN concrete_types AS ct ON ct.id=det.concrete_type_id

			GROUP BY 
				det.concrete_type_id,
				ct.name
		)	
	
	(SELECT
		subsub.concrete_type_id,
		subsub.concrete_type_descr,
		sum(subsub.cnt) AS cnt,
		sum(subsub.day_cnt) AS day_cnt,
		sum(subsub.selected_cnt) AS selected_cnt,
		sum(subsub.selected_avg_cnt) AS selected_avg_cnt,
		sum(subsub.need_cnt) AS need_cnt,
		sum(subsub.ok) AS ok,
		sum(subsub.p7) AS p7,
		sum(subsub.p28) AS p28,
		sum(subsub.selected_cnt2) AS selected_cnt2,
		sum(subsub.ok2) AS ok2,
		sum(subsub.p72) AS p72,
		sum(subsub.p282) AS p282
	FROM
		(
		(SELECT 
			sub.concrete_type_id,
			sub.concrete_name AS concrete_type_descr,
			sub.cnt,
			sub.day_cnt,
			sub.selected_cnt,
			(SELECT ROUND(AVG(t.selected_cnt)) FROM sub t WHERE t.is_pb=FALSE) AS selected_avg_cnt,
			
			CASE
				WHEN (SELECT ROUND(AVG(t.selected_cnt)) FROM sub t WHERE t.is_pb=FALSE)>sub.selected_cnt
					THEN (SELECT ROUND(AVG(t.selected_cnt)) FROM sub t WHERE t.is_pb=FALSE)-sub.selected_cnt
				ELSE (SELECT const_lab_min_sample_count_val())
			END AS need_cnt,
			sub.ok,
			sub.p7,
			sub.p28,
			0 AS selected_cnt2,
			0 AS ok2,
			0 AS p72,
			0 AS p282
			
		FROM sub)

		UNION
		
		(SELECT 
			sub2.concrete_type_id,
			sub2.concrete_name AS concrete_type_descr,
			0 AS cnt,
			0 AS day_cnt,
			0 AS selected_cnt,
			0 AS selected_avg_cnt,
			0 AS need_cnt,
			0 AS ok,
			0 AS p7,
			0 AS p28,
			sub2.selected_cnt AS selected_cnt2,
			sub2.ok AS ok2,
			sub2.p7 AS p72,
			sub2.p28 AS p282
			
		FROM sub2)
		) AS subsub
		GROUP BY 
			subsub.concrete_type_id,
			subsub.concrete_type_descr
		ORDER BY subsub.concrete_type_descr
	) 	
	--ИТОГИ
	UNION ALL
	(
	SELECT
		NULL AS concrete_type_id,
		'ИТОГИ' AS concrete_type_descr,
		(SELECT SUM(t.cnt) FROM sub t) AS cnt,
		(SELECT SUM(t.day_cnt) FROM sub t) AS day_cnt,
		(SELECT SUM(t.selected_cnt) FROM sub t WHERE t.is_pb=FALSE),
		(SELECT sum(t.selected_cnt) FROM sub t WHERE t.is_pb = false) AS selected_avg_cnt,
		0 AS need_cnt,
		(SELECT ROUND(AVG(t.ok)) FROM sub t),
		(SELECT ROUND(AVG(t.p7)) FROM sub t),
		(SELECT ROUND(AVG(t.p28)) FROM sub t),
		
		(SELECT SUM(t.selected_cnt) FROM sub2 t WHERE t.is_pb=FALSE),
		(SELECT ROUND(AVG(t.ok)) FROM sub2 t),
		(SELECT ROUND(AVG(t.p7)) FROM sub2 t),
		(SELECT ROUND(AVG(t.p28)) FROM sub2 t)
		
	)
	;		

ALTER TABLE lab_entry_30days_2 OWNER TO beton;
 