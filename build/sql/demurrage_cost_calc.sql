-- Function: demurrage_cost_calc(interval)

-- DROP FUNCTION demurrage_cost_calc(interval);

CREATE OR REPLACE FUNCTION demurrage_cost_calc(in_demurrage_time interval)
  RETURNS numeric AS
$BODY$
	SELECT 
		CASE
			WHEN in_demurrage_time>'00:00' THEN
				round( (EXTRACT(EPOCH FROM GREATEST($1,const_min_demurrage_time_val()))::numeric
					* const_demurrage_cost_per_hour_val()::numeric / 3600::numeric
					)/100
				)*100
			ELSE 0
		END;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION demurrage_cost_calc(interval)
  OWNER TO beton;
