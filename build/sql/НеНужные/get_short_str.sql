-- Function: get_short_str(text, integer)

-- DROP FUNCTION get_short_str(text, integer);

CREATE OR REPLACE FUNCTION get_short_str(text, integer)
  RETURNS text AS
$BODY$
BEGIN
	IF ($1=null) THEN
		RETURN '';
	ELSEIF (length($1)>($2+3)) THEN
		RETURN substring($1,1,$2) || '...';
	ELSE
		RETURN $1;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION get_short_str(text, integer)
  OWNER TO beton;
