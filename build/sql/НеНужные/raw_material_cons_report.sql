-- Function: raw_material_cons_report(timestamp without time zone, timestamp without time zone, integer, integer)

-- DROP FUNCTION raw_material_cons_report(timestamp without time zone, timestamp without time zone, integer, integer);

CREATE OR REPLACE FUNCTION raw_material_cons_report(IN in_date_time_from timestamp without time zone, IN in_date_time_to timestamp without time zone, IN in_concrete_type_id integer, IN in_raw_materil_id integer)
  RETURNS TABLE(concrete_type_id integer, concrete_type_descr character varying, raw_material_id integer, raw_material_descr character varying, quant_on_cons_rate numeric) AS
$BODY$
BEGIN
	RETURN QUERY
		SELECT
			ct.id AS concrete_id,
			ct.name AS concrete_descr,
			m.id AS material_id,
			m.name AS material_descr, 
			SUM(cons.rate::numeric * sh.quant::numeric) AS quant_on_cons_rate
		FROM raw_material_cons_rates AS cons
		LEFT JOIN (
			SELECT
				orders.concrete_type_id AS concrete_type_id,
				SUM(shipments.quant) AS quant
			FROM shipments
			LEFT JOIN orders ON orders.id=shipments.order_id
			WHERE (shipments.ship_date_time BETWEEN in_date_time_from AND in_date_time_to) AND (in_concrete_type_id=0 OR (in_concrete_type_id>0 AND orders.concrete_type_id=in_concrete_type_id))
			GROUP BY orders.concrete_type_id
			) AS sh			
			ON sh.concrete_type_id = cons.concrete_type_id
			
		LEFT JOIN raw_materials AS m ON m.id=cons.raw_material_id
		LEFT JOIN concrete_types AS ct ON ct.id=cons.concrete_type_id
		WHERE (in_raw_materil_id=0) OR (in_raw_materil_id>0 AND cons.raw_material_id=in_raw_materil_id)
		GROUP BY ct.id, ct.name, m.id, m.name;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION raw_material_cons_report(timestamp without time zone, timestamp without time zone, integer, integer)
  OWNER TO beton;
