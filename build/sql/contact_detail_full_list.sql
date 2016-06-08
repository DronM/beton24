-- View: contact_detail_full_list

--DROP VIEW contact_detail_full_list;

CREATE OR REPLACE VIEW contact_detail_full_list AS 
	SELECT
		'contact'::text AS head_type,
		cct.contact_id,
		NULL AS client_id,
		cct.contact_detail_id,
		coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'')||' '||coalesce(ct.middle_name,'') AS name,
		
		ct.last_name,
		ct.first_name,
		ct.middle_name,
		
		cdt.contact_type AS contact_detail_type,
		cdt.name AS contact_detail_name,
		cdt.value AS contact_detail_value,
		ct.description AS comment
	FROM contact_contact_details cct
	LEFT JOIN contacts AS ct ON ct.id=cct.contact_id
	LEFT JOIN contact_details AS cdt ON cdt.id=cct.contact_detail_id
	
	UNION ALL

	SELECT
		'client'::text AS head_type,
		NULL AS contact_id,
		clct.client_id,
		clct.contact_detail_id,
		cl.name::text AS name,
		
		'' AS last_name,
		cl.name::text first_name,
		'' AS middle_name,
		
		cdt.contact_type AS contact_detail_type,
		cdt.name AS contact_detail_name,
		cdt.value AS contact_detail_value,
		'Не знаю что сюда впихнуть'::text AS comment
	FROM client_contact_details clct	
	LEFT JOIN clients AS cl ON cl.id=clct.client_id
	LEFT JOIN contact_details AS cdt ON cdt.id=clct.contact_detail_id
	
	ORDER BY name;

ALTER TABLE contact_detail_full_list OWNER TO beton;
