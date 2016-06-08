CREATE OR REPLACE FUNCTION raw_material_min_quant_set(in_week_day date, IN in_material_id int, IN in_quant numeric)
  RETURNS void AS
$BODY$
DECLARE
	v_week_day date;
BEGIN
	v_week_day=(in_week_day-(EXTRACT(DOW FROM in_week_day)-1||' days')::interval)::date;
	IF in_quant=0 THEN
		DELETE FROM raw_material_min_quants WHERE week_day = v_week_day AND material_id=in_material_id;
	ELSE
		UPDATE raw_material_min_quants SET quant = in_quant WHERE week_day = v_week_day AND material_id=in_material_id;
		IF NOT FOUND THEN
			BEGIN
				INSERT INTO raw_material_min_quants (week_day,material_id,quant)
				VALUES (v_week_day,in_material_id,in_quant);
			EXCEPTION WHEN OTHERS THEN
				UPDATE raw_material_min_quants SET quant = in_quant WHERE week_day = v_week_day AND material_id=in_material_id;
			END;
		END IF;
	END IF;
	
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION raw_material_min_quant_set(date, int, numeric) OWNER TO beton;
