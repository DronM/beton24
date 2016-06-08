-- View: raw_material_procur_upload_view

--DROP VIEW raw_material_consumption_list_view;

CREATE OR REPLACE VIEW raw_material_consumption_list_view AS 
	SELECT 
		ra.id,
		ra.date_time,
		date8_time5_descr(ra.date_time) AS date_time_descr,
		ra.concrete_type_id,	
		concr.name AS concrete_type_descr,
		ra.vehicle_id,
		vh.plate AS vehicle_descr,
		ra.driver_id,
		dr.name AS driver_descr,
		ra.material_id,
		mt.name AS material_descr,
		ROUND(ra.material_quant,0) AS material_quant,
		ROUND(ra.concrete_quant,2) AS concrete_quant
		
	 FROM ra_material_consumption AS ra
	 LEFT JOIN concrete_types AS concr ON concr.id=ra.concrete_type_id
	 LEFT JOIN vehicles AS vh ON vh.id=ra.vehicle_id
	 LEFT JOIN drivers AS dr ON dr.id=ra.driver_id
	 LEFT JOIN raw_materials AS mt ON mt.id=ra.material_id
	 ;

ALTER TABLE raw_material_consumption_list_view OWNER TO beton;

