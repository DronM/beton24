/*Function: raw_material_total_details_report(in_date_time_from timestamp without time zone,
					in_date_time_to timestamp without time zone,
					in_material_id int)
*/
/*
DROP FUNCTION raw_material_total_details_report(in_date_time_from timestamp without time zone,
					in_date_time_to timestamp without time zone,
					in_material_id int);
*/
CREATE OR REPLACE FUNCTION raw_material_total_details_report(IN in_date_time_from timestamp without time zone,
					IN in_date_time_to timestamp without time zone,
					IN in_material_id int)
  RETURNS TABLE(
	supplier_id int,
	supplier_descr text,
	quant_procur numeric,
	quant_consump numeric
  ) AS
$BODY$
BEGIN
	RETURN QUERY
		SELECT
			proc.supplier_id,
			s.name::text AS supplier_descr,
			COALESCE(SUM(proc.quant_net),0) AS quant_procur,
			SUM(0)::numeric AS quant_consump
		FROM doc_material_procurements AS proc
		LEFT JOIN suppliers AS s ON s.id=proc.supplier_id
		WHERE proc.material_id=in_material_id
		AND proc.date_time BETWEEN in_date_time_from AND in_date_time_to
		GROUP BY proc.supplier_id,supplier_descr;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100 ROWS 1000;
ALTER FUNCTION raw_material_total_details_report(in_date_time_from timestamp without time zone,
					in_date_time_to timestamp without time zone,
					in_material_id int) OWNER TO beton;
