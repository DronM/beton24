-- View: suppliers_list_view

-- DROP VIEW suppliers_list_view;

CREATE OR REPLACE VIEW suppliers_list_view AS 
	SELECT
		suppliers.id,
		suppliers.name,
		suppliers.tel,
		suppliers.tel2
	FROM suppliers
	ORDER BY suppliers.name;

ALTER TABLE suppliers_list_view
  OWNER TO beton;
