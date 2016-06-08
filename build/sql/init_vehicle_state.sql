-- Function: init_vehicle_state()

-- DROP FUNCTION init_vehicle_state();

CREATE OR REPLACE FUNCTION init_vehicle_state()
  RETURNS trigger AS
$BODY$
BEGIN
	INSERT INTO vehicle_schedule_states (
		date_time,state,
		schedule_id,
		tracker_id)
	VALUES (
		NEW.schedule_date + const_shift_start_val(),
		CASE			
			WHEN NEW.auto_gen THEN 'shift'::vehicle_states
			WHEN NEW.auto_gen=false
				AND get_shift_start(now())=get_shift_start(NEW.schedule_date + const_shift_start_val()) THEN
				'free'::vehicle_states
			ELSE 'shift_added'::vehicle_states
		END,
		NEW.id,
		vehicle_tracker_id_on_schedule_id(NEW.id)
	);
	RETURN NEW;
END;	
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION init_vehicle_state()
  OWNER TO beton;

