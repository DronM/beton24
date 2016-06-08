-- View: client_with_details_list

--DROP VIEW client_with_details_list;

CREATE OR REPLACE VIEW client_with_details_list AS 
	SELECT
		cl.id,
		cl.name::text,
		
		ccd.main,
		cd.name AS contact_detail_name,
		cd.value AS contact_detail_value,
		cd.contact_type AS contact_detail_type
		
	FROM client_list_view cl
	LEFT JOIN client_contact_details ccd ON ccd.client_id=cl.id
	LEFT JOIN contact_details cd ON cd.id=ccd.contact_detail_id
	ORDER BY cl.name;

ALTER TABLE client_with_details_list OWNER TO beton;
