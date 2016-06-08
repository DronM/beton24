-- Function: order_history(order_id int)

--DROP FUNCTION order_history(int);

CREATE OR REPLACE FUNCTION order_history(order_id int)
  RETURNS TABLE(
	date_time timestampTZ,
	user_id int,
	user_descr text,
	order_event text
  ) AS
$BODY$
	SELECT
		h.date_time,
		h.user_id,
		u.name::text AS user_descr,
		h.order_event
	FROM
	(
		(SELECT
			vss.date_time::timestampTZ,
			vss.user_id,
			vss.state::text AS order_event
		FROM vehicle_schedule_states AS vss
		WHERE vss.shipment_id IN (
			SELECT sh.id
			FROM shipments sh
			WHERE sh.order_id=$1
			)
		)
		
		UNION ALL
	
		(SELECT
			olog.date_time,
			olog.user_id,
			olog.order_event::text AS order_event
		FROM order_log AS olog
		WHERE olog.order_id=$1	
		)
	) AS h
	LEFT JOIN users AS u ON u.id=h.user_id
	ORDER BY h.date_time;
$BODY$
  LANGUAGE sql VOLATILE COST 100;
ALTER FUNCTION order_history(order_id int)
  OWNER TO beton;
