-- View: concrete_types_for_lab_list

--DROP VIEW concrete_types_for_lab_list;

CREATE OR REPLACE VIEW concrete_types_for_lab_list AS 
	SELECT t.*
	FROM concrete_types AS t
	WHERE t.pres_norm>0
	ORDER BY t.name;

ALTER TABLE concrete_types_for_lab_list
  OWNER TO beton;
