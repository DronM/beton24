-- View: destination_dialog_view

--DROP VIEW destination_dialog_view;

CREATE OR REPLACE VIEW destination_dialog_view AS 
	SELECT
		destinations.id,
		destinations.name,
		destinations.distance,
		destinations.time_route,
		destinations.price,
		replace(replace(st_astext(destinations.zone),'POLYGON(('::text, ''::text), '))'::text, ''::text) AS zone_str,
		replace(replace(st_astext(st_centroid(destinations.zone)), 'POINT('::text, ''::text), ')'::text, ''::text) AS zone_center_str
	FROM destinations;

ALTER TABLE destination_dialog_view
  OWNER TO beton;
