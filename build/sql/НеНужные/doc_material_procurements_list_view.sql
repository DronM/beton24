-- View: doc_material_procurements_list_view

--DROP VIEW doc_material_procurements_list_view;

CREATE OR REPLACE VIEW doc_material_procurements_list_view AS 
	 SELECT doc.id, doc.number, doc.date_time, 
	    date8_time8_descr(doc.date_time) AS date_time_descr, doc.processed, 
	    doc.supplier_id, sup.name AS supplier_descr,
	    doc.carrier_id, car.name AS carrier_descr, 
	    doc.material_id, mat.name AS material_descr, 
	    doc.driver,doc.vehicle_plate,
	    doc.quant_gross,doc.quant_net
	   FROM doc_material_procurements doc
	   LEFT JOIN suppliers sup ON sup.id = doc.supplier_id
	   LEFT JOIN suppliers car ON car.id = doc.carrier_id
	   LEFT JOIN raw_materials mat ON mat.id = doc.material_id
	  ORDER BY doc.date_time;	
ALTER TABLE doc_material_procurements_list_view OWNER TO beton;

