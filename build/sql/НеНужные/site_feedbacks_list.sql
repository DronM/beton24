-- View: site_feedbacks_list

DROP VIEW site_feedbacks_list;

CREATE OR REPLACE VIEW site_feedbacks_list AS 
	SELECT
		t.*,
		date8_time5_descr(t.date_time) AS date_time_descr,
		CASE WHEN t.viewed THEN 'viewed' ELSE '' END AS viewed_descr
	FROM site_feedbacks t
	ORDER BY t.date_time DESC;

ALTER TABLE site_feedbacks_list
  OWNER TO beton;
