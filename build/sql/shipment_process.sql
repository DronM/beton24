-- Function: shipment_process()

-- DROP FUNCTION shipment_process();

CREATE OR REPLACE FUNCTION shipment_process()
  RETURNS trigger AS
$BODY$
DECLARE quant_rest numeric;
	v_vehicle_load_capacity vehicles.load_capacity%TYPE DEFAULT 0;
	v_vehicle_state vehicle_states;
	v_vehicle_plate vehicles.plate%TYPE;
	v_ord_date_time timestamp;
	v_destination_id int;
BEGIN

	IF (TG_WHEN='BEFORE' AND TG_OP='UPDATE' AND OLD.shipped=true) THEN
		--register actions
		PERFORM ra_materials_remove_acts('shipment'::doc_types,NEW.id);
		PERFORM ra_material_consumption_remove_acts('shipment'::doc_types,NEW.id);
	END IF;
	
	--check vehicle state && open shift
	IF (TG_OP='INSERT') THEN
		
		SELECT vehicle_schedule_states.state INTO v_vehicle_state
		FROM vehicle_schedule_states
		WHERE schedule_id=NEW.vehicle_schedule_id
		ORDER BY date_time DESC LIMIT 1;
		
		IF v_vehicle_state != 'free'::vehicle_states THEN
			SELECT v.plate INTO v_vehicle_plate
			FROM vehicle_schedules vs
			LEFT JOIN vehicles v ON v.id=vs.vehicle_id
			WHERE vs.id=NEW.vehicle_schedule_id;
			
			RAISE EXCEPTION 'Автомобиль "%" в статусе "%", должен быть "%"@1000',
			v_vehicle_plate,get_vehicle_states_descr(v_vehicle_state),get_vehicle_states_descr('free'::vehicle_states);
		END IF;
		
		NEW.date_time = now();
	END IF;

	IF (TG_OP='INSERT' OR (TG_OP='UPDATE' AND NEW.shipped=false AND OLD.shipped=false)) THEN
		-- ********** check balance ****************************************
		SELECT o.quant-SUM(COALESCE(s.quant,0)),o.date_time
		INTO quant_rest,v_ord_date_time
		FROM orders AS o
		LEFT JOIN shipments AS s ON s.order_id=o.id	
		WHERE o.id = NEW.order_id
		GROUP BY o.quant,o.date_time;

		--order shift date MUST overlap shipment shift date!		
		IF get_shift_start(NEW.date_time)<>get_shift_start(v_ord_date_time) THEN
			RAISE EXCEPTION 'Заявка из другой смены!@1001';
		END IF;
		

		IF (TG_OP='UPDATE') THEN
			quant_rest:= quant_rest + OLD.quant;
		END IF;
		
		IF (quant_rest<NEW.quant::numeric) THEN
			RAISE EXCEPTION 'Остаток по данной заявке: %, запрошено: %@1003',quant_descr(quant_rest::numeric),quant_descr(NEW.quant::numeric);
		END IF;
		-- ********** check balance ****************************************

		
		-- *********  check load capacity *************************************		
		SELECT
			load_capacity
		INTO v_vehicle_load_capacity
		FROM vehicle_schedules vs
		LEFT JOIN vehicles v on v.id=vs.vehicle_id
		WHERE vs.id=NEW.vehicle_schedule_id;
		IF v_vehicle_load_capacity < NEW.quant THEN
			RAISE EXCEPTION 'Грузоподъемность автомобиля: "%", запрошено: %@1004',quant_descr(v_vehicle_load_capacity::numeric),quant_descr(NEW.quant::numeric);
		END IF;
		-- *********  check load capacity *************************************
	END IF;

	IF TG_OP='UPDATE' THEN
		IF (NEW.shipped AND OLD.shipped=false) THEN
			NEW.ship_date_time = current_timestamp;
		ELSEIF (OLD.shipped AND NEW.shipped=false) THEN
			NEW.ship_date_time = null;
		END IF;
	END IF;
	
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION shipment_process()
  OWNER TO beton;

