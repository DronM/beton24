-- Function: raw_material_cons_rates_update(IN in_rate_date_id int, IN in_concrete_type_id int, IN in_raw_material_id int, IN in_rate numeric)

--DROP FUNCTION raw_material_cons_rates_update(IN in_rate_date_id int, IN in_concrete_type_id int, IN in_raw_material_id int, IN in_rate numeric)

CREATE OR REPLACE FUNCTION raw_material_cons_rates_update(IN in_rate_date_id int, IN in_concrete_type_id int, IN in_raw_material_id int, IN in_rate numeric) RETURNS void as $$
BEGIN
	UPDATE raw_material_cons_rates
		SET rate = in_rate
	WHERE rate_date_id=in_rate_date_id AND concrete_type_id=in_concrete_type_id AND raw_material_id=in_raw_material_id;
	
	IF FOUND THEN
		RETURN;
	END IF;
	BEGIN
		INSERT INTO raw_material_cons_rates (rate_date_id, concrete_type_id, raw_material_id, rate)
		VALUES (in_rate_date_id, in_concrete_type_id, in_raw_material_id, in_rate);
	EXCEPTION WHEN OTHERS THEN
		UPDATE raw_material_cons_rates
			SET rate = in_rate
		WHERE rate_date_id=in_rate_date_id AND concrete_type_id=in_concrete_type_id AND raw_material_id=in_raw_material_id;
		END;
	RETURN;
END;
$$ language plpgsql;

ALTER FUNCTION raw_material_cons_rates_update(IN in_rate_date_id int, IN in_concrete_type_id int, IN in_raw_material_id int, IN in_rate numeric)
OWNER TO beton;
