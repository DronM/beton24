-- Function: dev_avg_final(dev_avg_param)

-- DROP FUNCTION dev_avg_final(dev_avg_param);

CREATE OR REPLACE FUNCTION dev_avg_final(cur_state dev_avg_param)
  RETURNS numeric AS
$BODY$
	SELECT
		CASE 
			WHEN $1.cnt=0 THEN 0
			ELSE $1.dev_total/$1.cnt
		END;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION dev_avg_final(dev_avg_param)
  OWNER TO beton;

  
-- Function: dev_avg_state(dev_avg_param, numeric)

-- DROP FUNCTION dev_avg_state(dev_avg_param, numeric);

CREATE OR REPLACE FUNCTION dev_avg_state(cur_state dev_avg_param, next_val numeric)
  RETURNS dev_avg_param AS
$BODY$
DECLARE
	dev_val numeric;
	v_next_val numeric;
BEGIN
	IF (next_val IS NULL) THEN
		v_next_val = 0;
	ELSE
		v_next_val = next_val;
	END IF;
	
	IF NOT cur_state.first_val THEN
		IF (cur_state.prev_val>v_next_val) THEN
			dev_val = cur_state.prev_val - v_next_val;
		ELSE
			dev_val = v_next_val - cur_state.prev_val;
		END IF;
		cur_state.dev_total = cur_state.dev_total + dev_val;
		cur_state.cnt = cur_state.cnt + 1;
	END IF;
	
	cur_state.prev_val = v_next_val;
	if cur_state.first_val THEN
		cur_state.first_val = false;
	END IF;
	
	RETURN cur_state;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION dev_avg_state(dev_avg_param, numeric)
  OWNER TO beton;
  