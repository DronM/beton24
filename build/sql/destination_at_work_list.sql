-- Function: destination_at_work_list(date)

DROP FUNCTION destination_at_work_list(date);

CREATE OR REPLACE FUNCTION destination_at_work_list(date)
  RETURNS TABLE(
	vehicle_id int,
	destination_id int,
	destination_descr text,
	zone_str text,
	zone_center_str text,
	is_base boolean
  )
  AS
$BODY$
	(SELECT
		vh.id AS vehicle_id,
		vss.destination_id,
		dest.name::text AS destination_descr,
		replace(replace(st_astext(dest.zone),'POLYGON(('::text, ''::text), '))'::text, ''::text) AS zone_str,
		replace(replace(st_astext(st_centroid(dest.zone)), 'POINT('::text, ''::text), ')'::text, ''::text) AS zone_center_str,
		FALSE AS is_base
	FROM 
		(SELECT destination_id,tracker_id,rank()  
			OVER (PARTITION BY schedule_id ORDER BY date_time DESC) FROM vehicle_schedule_states
		WHERE tracker_id IS NOT NULL AND tracker_id<>''
			AND date_time::date='2015-02-05'
		) AS vss
	LEFT JOIN destinations AS dest ON dest.id=vss.destination_id
	LEFT JOIN vehicles AS vh ON vh.tracker_id=vss.tracker_id
	WHERE rank = 1)
	
	UNION ALL
	
	(SELECT * FROM destination_base_list)
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION destination_at_work_list(date)
  OWNER TO beton;
