-- Function: get_period_rus(date,text)

-- DROP FUNCTION get_period_rus(date,text);

CREATE OR REPLACE FUNCTION get_period_rus(date,text)
  RETURNS text AS
$BODY$
DECLARE
	v_months varchar[12];
	res text;
BEGIN
	v_months[0] = 'Январь';
	v_months[1] = 'Февраль';
	v_months[2] = 'Март';
	v_months[3] = 'Апрель';
	v_months[4] = 'Май';
	v_months[5] = 'Июнь';
	v_months[6] = 'Июль';
	v_months[7] = 'Август';
	v_months[8] = 'Сентябрь';
	v_months[9] = 'Октябрь';
	v_months[10] = 'Ноябрь';
	v_months[11] = 'Декабрь';
	res = v_months[date_part('month',$1)-1];
	IF char_length($2)>0 THEN
		res = res || ' ' || to_char($1,$2);
	END IF;
	RETURN  res;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION get_period_rus(date,text) OWNER TO postgres;
