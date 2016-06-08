-- Function: doc_material_procurements_process()

-- DROP FUNCTION raw_materials_cons_rates_dates_process();

CREATE OR REPLACE FUNCTION raw_materials_cons_rates_dates_process()
  RETURNS trigger AS
$BODY$
BEGIN
	IF (TG_WHEN='BEFORE' AND TG_OP='DELETE') THEN
		DELETE FROM raw_material_cons_rates
		WHERE rate_date_id=OLD.id;
		RETURN NEW;
	END IF;	
END;
$BODY$
LANGUAGE plpgsql VOLATILE
COST 100;
ALTER FUNCTION raw_materials_cons_rates_dates_process()
  OWNER TO beton;
