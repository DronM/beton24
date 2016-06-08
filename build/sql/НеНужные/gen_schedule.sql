-- Function: gen_schedule(integer, timestamp without time zone, timestamp without time zone, boolean, boolean, boolean, boolean, boolean, boolean, boolean)

-- DROP FUNCTION gen_schedule(integer, timestamp without time zone, timestamp without time zone, boolean, boolean, boolean, boolean, boolean, boolean, boolean);

CREATE OR REPLACE FUNCTION gen_schedule(integer, timestamp without time zone, timestamp without time zone, boolean, boolean, boolean, boolean, boolean, boolean, boolean)
  RETURNS void AS
$BODY$
DECLARE
	dt timestamp without time zone;
	day_of_week int;
	query_text text:= '';
	query_num int:=0;
	v_driver_id int;
BEGIN
	DELETE FROM vehicle_schedules WHERE vehicle_id=$1 AND schedule_date BETWEEN $2 AND $3;
	SELECT v.driver_id INTO v_driver_id FROM vehicles AS v WHERE v.id=$1;

	dt = $2;
	WHILE dt <= $3 LOOP
		day_of_week = EXTRACT(DOW FROM dt);
		IF ($4=true AND day_of_week=1)
		OR ($5=true AND day_of_week=2)
		OR ($6=true AND day_of_week=3)
		OR ($7=true AND day_of_week=4)
		OR ($8=true AND day_of_week=5)
		OR ($9=true AND day_of_week=6)
		OR ($10=true AND day_of_week=0) THEN
			IF (query_num>0) THEN
				query_text = query_text || ',';
			END IF;
			--query_text = query_text || format('(%L, %L, (SELECT v.driver_id FROM vehicles AS v WHERE v.id=%L), true)', dt::date, $1, $1);
			query_text = query_text || '(''' || dt::date::text || '''::date, ' || $1::text || ',' || v_driver_id::text || ', true)';
			query_num = query_num + 1;
		END IF;
		dt = dt + interval '1 day';
	END LOOP;

	IF (query_num>0) THEN
		--RAISE EXCEPTION 'INSERT INTO vehicle_schedules (schedule_date,vehicle_id,driver_id,auto_gen) VALUES %',query_text;
		EXECUTE 'INSERT INTO vehicle_schedules (schedule_date,vehicle_id,driver_id,auto_gen) VALUES ' || query_text;
	END IF;
	

END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION gen_schedule(integer, timestamp without time zone, timestamp without time zone, boolean, boolean, boolean, boolean, boolean, boolean, boolean)
  OWNER TO beton;
