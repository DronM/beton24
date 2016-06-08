-- Function: quant_descr(numeric)

-- DROP FUNCTION quant_descr(numeric);

CREATE OR REPLACE FUNCTION quant_descr(numeric)
  RETURNS character varying AS
$BODY$
	SELECT trim(to_char($1,'999999999D999'));
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION quant_descr(numeric)
  OWNER TO beton;
