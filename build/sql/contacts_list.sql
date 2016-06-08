-- View: contacts_list

--DROP VIEW contacts_list;

CREATE OR REPLACE VIEW contacts_list AS 
	SELECT
		ct.id,
		ct.post,
		ct.last_name,
		ct.first_name,
		ct.middle_name,
		coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'')||' '||coalesce(ct.middle_name,'') AS name,
		ct.description,
		
		ct_tel.name AS tel_name,
		ct_tel.value AS tel_value,
		
		ct_mail.name AS email_name,
		ct_mail.value AS email_value
		
	FROM contacts ct
	LEFT JOIN (
		SELECT
			ccd.contact_id,
			cd.name,
			cd.value
		FROM contact_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
	) AS ct_tel ON ct_tel.contact_id=ct.id
	
	--email
	LEFT JOIN (
		SELECT
			ccd.contact_id,
			cd.name,
			cd.value
		FROM contact_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
	) AS ct_mail ON ct_mail.contact_id=ct.id
	
	ORDER BY coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'');

ALTER TABLE contacts_list OWNER TO beton;
