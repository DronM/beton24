-- View: client_contacts_list

DROP VIEW client_contacts_list;

CREATE OR REPLACE VIEW client_contacts_list AS 
	SELECT
		cct.client_id,
		cct.contact_id,
		ct.first_name,
		ct.middle_name,
		ct.last_name,
		--ct.last_name||' '||ct.first_name||' '||ct.middle_name AS name,
		ct.post,
		ct.description,
		cct.main
	FROM client_contacts cct
	LEFT JOIN contacts AS ct ON ct.id=cct.contact_id
	ORDER BY cct.client_id,ct.last_name||' '||ct.first_name;

ALTER TABLE client_contacts_list OWNER TO beton;
