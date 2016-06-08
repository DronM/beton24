-- Function: raw_mat_cons_avg_dev(date,integer)

-- DROP FUNCTION raw_mat_cons_avg_dev(date,integer);

CREATE OR REPLACE FUNCTION raw_mat_cons_avg_dev(date,integer)
  RETURNS numeric AS
$BODY$
	SELECT
		coalesce(
			(sum(cons.material_quant)
			+sum(cons.material_quant_corrected)
			)/2
		,0)
	FROM ra_material_consumption AS cons
	WHERE
		cons.material_id = $2
		--IN (select * from explode_array($2))
		AND cons.date_time BETWEEN 
			get_shift_start($1+const_first_shift_start_time_val()) - (const_avg_mat_cons_dev_day_count_val()||' days')::interval
			AND
			get_shift_start($1+const_first_shift_start_time_val())
	;

$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION raw_mat_cons_avg_dev(date,integer)
  OWNER TO beton;
