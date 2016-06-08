-- Function: order_edit(orders

-- DROP FUNCTION order_edit(orders);

CREATE OR REPLACE FUNCTION order_edit(orders)
  RETURNS boolean AS
$$
	SELECT $1.date_time >= get_shift_start(now());
$$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION order_edit(orders) OWNER TO beton;
