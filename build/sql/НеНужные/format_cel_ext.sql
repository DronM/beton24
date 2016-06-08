CREATE OR REPLACE FUNCTION format_cel_ext(text)
  RETURNS text AS
$BODY$
	SELECT 
		'8-'||substr($1,1,3)
		||
		CASE
		WHEN char_length($1)>=4 THEN '-'||substr($1,4,3)
		ELSE ''
		END
		||
		CASE
		WHEN char_length($1)>=7 THEN '-'||substr($1,7,2)
		ELSE ''
		END
		;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION format_cel_ext(text) OWNER TO bellagio;
