-- Function: orders_count_on_period(date_time_from timestampTZ,date_time_to timestampTZ, period periods)

--DROP FUNCTION orders_count_on_period(date_time_from timestampTZ,date_time_to timestampTZ, period periods);

CREATE OR REPLACE FUNCTION orders_count_on_period(date_time_from timestampTZ,date_time_to timestampTZ, period periods)
  RETURNS TABLE(
	date_time timestampTZ,
	cnt bigint,
	quant numeric
	)  AS
$BODY$
	SELECT
		series.dt AS date_time,
		coalesce(ord_cnt.cnt,0) AS cnt,
		coalesce(ord_cnt.quant,0) AS quant
	FROM (
		SELECT generate_series(
			CASE
				WHEN $3='day'::periods THEN $1::date
				WHEN $3='week'::periods THEN date_trunc('week', $1)
				WHEN $3='month'::periods THEN date_trunc('month',$1)
				WHEN $3='quarter'::periods THEN quater_start($1)
				WHEN $3='year'::periods THEN date_trunc('year', $1)
				ELSE $1::date
			END,
			$2,
			CASE
				WHEN $3='day'::periods THEN '1 day'::interval
				WHEN $3='week'::periods THEN '1 week'::interval
				WHEN $3='month'::periods THEN '1 month'::interval
				WHEN $3='quarter'::periods THEN '3 months'::interval
				WHEN $3='year'::periods THEN '1 year'::interval
				ELSE '1 day'::interval
			END
			) AS dt
	) AS series
	LEFT JOIN (
		SELECT
			CASE
				WHEN $3='day'::periods THEN date_time::date
				WHEN $3='week'::periods THEN date_trunc('week', date_time)
				WHEN $3='month'::periods THEN date_trunc('month', date_time)
				WHEN $3='quarter'::periods THEN quater_start(date_time)
				WHEN $3='year'::periods THEN date_trunc('year', date_time)
				ELSE date_time::date
			END AS date_time,
			count(*) AS cnt,
			sum(quant) AS quant
		FROM orders
		WHERE date_time BETWEEN $1 AND $2
			AND temp = FALSE
		GROUP BY CASE
				WHEN $3='day'::periods THEN date_time::date
				WHEN $3='week'::periods THEN date_trunc('week', date_time)
				WHEN $3='month'::periods THEN date_trunc('month', date_time)
				WHEN $3='quarter'::periods THEN quater_start(date_time)
				WHEN $3='year'::periods THEN date_trunc('year', date_time)
				ELSE date_time::date
			END	
		ORDER BY date_time
		) AS ord_cnt ON ord_cnt.date_time=series.dt
		;
$BODY$
  LANGUAGE sql VOLATILE COST 100;
ALTER FUNCTION orders_count_on_period(date_time_from timestampTZ,date_time_to timestampTZ, period periods)
  OWNER TO beton;
