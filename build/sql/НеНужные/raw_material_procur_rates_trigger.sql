-- Trigger: raw_material_procur_rates_after on ra_materials

-- DROP TRIGGER raw_material_procur_rates_after ON raw_material_procur_rates;

CREATE TRIGGER raw_material_procur_rates_after
  AFTER INSERT OR UPDATE OR DELETE
  ON raw_material_procur_rates
  FOR EACH ROW
  EXECUTE PROCEDURE raw_material_procur_rates_process();

  
CREATE TRIGGER raw_material_procur_rates_before
  BEFORE INSERT OR UPDATE
  ON raw_material_procur_rates
  FOR EACH ROW
  EXECUTE PROCEDURE raw_material_procur_rates_process();
  