-- Function: format_cel_ext(text)

-- DROP FUNCTION format_phone(text);

CREATE OR REPLACE FUNCTION format_phone(text)
  RETURNS text AS
$BODY$
	SELECT 
		CASE
			WHEN substr($1,1,1)='9' THEN
				format_cel_phone($1)
			WHEN substr($1,1,4)='3452' THEN
				'(3452) ' || substr($1,5,2) || '-'||substr($1,7,2) || '-'||substr($1,9,2)
				
			ELSE
				$1
		END
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION format_phone(text)
  OWNER TO bellagio;
