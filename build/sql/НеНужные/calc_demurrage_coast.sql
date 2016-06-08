-- Function: calc_demurrage_coast(interval)

-- DROP FUNCTION calc_demurrage_coast(interval);

CREATE OR REPLACE FUNCTION calc_demurrage_coast(in_demurrage_time interval)
  RETURNS numeric AS
$BODY$
	SELECT 
		CASE
			WHEN in_demurrage_time>'00:00' THEN
				round( (EXTRACT(EPOCH FROM GREATEST(in_demurrage_time,constant_min_demurrage_time()))::numeric * constant_demurrage_coast_per_hour()::numeric / 3600::numeric)/100)*100
			ELSE 0
		END;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION calc_demurrage_coast(interval)
  OWNER TO beton;
