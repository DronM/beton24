-- Function: raw_material_cons_rates(integer, timestamp without time zone)

--DROP FUNCTION raw_material_cons_rates(integer, timestamp without time zone);

CREATE OR REPLACE FUNCTION raw_material_cons_rates(
	IN in_concrete_type_id integer,
	IN in_date_time timestamp without time zone)
  RETURNS TABLE(
	concrete_type_id integer,
	material_id integer,
	rate numeric) AS
$BODY$
	SELECT
		rates.concrete_type_id,
		rates.raw_material_id AS material_id,
		rates.rate
	FROM raw_material_cons_rates AS rates
	WHERE 
		rates.rate_date_id=(
			SELECT id
			FROM raw_material_cons_rate_dates
			WHERE dt<=$2::date ORDER BY dt DESC LIMIT 1
			)
		AND (($1 IS NULL OR $1=0)
		OR ($1>0 AND rates.concrete_type_id=$1))
		;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  CALLED ON NULL INPUT
  ROWS 1000;
ALTER FUNCTION raw_material_cons_rates(integer, timestamp without time zone)
  OWNER TO beton;
