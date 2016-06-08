-- VIEW: drivers_list

--DROP VIEW drivers_list;

CREATE OR REPLACE VIEW drivers_list AS
	SELECT
		dr.id ,
		dr.name,
		
		ct_tel.name AS tel_name,
		ct_tel.value AS tel_value,
	
		ct_mail.name AS email_name,
		ct_mail.value AS email_value
		
	FROM drivers dr
	
	--main tel
	LEFT JOIN (
		SELECT
			ccd.driver_id,
			cd.name,
			cd.value
		FROM driver_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
	) AS ct_tel ON ct_tel.driver_id=dr.id
	
	--email
	LEFT JOIN (
		SELECT
			ccd.driver_id,
			cd.name,
			cd.value
		FROM driver_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
	) AS ct_mail ON ct_mail.driver_id=dr.id
	
	ORDER BY dr.name
	;
	
ALTER VIEW drivers_list OWNER TO beton;
