DROP function dev_avg_state(cur_state dev_avg_param, next_val numeric);
DROP function dev_avg_final(cur_state dev_avg_param);
DROP aggregate dev_avg(numeric);
DROP TYPE dev_avg_param;

CREATE TYPE dev_avg_param AS (
    dev_total numeric,
    cnt int,
	prev_val numeric,
	first_val boolean
);

CREATE OR REPLACE function dev_avg_state(cur_state dev_avg_param, next_val numeric)
returns dev_avg_param AS
$BODY$
DECLARE
	dev_val numeric;
BEGIN
	IF cur_state.first_val THEN
	ELSE
		IF (cur_state.prev_val>next_val) THEN
			dev_val = cur_state.prev_val - next_val;
		ELSE
			dev_val = next_val - cur_state.prev_val;
		END IF;
		cur_state.dev_total = cur_state.dev_total + dev_val;
		cur_state.cnt = cur_state.cnt + 1;
	END IF;
	cur_state.prev_val = next_val;
	if cur_state.first_val THEN
		cur_state.first_val = false;
	END IF;
	
	RETURN cur_state;
END;
$BODY$
language plpgsql;
ALTER FUNCTION dev_avg_state(dev_avg_param, numeric)
  OWNER TO beton;

  
CREATE OR REPLACE function dev_avg_final(cur_state dev_avg_param)
returns numeric AS
$BODY$
	SELECT
		CASE 
			WHEN $1.cnt=0 THEN 0
			ELSE $1.dev_total/$1.cnt
		END;
$BODY$
language sql;
ALTER FUNCTION dev_avg_final(dev_avg_param)
  OWNER TO beton;

create aggregate dev_avg(numeric) (
    SFUNC = dev_avg_state,
    STYPE = dev_avg_param,
    FINALFUNC = dev_avg_final,
    INITCOND = '(0,0,0,true)'
);  