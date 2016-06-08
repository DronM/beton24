-- View: raw_material_procur_upload_view

--DROP VIEW client_valid_duplicates_list;

CREATE OR REPLACE VIEW client_valid_duplicates_list AS 
	SELECT 
		t.tel,
		string_agg(cl.name,', ') AS clients
	 FROM client_valid_duplicates AS t
	 LEFT JOIN clients AS cl ON cl.id=t.client_id
	 GROUP BY t.tel
	 ORDER BY t.tel
	 ;

ALTER TABLE client_valid_duplicates_list OWNER TO beton;

