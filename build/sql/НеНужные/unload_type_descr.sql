-- Function: order_status(orders)

-- DROP FUNCTION order_status(orders);

CREATE OR REPLACE FUNCTION order_status(orders)
  RETURNS text AS
$BODY$
	SELECT
		CASE
			--не прошло 15 минут
			WHEN (now() - $1.create_date_time)<const_order_awaiting_state_val()
			THEN 'is_awaiting_timeout'
		
			--завершена
			WHEN ($1.quant - COALESCE(
				(SELECT sum(shipments.quant) AS sum
				FROM shipments
				WHERE shipments.order_id = $1.id
					AND shipments.shipped = true),
				0::numeric)
				) = 0::numeric
			THEN 'is_done'

			--опаздывает
			WHEN
				--на сегодня и время прошло
				$1.date_time::date = now()::date
				AND $1.date_time::time > now()::time
								
				AND
				--нет отгрузки
				COALESCE(
				(SELECT sum(shipments.quant) AS sum
				FROM shipments
				WHERE shipments.order_id = $1.id
					AND shipments.shipped = true),
				0::numeric) =0::numeric
				THEN 'is_late'
				
			--опаздывает
			WHEN ($1.quant - COALESCE(
				(SELECT
					sum(shipments.quant) AS sum
				FROM shipments
				WHERE shipments.order_id = $1.id
					AND shipments.shipped
				),0::numeric)
				) > 0::numeric
				AND (now()
					- (
						(SELECT shipments.ship_date_time
						FROM shipments
						WHERE shipments.order_id = $1.id
						AND shipments.shipped
						ORDER BY shipments.ship_date_time DESC
						LIMIT 1)
					)::timestampTZ) > constant_ord_mark_if_no_ship_time()::interval
				THEN 'in_progress_timeout'	
			
			--есть отгрузка
			WHEN ($1.quant - COALESCE(
				(SELECT sum(shipments.quant) AS sum
				FROM shipments
				WHERE shipments.order_id = $1.id
					AND shipments.shipped
				), 0::numeric)
				) > 0::numeric
			THEN 'in_progress'::text
			
			-- все остальное
			ELSE 'is_awaiting'::text
			
		END AS status

$BODY$
  LANGUAGE sql VOLATILE COST 100;
ALTER FUNCTION order_status(orders)
  OWNER TO beton;
