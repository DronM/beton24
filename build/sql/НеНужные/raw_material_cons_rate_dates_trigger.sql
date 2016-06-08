-- Trigger: raw_material_cons_rate_dates_trigger_after on raw_material_cons_rate_dates

-- DROP TRIGGER raw_material_cons_rate_dates_trigger_after ON raw_material_cons_rate_dates;

CREATE TRIGGER raw_material_cons_rate_dates_trigger_after
  AFTER INSERT
  ON raw_material_cons_rate_dates
  FOR EACH ROW
  EXECUTE PROCEDURE raw_material_cons_rate_dates_process();
