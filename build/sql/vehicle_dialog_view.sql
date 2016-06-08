-- View: vehicle_dialog_view

--DROP VIEW vehicle_dialog_view;

CREATE OR REPLACE VIEW vehicle_dialog_view AS 
	SELECT v.id,
		v.plate,
		v.load_capacity,
		
		v.driver_id,
		dr.name AS driver_descr,
		
		v.client_id AS client_id,
		cl.name AS client_descr,

		v.vehicle_make_id,
		vm.name AS vehicle_make_descr,

		v.vehicle_feature_id,
		vf.name AS vehicle_feature_descr,
		
		v.tracker_id,
		
		CASE
			WHEN v.tracker_id IS NULL OR v.tracker_id='' THEN NULL
			ELSE
				(SELECT 
					tr.received_dt
				FROM car_tracking tr
				WHERE tr.car_id = v.tracker_id
				ORDER BY tr.period DESC
				LIMIT 1
				)
		END AS tracker_last_data,
		
		ct_tel.name AS tel_name,
		ct_tel.value AS tel_value,
	
		ct_mail.name AS email_name,
		ct_mail.value AS email_value,
		
		pv.unload_type AS pump_vehicle_unload_type
		
		
	FROM vehicles v
	LEFT JOIN drivers dr ON dr.id = v.driver_id
	LEFT JOIN clients cl ON cl.id = v.client_id
	LEFT JOIN vehicle_features vf ON vf.id = v.vehicle_feature_id
	LEFT JOIN vehicle_makes vm ON vm.id = v.vehicle_make_id
	LEFT JOIN pump_vehicles pv ON pv.vehicle_id = v.id
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
	
	;

ALTER TABLE vehicle_dialog_view
  OWNER TO beton;
