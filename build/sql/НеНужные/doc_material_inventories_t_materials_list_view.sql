-- View: doc_material_inventories_t_materials_list_view

--DROP VIEW doc_material_inventories_t_materials_list_view;

CREATE OR REPLACE VIEW doc_material_inventories_t_materials_list_view AS 
	 SELECT doc.doc_id,
		doc.line_number,
		doc.material_id AS material_id,
		m.name AS material_descr,
		doc.quant
	   FROM doc_material_inventories_t_materials doc
	LEFT JOIN raw_materials AS m ON m.id=doc.material_id
	ORDER BY doc.line_number;
	
ALTER TABLE doc_material_inventories_t_materials_list_view OWNER TO beton;

