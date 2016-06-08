-- View: efficiency_view

--DROP VIEW efficiency_view;

CREATE OR REPLACE VIEW efficiency_view AS 
	SELECT
		SUM(
			(SELECT COALESCE(SUM(shipments.quant::numeric),0)
			FROM shipments
			WHERE shipments.order_id = o.id
				AND shipments.ship_date_time < now()::timestamp without time zone
			)
		) AS quant_shipped_before_now,
		SUM(
			CASE
				WHEN now()::timestamp without time zone > o.date_time AND now()::timestamp without time zone < o.date_time_to THEN
					round(
						(o.quant / (date_part('epoch'::text, o.date_time_to - o.date_time) / 60::double precision) * (date_part('epoch'::text, now()::timestamp without time zone::timestamp with time zone - o.date_time::timestamp with time zone) / 60::double precision))::numeric
					, 2)::numeric
				WHEN now()::timestamp without time zone > o.date_time_to THEN o.quant
				ELSE 0
			END::numeric
		) AS quant_ordered_before_now
	FROM orders AS o
	WHERE o.date_time BETWEEN 
		get_shift_start(now()::timestamp)
		AND get_shift_end(get_shift_start(now()::timestamp))
	;
ALTER TABLE efficiency_view OWNER TO beton;
