-- Function: get_run_inf_on_shipment(integer,integer)

DROP FUNCTION get_run_inf_on_shipment(integer,integer) CASCADE;

CREATE OR REPLACE FUNCTION get_run_inf_on_shipment(in_schedule_id integer,in_shipment_id integer)
  RETURNS RECORD AS
$BODY$
	WITH vstates AS (
		SELECT
			date_time,
			state
		FROM vehicle_schedule_states vss
		WHERE vss.shipment_id=$2
			AND vss.schedule_id=$1
		ORDER BY date_time DESC
	)
	SELECT
		(SELECT vstates.date_time FROM vstates WHERE  vstates.state='assigned') AS state_assigned,
		(SELECT vstates.date_time FROM vstates WHERE  vstates.state='left_for_dest') AS state_left_for_dest,
		(SELECT vstates.date_time FROM vstates WHERE  vstates.state='at_dest') AS state_at_dest,
		(SELECT vstates.date_time FROM vstates WHERE  vstates.state='left_for_base') AS state_left_for_base,
		(SELECT vstates.date_time FROM vstates WHERE  vstates.state='free' OR vstates.state='out' OR vstates.state='out_from_shift') AS state_free,
		(SELECT vstates.state FROM vstates LIMIT 1) AS state,
		(SELECT vstates.date_time FROM vstates LIMIT 1) AS state_date_time
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION get_run_inf_on_shipment(integer,integer)
  OWNER TO beton;
