-- Function: raw_material_procur_rates_process()

-- DROP FUNCTION raw_material_procur_rates_process();

CREATE OR REPLACE FUNCTION raw_material_procur_rates_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_rate numeric;
BEGIN
	IF (TG_WHEN='BEFORE' AND TG_OP='INSERT') THEN
		--проверка
		SELECT sum(t.rate)
		INTO v_rate
		FROM raw_material_procur_rates t
		WHERE t.material_id=NEW.material_id;
		
		IF v_rate>=1 THEN
			RAISE 'Доля уже равна 1';
		END IF;
		
		RETURN NEW;
	ELSIF (TG_WHEN='BEFORE' AND TG_OP='UPDATE') THEN
		--проверка
		SELECT sum(t.rate)
		INTO v_rate
		FROM raw_material_procur_rates t
		WHERE t.material_id=NEW.material_id;
		--RAISE '%,%,%',v_rate,OLD.rate,NEW.rate;
		IF ((v_rate-OLD.rate+NEW.rate)>1) THEN
			RAISE 'Не верное значение доли (доля<=1)';
		END IF;
		
		RETURN NEW;
		
	ELSIF TG_WHEN='AFTER' AND TG_OP='INSERT' THEN
		UPDATE raw_materials
		SET order_start=now()::date
		WHERE id=NEW.material_id;
		
		RETURN NEW;
	ELSIF TG_WHEN='AFTER' AND TG_OP='UPDATE' THEN
		IF (OLD.rate<>NEW.rate)
		OR (OLD.supplier_id<>NEW.supplier_id) THEN
			UPDATE raw_materials
			SET order_start=now()::date
			WHERE raw_materials.id=NEW.material_id;
		END IF;
		
		RETURN NEW;
	ELSIF TG_WHEN='AFTER' AND TG_OP='DELETE' THEN
		UPDATE raw_materials
		SET order_start=now()::date
		WHERE id=OLD.material_id;
	
		RETURN OLD;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION raw_material_procur_rates_process()
  OWNER TO beton;
