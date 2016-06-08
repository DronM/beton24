-- View: raw_material_procur_upload_view

DROP VIEW raw_material_procur_upload_view;

CREATE OR REPLACE VIEW raw_material_procur_upload_view AS 
	SELECT 
		date_time,
		date8_time5_descr(date_time) AS date_time_descr,
		result
	 FROM raw_material_procur_uploads;

ALTER TABLE raw_material_procur_upload_view OWNER TO beton;

