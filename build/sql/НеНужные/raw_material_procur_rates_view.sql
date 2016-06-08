-- View: raw_material_procur_rates_view

--DROP VIEW raw_material_procur_rates_view;

CREATE OR REPLACE VIEW raw_material_procur_rates_view AS 
	SELECT 
		r.material_id,m.name::text AS material_descr,
		r.supplier_id,s.name::text AS supplier_descr,
		ROUND(r.rate,2) AS rate
	 FROM raw_material_procur_rates As r
	 LEFT JOIN raw_materials AS m ON m.id=r.material_id
	 LEFT JOIN suppliers AS s ON s.id=r.supplier_id
	 ;

ALTER TABLE raw_material_procur_rates_view OWNER TO beton;
