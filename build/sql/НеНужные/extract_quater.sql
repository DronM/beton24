-- Function: extract_quater(timestampTZ)

-- DROP FUNCTION extract_quater(timestampTZ)

CREATE OR REPLACE FUNCTION extract_quater(timestampTZ)
  RETURNS int AS
$BODY$
	SELECT
		CASE
		WHEN EXTRACT(MONTH FROM $1)<4 THEN 1 
		WHEN EXTRACT(MONTH FROM $1)<7 THEN 2
		WHEN EXTRACT(MONTH FROM $1)<10 THEN 3
		ELSE 4
		END
	;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION extract_quater(timestampTZ)
  OWNER TO beton;
