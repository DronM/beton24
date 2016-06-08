-- Function: order_payed_inf(orders)

-- DROP FUNCTION order_payed_inf(orders);

CREATE OR REPLACE FUNCTION order_payed_inf(orders)
  RETURNS text AS
$BODY$
	SELECT
		CASE
			WHEN $1.payed THEN 'опл'
			WHEN $1.under_control THEN '!'
			ELSE '-'
		END AS payed_inf
	;
$BODY$
  LANGUAGE sql VOLATILE COST 100;
ALTER FUNCTION order_payed_inf(orders)
  OWNER TO beton;
