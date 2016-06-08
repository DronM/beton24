-- Function: route_to_dest_avg_time(timestamp without time zone, timestamp without time zone)

--DROP FUNCTION route_to_dest_avg_time(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION route_to_dest_avg_time(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone)
  RETURNS TABLE(
	name text,
	cat_time text,	
	fact_time text,
	deviation numeric,
	run_cnt bigint) AS
$BODY$
	SELECT
		d.name::text,
		time5_descr(d.time_route)::text AS cat_time,
		time5_descr(
		AVG(
			(SELECT sub_st.date_time - st.date_time
			FROM vehicle_schedule_states AS sub_st
			WHERE
			sub_st.schedule_id=st.schedule_id
			AND sub_st.date_time>st.date_time
			AND 
				sub_st.date_time<(
					SELECT next_run.date_time FROM vehicle_schedule_states AS next_run
					WHERE
						next_run.schedule_id=st.schedule_id
					AND next_run.date_time>st.date_time AND next_run.state = 'free'::vehicle_states
					ORDER BY next_run.date_time LIMIT 1
				)
			AND sub_st.state = 'at_dest'::vehicle_states
			ORDER BY sub_st.date_time LIMIT 1
			)
		)::time  
		)::text AS fact_time,
		
		CASE
			WHEN d.time_route IS NULL THEN 0
			ELSE
				100-ROUND((
				EXTRACT(EPOCH FROM d.time_route)/
				-- *****
				EXTRACT(EPOCH FROM
				AVG(
					(SELECT sub_st.date_time - st.date_time
					FROM vehicle_schedule_states AS sub_st
					WHERE
					sub_st.schedule_id=st.schedule_id
					AND sub_st.date_time>st.date_time
					AND 
						sub_st.date_time<(
							SELECT next_run.date_time FROM vehicle_schedule_states AS next_run
							WHERE
								next_run.schedule_id=st.schedule_id
							AND next_run.date_time>st.date_time AND next_run.state = 'free'::vehicle_states
							ORDER BY next_run.date_time LIMIT 1
						)
					AND sub_st.state = 'at_dest'::vehicle_states
					ORDER BY sub_st.date_time LIMIT 1
					)
				)::time  
				)
				-- *****
				*100)::numeric)
		END AS deviation,
		
		COUNT(*) AS run_cnt

	FROM vehicle_schedule_states AS st
	LEFT JOIN shipments AS sh ON sh.id=st.shipment_id
	LEFT JOIN orders AS o ON o.id=sh.order_id
	LEFT JOIN destinations AS d ON d.id=o.destination_id
	WHERE st.date_time BETWEEN in_date_time_from AND in_date_time_to
	AND st.state='busy'::vehicle_states
	AND o.destination_id<>constant_self_ship_dest_id()
	GROUP BY d.name,d.time_route,
		EXTRACT(EPOCH FROM d.time_route)
	ORDER BY d.name;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION route_to_dest_avg_time(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
