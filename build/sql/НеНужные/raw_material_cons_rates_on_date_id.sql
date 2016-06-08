-- Function: raw_material_cons_rates_on_date_id(int,int)

--DROP FUNCTION raw_material_cons_rates_on_date_id(int,int);

CREATE OR REPLACE FUNCTION raw_material_cons_rates_on_date_id(IN in_date_id int, IN in_concrete_type_id int)
  RETURNS SETOF record AS
$BODY$
DECLARE
	materials raw_materials%rowtype;
	dyn_cols text;
	dyn_col_cnt int;
BEGIN
	dyn_cols = '';
	dyn_col_cnt = 0;
	FOR materials IN 
		SELECT id,name FROM raw_materials
		WHERE concrete_part=true ORDER BY id	
	LOOP
		dyn_col_cnt = dyn_col_cnt + 1;
		dyn_cols = dyn_cols||', ';
		dyn_cols = dyn_cols
			|| materials.id || '::int' || ' AS mat'||dyn_col_cnt||'_id,'
			||'(SELECT ROUND(cons.rate,4) FROM cons WHERE cons.concrete_type_id=ct.id AND cons.raw_material_id='||materials.id||' LIMIT 1)'
			||' AS mat'||dyn_col_cnt||'_rate';
	END LOOP;	
	/*
	RAISE 'SELECT
		ct.id AS concrete_type_id,
		ct.name::text AS concrete_type_descr%
		FROM concrete_types AS ct',dyn_cols;
	*/
	RETURN QUERY EXECUTE '
	WITH cons AS (SELECT * FROM raw_material_cons_rates AS consump WHERE consump.rate_date_id='||in_date_id||')	
	SELECT
		ct.id AS concrete_type_id,
		ct.name::text AS concrete_type_descr' || dyn_cols
	||' FROM concrete_types AS ct WHERE ('||in_concrete_type_id||'>0 AND ct.id='||in_concrete_type_id||') OR ('||in_concrete_type_id||'=0)';
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION raw_material_cons_rates_on_date_id(int,int) OWNER TO beton;
