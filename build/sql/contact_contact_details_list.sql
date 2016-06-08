-- View: contact_contact_details_list

DROP VIEW contact_contact_details_list;

CREATE OR REPLACE VIEW contact_contact_details_list AS 
	SELECT
		ccd.contact_id,
		ccd.contact_detail_id,
		ccd.main,
		cd.contact_type AS contact_detail_type,
		cd.name AS contact_detail_name,
		cd.value AS contact_detail_value
	FROM contact_contact_details ccd
	LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
	ORDER BY ccd.contact_id,ccd.contact_detail_id;

ALTER TABLE contact_contact_details_list OWNER TO beton;
