-- Function: spread_order_quant(timestampTZ, timestampTZ, numeric, numeric, integer)

-- DROP FUNCTION spread_order_quant(timestampTZ, timestampTZ, numeric, numeric, integer);

CREATE OR REPLACE FUNCTION spread_order_quant(IN date_time_from timestampTZ, IN date_time_to timestampTZ, IN quant numeric, IN speed_per_hour numeric, IN min integer)
  RETURNS TABLE(d_start timestampTZ, quant_spread numeric) AS
$BODY$
	WITH 
		speed_per_interval AS (SELECT $4::numeric * $5 / 60 AS val),
		min_interval AS (SELECT ($5 || ' minutes')::interval AS val)
	SELECT 
		*,
		(SELECT t.val FROM speed_per_interval t) AS quant_spread
	FROM generate_series($1,
		($2 - (SELECT t.val FROM min_interval t) - '00:00:01'::interval),
		(SELECT t.val FROM min_interval t)
		) AS d_start
	
	UNION ALL
	
	SELECT
		*,
		CASE
			WHEN ($3::numeric - (floor($3::numeric / (SELECT t.val FROM speed_per_interval t)) * (SELECT t.val FROM speed_per_interval t))::numeric)>0 THEN
				$3::numeric - (floor($3::numeric / (SELECT t.val FROM speed_per_interval t)) * (SELECT t.val FROM speed_per_interval t))::numeric
			ELSE LEAST((SELECT t.val FROM speed_per_interval t),$3)
		END AS quant_spread
	FROM generate_series($2, $2, (SELECT t.val FROM min_interval t)) AS d_start;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION spread_order_quant(timestampTZ, timestampTZ, numeric, numeric, integer)
  OWNER TO beton;

