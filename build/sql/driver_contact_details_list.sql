-- View: driver_contact_details_list

--DROP VIEW driver_contact_details_list;

CREATE OR REPLACE VIEW driver_contact_details_list AS 
	SELECT
		ccd.driver_id,
		ccd.contact_detail_id,
		ccd.main,
		cd.contact_type AS contact_detail_type,
		cd.name AS contact_detail_name,
		cd.value AS contact_detail_value
	FROM driver_contact_details ccd
	LEFT JOIN contact_details AS cd ON cd.id=ccd.contact_detail_id
	ORDER BY ccd.driver_id,ccd.contact_detail_id;

ALTER TABLE driver_contact_details_list OWNER TO beton;
