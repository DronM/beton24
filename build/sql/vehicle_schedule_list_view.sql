-- View: vehicle_schedule_list_view

DROP VIEW vehicle_schedule_list_view;

CREATE OR REPLACE VIEW vehicle_schedule_list_view AS 
 SELECT
	vs.id,
	vs.schedule_date,
	vs.driver_id,
	d.name AS vh_driver_descr,

	ct_tel.name AS vh_driver_tel_name,
	ct_tel.value AS vh_driver_tel_value,
	
	ct_mail.name AS vh_driver_email_name,
	ct_mail.value AS vh_driver_email_value,
	
	vcl.id AS vh_owner_id,
	vcl.name AS vh_owner_descr,
	vs.vehicle_id,
	v.plate AS vh_plate,
	st.state,
	v.load_capacity,
	oc.comment_text AS out_comment,
	 
	(SELECT true AS bool
	FROM vehicle_schedule_states st
	WHERE st.schedule_id = vs.id AND st.state = 'shift'::vehicle_states
	LIMIT 1
	) AS on_shift
	
	FROM vehicle_schedules vs
	LEFT JOIN drivers d ON d.id = vs.driver_id
	LEFT JOIN vehicles v ON v.id = vs.vehicle_id
	LEFT JOIN clients vcl ON vcl.id = v.client_id
	LEFT JOIN vehicle_schedule_states st ON st.schedule_id = vs.id AND st.date_time =
		(SELECT max(vehicle_schedule_states.date_time) AS max
		FROM vehicle_schedule_states
		WHERE vehicle_schedule_states.schedule_id = vs.id
		)	
	LEFT JOIN out_comments oc ON oc.vehicle_schedule_id = vs.id

	--main tel
	LEFT JOIN (
		SELECT
			ccd.driver_id,
			cd.name,
			cd.value
		FROM driver_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='tel'::contact_types
	) AS ct_tel ON ct_tel.driver_id=d.id
	
	--email
	LEFT JOIN (
		SELECT
			ccd.driver_id,
			cd.name,
			cd.value
		FROM driver_contact_details AS ccd
		LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
		WHERE ccd.main=TRUE AND cd.contact_type='email'::contact_types
	) AS ct_mail ON ct_mail.driver_id=d.id
	
	ORDER BY 
		CASE
			WHEN ( SELECT true AS bool
			   FROM vehicle_schedule_states st
			  WHERE st.schedule_id = vs.id AND st.state = 'shift'::vehicle_states
			 LIMIT 1) THEN 1
			ELSE 0
		END, st.date_time;
ALTER TABLE vehicle_schedule_list_view
  OWNER TO beton;
