-- View: pump_vehicles_list

DROP VIEW pump_vehicles_list;

CREATE OR REPLACE VIEW pump_vehicles_list AS 
	SELECT
		pv.id,		
		pv.pump_price_id,		
		ppr.name AS pump_price_descr,
		
		pv.unload_type,
		
		pv.vehicle_id AS vh_id,
		v.plate AS vh_plate,
		
		v.client_id AS vh_owner_id,
		vcl.name AS vh_owner_descr,
		
		owner_tel.name AS vh_owner_tel_name,
		owner_tel.value AS vh_owner_tel_value,
	
		owner_mail.name AS vh_owner_email_name,
		owner_mail.value AS vh_owner_email_value,
		
		dr_tel.name AS vh_driver_tel_name,
		dr_tel.value AS vh_driver_tel_value,
	
		dr_mail.name AS vh_driver_email_name,
		dr_mail.value AS vh_driver_email_value
		
		
	FROM pump_vehicles AS pv
	LEFT JOIN vehicles v ON v.id = pv.vehicle_id
	LEFT JOIN clients cl ON cl.id = v.client_id
	LEFT JOIN vehicle_makes vm ON vm.id = v.vehicle_make_id
	LEFT JOIN pump_prices ppr ON ppr.id = pv.pump_price_id
	LEFT JOIN clients vcl ON vcl.id = v.client_id
	LEFT JOIN drivers dr ON dr.id = v.driver_id
	
	--main tel
	LEFT JOIN (
		SELECT
			ccd.driver_id,
			cd.name,
			cd.value
		FROM driver_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
	) AS dr_tel ON dr_tel.driver_id=dr.id
	
	--email
	LEFT JOIN (
		SELECT
			ccd.driver_id,
			cd.name,
			cd.value
		FROM driver_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
	) AS dr_mail ON dr_mail.driver_id=dr.id

	--main owner tel
	LEFT JOIN (
		SELECT
			ccd.client_id,
			cd.name,
			cd.value
		FROM client_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
	) AS owner_tel ON owner_tel.client_id=vcl.id
	
	--main owner email
	LEFT JOIN (
		SELECT
			ccd.client_id,
			cd.name,
			cd.value
		FROM client_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
	) AS owner_mail ON owner_mail.client_id=vcl.id
	
	ORDER BY v.plate;

ALTER TABLE pump_vehicles_list
  OWNER TO beton;
