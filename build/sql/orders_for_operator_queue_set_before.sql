-- Function: orders_for_operator_queue_set_before(shipment_id int,after_shipment_id int)

-- DROP FUNCTION orders_for_operator_queue_set_before(shipment_id int,after_shipment_id int);

CREATE OR REPLACE FUNCTION orders_for_operator_queue_set_before(shipment_id int,after_shipment_id int)
  RETURNS void AS
$$
DECLARE
	shipment_dt timestampTZ;
	after_shipment_dt timestampTZ;
	before_shipment_dt timestampTZ;
	new_shipment_dt timestampTZ;
	
	shift_start timestampTZ;
	shift_end timestampTZ;
BEGIN
	--дата-время исходной отгрузки
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

	--начало смены
	shift_start = get_shift_start(shipment_dt);
	
	--конец смены
	shift_end = get_shift_end(get_shift_start(shipment_dt));

	--дата-время отгрузки перед которой надо вставить
	IF (after_shipment_id IS NULL OR after_shipment_id=0) THEN
		SELECT shift_end INTO after_shipment_dt;
	ELSE
		SELECT
			coalesce(
				--Либо из очереди
				(SELECT t.date_time FROM order_for_operator_queue t
				WHERE t.shipment_id=$2),
			
				--Либо из отгрузок
				(SELECT t.date_time FROM shipments t
				WHERE t.id=$2)
			)
		INTO after_shipment_dt;
	END IF;
	
	/*дата-время отгрузки ПЕРЕД перед которой надо вставить
	т.е. наша вставка будет между after_shipment_dt и before_shipment_dt
	*/
	SELECT
		coalesce(
			coalesce(
				--Либо из очереди
				(SELECT t.date_time FROM order_for_operator_queue t
				WHERE t.date_time<after_shipment_dt
					AND t.date_time BETWEEN shift_start AND shift_end
				ORDER BY t.date_time DESC
				LIMIT 1),
		
				--Либо из отгрузок
				(SELECT t.date_time FROM shipments t
				WHERE t.date_time<after_shipment_dt
					AND t.date_time BETWEEN shift_start AND shift_end
				ORDER BY t.date_time DESC
				LIMIT 1)
			),
			--либо начало смены, если ставим первой
			shift_start
		)
	INTO before_shipment_dt;
	--RAISE 'after_shipment_dt=%, before_shipment_dt=%',after_shipment_dt,before_shipment_dt;
	
	--дата время нашей вставки
	SELECT shift_start + (after_shipment_dt - before_shipment_dt)/2 INTO new_shipment_dt;
--	RAISE 'new_shipment_dt=%',new_shipment_dt;
	
	--вставка
	UPDATE order_for_operator_queue t
		SET date_time = new_shipment_dt
	WHERE t.shipment_id = $1;
	
	IF NOT FOUND THEN
		INSERT INTO order_for_operator_queue
		(shipment_id,date_time)	
		VALUES ($1,new_shipment_dt);
	END IF;
	
END;
$$
  LANGUAGE plpgsql VOLATILE
  COST 100 CALLED ON NULL INPUT;
ALTER FUNCTION orders_for_operator_queue_set_before(shipment_id int,after_shipment_id int) OWNER TO beton;
