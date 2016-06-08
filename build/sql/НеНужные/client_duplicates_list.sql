-- View: client_duplicates_list

--DROP VIEW client_duplicates_list;

CREATE OR REPLACE VIEW client_duplicates_list AS 
	SELECT
		t1.*,
		clients.name AS client_descr,
		oo.q AS quant
	FROM client_tels t1
	LEFT JOIN clients ON clients.id=t1.client_id
	LEFT JOIN (
		SELECT sum(orders.quant) q,orders.client_id
		FROM orders GROUP BY orders.client_id
		)  AS oo ON oo.client_id=t1.client_id
	LEFT JOIN client_valid_duplicates AS vdup
		ON vdup.client_id=t1.client_id
		AND vdup.tel=t1.tel
	WHERE (
		SELECT count(*)
		FROM client_tels inr
		WHERE inr.tel = t1.tel
		) > 1
		AND (t1.tel IS NOT NULL AND t1.tel<>'' AND t1.tel<>'8-9-')
		AND vdup.client_id IS NULL
	ORDER BY t1.tel;

ALTER TABLE client_duplicates_list
  OWNER TO beton;
