-- View: stone_quarry_vals_list

DROP VIEW stone_quarry_vals_list;

CREATE OR REPLACE VIEW stone_quarry_vals_list AS 
	SELECT
		l.*,
		q.name AS quarry_descr,
		date8_descr(l.day) AS day_descr
	FROM stone_quarry_vals AS l
	LEFT JOIN quarries q ON q.id = l.quarry_id
	ORDER BY l.day;

ALTER TABLE stone_quarry_vals_list
  OWNER TO beton;
