-- Function: get_raw_material_planned_consuption_report(date, integer)

-- DROP FUNCTION get_raw_material_planned_consuption_report(date, integer);

CREATE OR REPLACE FUNCTION get_raw_material_planned_consuption_report(IN date, IN integer)
  RETURNS TABLE(raw_material_id integer, raw_material_descr character varying, planned_procurement numeric, quant_balance numeric, quant_ordered numeric[], planned_consuption numeric[]) AS
$BODY$
DECLARE
	query_text text;
	query_ar text;
	query_ar_ordered text;
	query_joins text;
	sq_alias text;
BEGIN
	query_ar = '';
	query_ar_ordered = '';
	query_joins = '';
	FOR i IN 0..($2-1) LOOP
		IF i>0 THEN
			query_ar = query_ar || ',';
			query_ar_ordered = query_ar_ordered || ',';
		END IF;
		query_ar_ordered = query_ar_ordered || format('sq_d_%s.ordered::numeric',i+1);
		
		query_ar = query_ar || format('(coalesce(bl.quant_balance,0) + m.planned_procurement*%s - (',i+1);
		FOR k IN 1..(i+1) LOOP
			IF k>1 THEN
				query_ar = query_ar || ' + ';
			END IF;
			query_ar = query_ar || format('sq_d_%s.ordered',k);
		END LOOP;
		query_ar = query_ar || '))::numeric';

		sq_alias = 'sq_d_' || (i+1);
		query_joins = query_joins || format('
			LEFT JOIN
			(SELECT coalesce(SUM(orders.quant*raw_material_cons_rates.rate),0) AS ordered,raw_material_cons_rates.raw_material_id
				FROM orders
				LEFT JOIN raw_material_cons_rates ON raw_material_cons_rates.concrete_type_id = orders.concrete_type_id
				WHERE (orders.date_time BETWEEN %L AND %L)
				GROUP BY raw_material_cons_rates.raw_material_id) AS %s
				ON %s.raw_material_id=cons.raw_material_id'
			,($1+i)+'00:00'::time,($1+i)+'23:59:59'::time,sq_alias,sq_alias);
		
	END LOOP;
	
	query_text = format('SELECT
		m.id AS raw_material_id,
		m.name AS raw_material_descr,		
		m.planned_procurement AS planned_procurement,
		coalesce(bl.quant_balance,0)::numeric AS quant_balance,
		ARRAY[%s] AS quant_ordered,
		ARRAY[%s] AS planned_consuption
	FROM raw_material_cons_rates AS cons
	LEFT JOIN raw_materials AS m ON m.id = cons.raw_material_id
	LEFT JOIN get_balance_raw_material_inventory(%L) AS bl ON bl.raw_material_id=cons.raw_material_id
	%s
	GROUP BY m.name,m.id,m.planned_procurement,bl.quant_balance,quant_ordered,planned_consuption
	',query_ar_ordered,query_ar,$1-'00:01'::time,query_joins);
	
	--RAISE EXCEPTION '%',query_text;
	RETURN QUERY EXECUTE (query_text);
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION get_raw_material_planned_consuption_report(date, integer)
  OWNER TO beton;
