-- View: concrete_prices_list

-- DROP VIEW concrete_prices_list;

CREATE OR REPLACE VIEW concrete_prices_list AS 
	SELECT
		t.*,
		ct.name AS concrete_type_descr,
		date5_time5_descr(t.date_time) AS date_time_descr
	FROM concrete_prices t
	LEFT JOIN concrete_types ct ON ct.id=t.concrete_type_id
	ORDER BY t.concrete_type_id,t.date_time
	;
ALTER TABLE concrete_prices_list
  OWNER TO beton;
