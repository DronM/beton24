-- View: destination_list_view

-- DROP VIEW destination_list_view;

CREATE OR REPLACE VIEW destination_list_view AS 
	SELECT
		destinations.id,
		destinations.name,
		destinations.distance,
		time5_descr(destinations.time_route) AS time_route,
		destinations.price
	FROM destinations
	ORDER BY destinations.name;

ALTER TABLE destination_list_view
  OWNER TO beton;
