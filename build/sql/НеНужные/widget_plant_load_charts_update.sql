/*Function: widget_plant_load_charts_update(
	in_date_time_from timestamp,
	in_date_time_to timestamp,
	in_times text,
	in_norms text,
	in_orders text,
	in_shipments text,
	in_veh_counts text
	)
*/

/*DROP FUNCTION widget_plant_load_charts_update(
	in_date_time_from timestamp,
	in_date_time_to timestamp,
	in_times text,
	in_norms text,
	in_orders text,
	in_shipments text,
	in_veh_counts text
	)
*/

CREATE OR REPLACE FUNCTION widget_plant_load_charts_update(
	in_date_time_from timestamp,
	in_date_time_to timestamp,
	in_times text,
	in_norms text,
	in_orders text,
	in_shipments text,
	in_veh_counts text
	)
RETURNS void as $$
BEGIN
	UPDATE widget_plant_load_charts
		SET
			times = in_times,
			norms = in_norms,
			orders = in_orders,
			shipments = in_shipments,			
			veh_counts = in_veh_counts,
			state = 2
	WHERE date_time_from=in_date_time_from
		AND date_time_to=in_date_time_to;
	
	IF FOUND THEN
		RETURN;
	END IF;

	
	BEGIN
		INSERT INTO widget_plant_load_charts
		(date_time_from,date_time_to,
		times,norms,orders,shipments,veh_counts,state)
		VALUES (in_date_time_from,in_date_time_to,
		in_times,in_norms,in_orders,in_shipments,in_veh_counts,2
		);
	EXCEPTION WHEN OTHERS THEN
		UPDATE widget_plant_load_charts
			SET
				times = in_times,
				norms = in_norms,
				orders = in_orders,
				shipments = in_shipments,			
				veh_counts = in_veh_counts,
				state = 2
		WHERE date_time_from=in_date_time_from
			AND date_time_to=in_date_time_to;	
	END;
	
	RETURN;
END;
$$ language plpgsql;

ALTER FUNCTION widget_plant_load_charts_update(
	in_date_time_from timestamp,
	in_date_time_to timestamp,
	in_times text,
	in_norms text,
	in_orders text,
	in_shipments text,
	in_veh_counts text
	)
OWNER TO beton;
