-- Function: concrete_short_name(text)

-- DROP FUNCTION concrete_short_name(text);

CREATE OR REPLACE FUNCTION concrete_short_name(text)
  RETURNS text AS
$BODY$
	SELECT
		upper(
			substring((regexp_split_to_array($1, ' '))[1],1,1)
			)
		||
		CASE WHEN (regexp_split_to_array($1, ' '))[2] IS NOT NULL THEN
			'.' ||
			upper(
				substring((regexp_split_to_array($1, ' '))[2],1,1)
			)
		ELSE ''
		END
	;
$BODY$
LANGUAGE sql VOLATILE COST 100;
ALTER FUNCTION concrete_short_name(text) OWNER TO beton;
