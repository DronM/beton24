-- Function: quater_start(timestampTZ)

-- DROP FUNCTION quater_start(timestampTZ)

CREATE OR REPLACE FUNCTION quater_start(timestampTZ)
  RETURNS timestampTZ AS
$BODY$
	SELECT
		(EXTRACT( YEAR FROM $1)::text
		||'-'||
		CASE
			WHEN EXTRACT(MONTH FROM $1)<4 THEN '01'
			WHEN EXTRACT(MONTH FROM $1)<7 THEN '04'
			WHEN EXTRACT(MONTH FROM $1)<10 THEN '07'
			ELSE '10'
		END
		||'-01 00:00:00')::timestampTZ
	;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION quater_start(timestampTZ)
  OWNER TO beton;
