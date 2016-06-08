-- Function: round_minutes(timestampTZ, integer)

-- DROP FUNCTION round_minutes(timestampTZ, integer);

CREATE OR REPLACE FUNCTION round_minutes(timestampTZ, integer)
  RETURNS timestampTZ AS
$BODY$ 
  SELECT date_trunc('hour', $1) + cast(($2::varchar||' min') as interval) * ceil(date_part('minute',$1)::float / cast($2 as float)) 
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION round_minutes(timestampTZ, integer)
  OWNER TO beton;
