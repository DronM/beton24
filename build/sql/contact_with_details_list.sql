-- View: contact_with_details_list

--DROP VIEW contact_with_details_list;

CREATE OR REPLACE VIEW contact_with_details_list AS 
	SELECT
		ct.id,
		ct.post,
		ct.last_name,
		ct.first_name,
		ct.middle_name,
		coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'')||' '||coalesce(ct.middle_name,'') AS name,
		ct.description,
		
		ccd.main,
		cd.name AS contact_detail_name,
		cd.value AS contact_detail_value,
		cd.contact_type AS contact_detail_type
		
	FROM contacts ct
	LEFT JOIN contact_contact_details ccd ON ccd.contact_id=ct.id
	LEFT JOIN contact_details cd ON cd.id=ccd.contact_detail_id
	ORDER BY coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'');

ALTER TABLE contact_with_details_list OWNER TO beton;
