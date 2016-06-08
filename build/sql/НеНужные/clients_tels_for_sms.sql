-- View: clients_tels_for_sms

--DROP VIEW clients_tels_for_sms;

CREATE OR REPLACE VIEW clients_tels_for_sms AS 
	SELECT
		format_cel_phone_from_str(tel) AS tel
	FROM client_tels
	WHERE tel IS NOT NULL AND tel<>'';
	
ALTER TABLE clients_tels_for_sms
  OWNER TO beton;
