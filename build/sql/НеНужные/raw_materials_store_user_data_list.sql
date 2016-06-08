-- View: raw_material_procur_upload_view

--DROP VIEW raw_materials_store_user_data_list;

CREATE OR REPLACE VIEW raw_materials_store_user_data_list AS 
	SELECT 
		l.material_id,
		m.name AS material_descr,
		l.quant
	 FROM raw_materials_store_user_data AS l
	 LEFT JOIN raw_materials AS m ON m.id=l.material_id
	 ;

ALTER TABLE raw_materials_store_user_data_list OWNER TO beton;

