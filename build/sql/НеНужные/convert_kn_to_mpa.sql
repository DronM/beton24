--DROP FUNCTION convert_kn_to_mpa(int);

CREATE OR REPLACE FUNCTION convert_kn_to_mpa(int)
  RETURNS numeric AS
$BODY$
BEGIN
	RETURN $1/10;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION convert_kn_to_mpa(int) OWNER TO postgres;
