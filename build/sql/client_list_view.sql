-- View: client_list_view

--DROP VIEW client_list_view;

CREATE OR REPLACE VIEW client_list_view AS 
	SELECT
		cl.id,
		cl.name,
		cl.manager_comment,
		cl.client_type_id,
		ct.name AS client_type_descr,
		cl.client_come_from_id,
		ccf.name AS client_come_from_descr,		
		
		cl.client_kind,
		
		cl.manager_id,
		man.name AS manager_descr,

		ct_tel.name AS tel_name,
		ct_tel.value AS tel_value,
		
		ct_mail.name AS email_name,
		ct_mail.value AS email_value		
		
	FROM clients AS cl
	LEFT JOIN client_types AS ct ON ct.id=cl.client_type_id
	LEFT JOIN client_come_from AS ccf ON ccf.id=cl.client_come_from_id
	LEFT JOIN users AS man ON man.id=cl.manager_id

	--main tel
	LEFT JOIN (
		SELECT
			ccd.client_id,
			cd.name,
			cd.value
		FROM client_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
	) AS ct_tel ON ct_tel.client_id=cl.id
	
	--email
	LEFT JOIN (
		SELECT
			ccd.client_id,
			cd.name,
			cd.value
		FROM client_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
	) AS ct_mail ON ct_mail.client_id=cl.id
	
	ORDER BY cl.name;

ALTER TABLE client_list_view
  OWNER TO beton;
  
