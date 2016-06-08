-- View: ra_materials_list_view

-- DROP VIEW ra_materials_list_view;

CREATE OR REPLACE VIEW ra_materials_list_view AS 
	SELECT
		ra_materials.id,
		ra_materials.date_time,
		ra_materials.deb,
		ra_materials.doc_type,
		ra_materials.doc_id, 
        CASE ra_materials.doc_type
            WHEN 'material_procurement'::doc_types THEN
				doc_descr('material_procurement'::doc_types, doc1.number::text, doc1.date_time)
            ELSE NULL::text
        END AS doc_descr
   FROM ra_materials
   LEFT JOIN doc_material_procurements doc1 ON doc1.id = ra_materials.doc_id;

ALTER TABLE ra_materials_list_view
  OWNER TO beton;
