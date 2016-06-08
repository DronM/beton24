-- Function: vehicle_tracker_id_on_schedule_id(integer)

-- DROP FUNCTION get_vehicle_tracker_id_on_schedule_id(integer);

CREATE OR REPLACE FUNCTION vehicle_tracker_id_on_schedule_id(integer)
  RETURNS character varying AS
$BODY$
	SELECT vehicles.tracker_id
	FROM vehicle_schedules
	LEFT JOIN vehicles ON vehicles.id=vehicle_schedules.vehicle_id
	WHERE vehicle_schedules.id=$1;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION vehicle_tracker_id_on_schedule_id(integer)
  OWNER TO beton;

