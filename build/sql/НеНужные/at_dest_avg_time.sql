-- Function: at_dest_avg_time(timestamp without time zone, timestamp without time zone)

-- DROP FUNCTION at_dest_avg_time(timestamp without time zone, timestamp without time zone);

CREATE OR REPLACE FUNCTION at_dest_avg_time(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone)
  RETURNS TABLE(id integer, name text, avg_time interval, time_route time without time zone) AS
$BODY$
BEGIN
	RETURN QUERY
		SELECT o.destination_id AS id,
		d.name::text AS name,
		AVG(
			(
				SELECT sub_st.date_time - st.date_time
				FROM vehicle_schedule_states AS sub_st
				WHERE
				sub_st.schedule_id=st.schedule_id
				AND sub_st.date_time>st.date_time
				AND sub_st.state = 'left_for_base'::vehicle_states
				ORDER BY sub_st.date_time LIMIT 1
			)
		) AS avg_time,
		d.time_route
		FROM vehicle_schedule_states AS st
		LEFT JOIN shipments AS sh ON sh.id=st.shipment_id
		LEFT JOIN orders AS o ON o.id=sh.order_id
		LEFT JOIN destinations AS d ON d.id=o.destination_id
		WHERE st.date_time BETWEEN in_date_time_from AND in_date_time_to
		AND st.state='at_dest'::vehicle_states
		AND o.destination_id<>constant_self_ship_dest_id()
		GROUP BY o.destination_id,d.name,d.time_route
		ORDER BY d.name;
	
END;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION at_dest_avg_time(timestamp without time zone, timestamp without time zone)
  OWNER TO beton;
