-- Function: mat_obnul_correct_quant(date, integer, numeric)

-- DROP FUNCTION mat_obnul_correct_quant(date, integer, numeric);

CREATE OR REPLACE FUNCTION mat_obnul_correct_quant(in_date date, in_material_id integer, in_quant numeric)
  RETURNS void AS
$BODY$
BEGIN
	
	IF in_quant=0 THEN	
		DELETE FROM materials_obnuls
		WHERE day = in_date
			AND material_id=in_material_id;
	ELSE
		--ra_material_consumption
		UPDATE materials_obnuls
		SET quant = in_quant
		WHERE day = in_date
			AND material_id=in_material_id;
		--RAISE '%',in_quant;
		IF NOT FOUND THEN
			BEGIN
				INSERT INTO materials_obnuls
				(day, material_id,quant)
				VALUES
				(in_date,in_material_id,in_quant);
			EXCEPTION WHEN OTHERS THEN
				UPDATE materials_obnuls
				SET quant = in_quant
				WHERE day = in_date
					AND material_id=in_material_id;
			END;	
		END IF;
	END IF;
    RETURN;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION mat_obnul_correct_quant(date, integer, numeric)
  OWNER TO beton;
