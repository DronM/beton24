-- Function: raw_material_cons_dates(date,date)

--DROP FUNCTION raw_material_cons_dates(date,date);

CREATE OR REPLACE FUNCTION raw_material_cons_dates(IN in_date_from date, IN in_date_to date)
  RETURNS SETOF record AS
$BODY$
DECLARE
	materials raw_materials%rowtype;
	dyn_cols text;
	q text;
	dyn_col_cnt int;
BEGIN
	dyn_cols = '';
	dyn_col_cnt = 0;
	FOR materials IN 
		SELECT id FROM raw_materials ORDER BY id	
	LOOP
		dyn_col_cnt = dyn_col_cnt + 1;
		dyn_cols = dyn_cols||', ';
		dyn_cols = dyn_cols
		|| '(SELECT SUM(material_quant) FROM consump WHERE consump.d=consump_d.d AND consump.material_id='|| materials.id ||'::int) AS mat'|| dyn_col_cnt ||'_quant';
	END LOOP;	

	--RETURN QUERY EXECUTE 
	q=
		'WITH consump AS (SELECT date_time::date AS d,
					material_id,
					ROUND(SUM(material_quant),0) AS material_quant,
					ROUND(SUM(concrete_quant),2) AS concrete_quant
			FROM ra_material_consumption WHERE date_time::date BETWEEN '''|| in_date_from ||'''::date AND '''|| in_date_to ||'''::date GROUP BY d,material_id ORDER BY d)
		SELECT consump_d.d AS date,
			date5_descr(consump_d.d)::text AS date_descr,
			(SELECT SUM(consump.concrete_quant) FROM consump WHERE consump.d=consump_d.d) AS concrete_quant
		'|| dyn_cols ||'
		FROM consump AS consump_d GROUP BY consump_d.d ORDER BY consump_d.d';	
	RAISE '%',q;
	--RETURN QUERY EXECUTE q;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION raw_material_cons_dates(date,date) OWNER TO beton;
