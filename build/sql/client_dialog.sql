-- View client_dialog

--DROP VIEW client_dialog;

CREATE OR REPLACE VIEW client_dialog AS 
	SELECT
		cl.id,
		cl.name,
		cl.name_full,
		cl.manager_comment,
		cl.client_type_id,
		ct.name AS client_type_descr,
		cl.client_come_from_id,
		ccf.name AS client_come_from_descr,		
		
		cl.client_kind,
		
		cl.manager_id,
		u.name AS manager_descr,
		
		main_cont.first_name AS contact_first_name,
		main_cont.middle_name AS contact_middle_name,
		main_cont.last_name As contact_last_name,
		main_cont.post As contact_post,
		main_cont.description AS contact_description,
		
		tel.name AS tel_name,
		tel.value AS tel_value,

		email.name AS email_name,
		email.value AS email_value,
		
		cl.inn,
		cl.kpp,
		cl.orgn,
		cl.okpo,
		cl.address_reg,
		cl.address_fact,
		cl.address_post
		
		
	FROM clients AS cl
	LEFT JOIN client_types AS ct ON ct.id=cl.client_type_id
	LEFT JOIN client_come_from AS ccf ON ccf.id=cl.client_come_from_id
	LEFT JOIN users AS u ON u.id=cl.manager_id
	LEFT JOIN (
		SELECT
			c.id AS contact_id,
			clc.client_id,
			c.first_name,
			c.middle_name,
			c.last_name,
			c.post,
			c.description			
		FROM client_contacts AS clc
		LEFT JOIN contacts AS c ON clc.contact_id=c.id
		WHERE clc.main=TRUE
	) AS main_cont ON main_cont.client_id=cl.id

	LEFT JOIN 
		(SELECT
			t.client_id,
			t2.name,
			t2.value
		FROM client_contact_details t
		LEFT JOIN contact_details AS t2 ON t2.id=t.contact_detail_id
			AND t2.contact_type='tel'::contact_types
		WHERE t.main=TRUE
	) AS tel ON tel.client_id=cl.id

	LEFT JOIN 
		(SELECT
			t.client_id,
			t2.name,
			t2.value
		FROM client_contact_details t
		LEFT JOIN contact_details AS t2 ON t2.id=t.contact_detail_id
			AND t2.contact_type='email'::contact_types
		WHERE t.main=TRUE
	) AS email ON email.client_id=cl.id
	
	;
ALTER TABLE client_dialog
  OWNER TO beton;
  
