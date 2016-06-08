-- Function: employee_work_time_sched_hour_set(int,date,integer)

--DROP FUNCTION employee_work_time_sched_hour_set(int,date,integer)

CREATE OR REPLACE FUNCTION employee_work_time_sched_hour_set(
	in_employee_id int,
	in_day date,
	in_hours integer)
RETURNS void as $$
BEGIN
	IF in_hours IS NULL THEN
		DELETE FROM employee_work_time_schedules
		WHERE employee_id = in_employee_id
			AND day=in_day;	
	ELSE
		UPDATE employee_work_time_schedules
		SET hours = in_hours
		WHERE employee_id = in_employee_id
			AND day=in_day;
		
		IF NOT FOUND THEN
			BEGIN
				INSERT INTO employee_work_time_schedules
				(employee_id, day,hours)
				VALUES
				(in_employee_id,in_day,in_hours);
			EXCEPTION WHEN OTHERS THEN
				UPDATE employee_work_time_schedules
				SET hours = in_hours
				WHERE employee_id = in_employee_id
					AND day=in_day;
			END;	
		END IF;	
	END IF;	
END;	
$$ language plpgsql CALLED ON NULL INPUT;

ALTER FUNCTION employee_work_time_sched_hour_set(int,date,integer)
  OWNER TO beton;

