-- Function: order_descr(orders)

-- DROP FUNCTION order_descr(orders);

CREATE OR REPLACE FUNCTION order_descr(orders)
  RETURNS text AS
$BODY$
	SELECT 'Заявка № ' || coalesce(order_num($1),trim(to_char($1.id,'99999'))) || ' от ' || date8_descr($1.date_time::date);
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION order_descr(orders)
  OWNER TO beton;
