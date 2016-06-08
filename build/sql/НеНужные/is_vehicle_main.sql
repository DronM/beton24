-- Function: is_vehicle_main(character varying)

-- DROP FUNCTION is_vehicle_main(character varying);

CREATE OR REPLACE FUNCTION is_vehicle_main(in_vehicle_feature character varying)
  RETURNS boolean AS
$BODY$
	SELECT ($1 IS NOT NULL) AND ($1=constant_own_vehicles_feature() OR $1=constant_backup_vehicles_feature());
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION is_vehicle_main(character varying)
  OWNER TO beton;
