-- Function: schedule_process()

-- DROP FUNCTION schedule_process();

CREATE OR REPLACE FUNCTION schedule_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_plate varchar;
BEGIN
	IF (NEW.driver_id=null OR NEW.driver_id=0) THEN
		SELECT vh.driver_id INTO NEW.driver_id FROM vehicles AS vh WHERE vh.id=NEW.vehicle_id;
	END IF;

	IF (TG_OP='INSERT') THEN
		PERFORM 1 FROM vehicle_schedules WHERE vehicle_id = NEW.vehicle_id AND schedule_date = NEW.schedule_date;
		IF FOUND THEN
			SELECT v.plate INTO v_plate FROM vehicle_schedules AS vs
			LEFT JOIN vehicles AS v ON v.id=vs.vehicle_id
			WHERE vehicle_id = NEW.vehicle_id AND schedule_date = NEW.schedule_date;
			RAISE 'У автомобиля "%" уже есть расписание на %@1005',v_plate,date8_descr(NEW.schedule_date);
		END IF;
	END IF;
	
	RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION schedule_process()
  OWNER TO beton;

