-- View: doc_material_inventories_list_view

--DROP VIEW doc_material_inventories_list_view;

CREATE OR REPLACE VIEW doc_material_inventories_list_view AS 
	 SELECT doc.id, doc.number, doc.date_time, 
	    date8_time8_descr(doc.date_time) AS date_time_descr, doc.processed
	   FROM doc_material_inventories doc
	  ORDER BY doc.date_time;
	
ALTER TABLE doc_material_inventories_list_view OWNER TO beton;

