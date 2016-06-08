-- Function: orders_for_operator_queue_move(shipment_id int,dir int)

--DROP FUNCTION orders_for_operator_queue_move(shipment_id int,dir int);

CREATE OR REPLACE FUNCTION orders_for_operator_queue_move(shipment_id int,dir int)
  RETURNS VOID AS
$BODY$
DECLARE
	shipment_to_swap_id int;
	shipment_to_swap_dt timestampTZ;
	shipment_dt timestampTZ;
	v_shipment_on_load_id int;
BEGIN
	SELECT coalesce(t.shipment_id,0) INTO v_shipment_on_load_id FROM shipment_on_load t LIMIT 1;
	
	SELECT
		coalesce(
			--Либо из очереди
			(SELECT t.date_time FROM order_for_operator_queue t
			WHERE t.shipment_id=$1),
			
			--Либо из отгрузок
			(SELECT t.date_time FROM shipments t
			WHERE t.id=$1)
		)
	INTO shipment_dt;

	SELECT
		--Отгрузка для замены
		coalesce(
			--Либо пред. из очереди
			(CASE
			WHEN $2 = -1 THEN
				(SELECT t.shipment_id
				FROM order_for_operator_queue t
				WHERE t.date_time<shipment_dt
					AND get_shift_start(t.date_time)=get_shift_start(shipment_dt)
					--AND t.shipment_id<>v_shipment_on_load_id
				ORDER BY t.date_time DESC
				LIMIT 1)
			ELSE
				(SELECT t.shipment_id
				FROM order_for_operator_queue t
				WHERE t.date_time>shipment_dt
					AND get_shift_start(t.date_time)=get_shift_start(shipment_dt)
					--AND t.shipment_id<>v_shipment_on_load_id
				ORDER BY t.date_time ASC
				LIMIT 1)			
			END),
			
			--Либо пред. из отгрузок
			(CASE
			WHEN $2 = -1 THEN
				(SELECT t.id
				FROM shipments t
				WHERE t.date_time<shipment_dt
					AND get_shift_start(t.date_time)=get_shift_start(shipment_dt)
					--AND t.id<>v_shipment_on_load_id
				ORDER BY t.date_time DESC
				LIMIT 1)
			ELSE
				(SELECT t.id
				FROM shipments t
				WHERE t.date_time>shipment_dt
					AND get_shift_start(t.date_time)=get_shift_start(shipment_dt)
					--AND t.id<>v_shipment_on_load_id
				ORDER BY t.date_time ASC
				LIMIT 1)			
			END)
		)
	INTO shipment_to_swap_id;

	--дата из отгрузки для замены
	SELECT
		coalesce(
			--Либо из очереди
			(SELECT t.date_time FROM order_for_operator_queue t
			WHERE t.shipment_id=shipment_to_swap_id),
			
			--Либо из отгрузок
			(SELECT t.date_time FROM shipments t
			WHERE t.id=shipment_to_swap_id)
		)
	INTO shipment_to_swap_dt;
	/*
		RAISE 'shipment_dt=%,shipment_to_swap_id=%,shipment_to_swap_dt=%',
		shipment_dt,shipment_to_swap_id,shipment_to_swap_dt;
	*/
	
	--Собственно замена
	IF shipment_to_swap_id IS NOT NULL THEN
		
		--текущая отгрузка
		UPDATE order_for_operator_queue t
			SET date_time = shipment_to_swap_dt
		WHERE t.shipment_id = $1;
		
		IF NOT FOUND THEN
			INSERT INTO order_for_operator_queue
			(shipment_id,date_time)	
			VALUES ($1,shipment_to_swap_dt);
		END IF;
		
		--отгрузка - замена
		UPDATE order_for_operator_queue t
			SET date_time = shipment_dt
		WHERE t.shipment_id = shipment_to_swap_id;
		
		IF NOT FOUND THEN
			INSERT INTO order_for_operator_queue
			(shipment_id,date_time)	
			VALUES (shipment_to_swap_id,shipment_dt);
		END IF;
	END IF;
END;	
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION orders_for_operator_queue_move(shipment_id int,dir int)
  OWNER TO beton;
