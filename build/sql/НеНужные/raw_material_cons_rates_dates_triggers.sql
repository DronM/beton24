-- Trigger: raw_materials_cons_rates_dates_trigger on raw_materials_cons_rates_dates

-- DROP TRIGGER raw_materials_cons_rates_dates_trigger ON raw_materials_cons_rates_dates;

CREATE TRIGGER raw_materials_cons_rates_dates_trigger
  BEFORE DELETE
  ON raw_materials_cons_rates_dates
  FOR EACH ROW
  EXECUTE PROCEDURE raw_materials_cons_rates_dates_process();
