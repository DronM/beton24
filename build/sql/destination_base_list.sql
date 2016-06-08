-- View: destination_base_list

--DROP VIEW destination_base_list;

CREATE OR REPLACE VIEW destination_base_list AS 
	SELECT
		NULL::int AS vehicle_id,
		id AS destination_id,
		name::text AS destination_descr,
		replace(replace(st_astext(zone),'POLYGON(('::text, ''::text), '))'::text, ''::text) AS zone_str,
		replace(replace(st_astext(st_centroid(zone)), 'POINT('::text, ''::text), ')'::text, ''::text) AS zone_center_str,
		TRUE AS is_base	
	FROM destinations
	WHERE id=const_base_geo_zone_val()
	;
ALTER TABLE destination_base_list
  OWNER TO beton;
