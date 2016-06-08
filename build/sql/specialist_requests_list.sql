-- View: specialist_requests_list

--DROP VIEW specialist_requests_list;

CREATE OR REPLACE VIEW specialist_requests_list AS 
	SELECT
		t.*,
		CASE WHEN t.viewed THEN 'viewed' ELSE '' END AS viewed_descr,
		date8_time8_descr(t.date_time) AS date_time_descr,
		cl.name AS client_descr
	FROM specialist_requests AS t
	LEFT JOIN clients AS cl ON cl.id=t.client_id
	ORDER BY t.date_time DESC
	;
ALTER TABLE specialist_requests_list OWNER TO beton;	
		