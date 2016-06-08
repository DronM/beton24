-- VIEW: ast_calls_client_ship_hist_list

--DROP VIEW ast_calls_client_ship_hist_list;

CREATE OR REPLACE VIEW ast_calls_client_ship_hist_list AS
	SELECT
		o.client_id,
		o.comment_text AS comment_text,
		(SELECT SUM(sh.quant) FROM shipments AS sh
		WHERE sh.order_id=o.id AND sh.shipped
		) AS quant,
		ct.name AS concrete_type_descr,
		dst.name||', '||dst.distance||'км.,'||dst.time_route||', '||dst.price||'р.' AS destination_descr
	FROM orders o
	LEFT JOIN concrete_types AS ct ON ct.id=o.concrete_type_id
	LEFT JOIN destination_list_view AS dst ON dst.id=o.destination_id
	WHERE
		
		COALESCE((SELECT SUM(sh.quant) FROM shipments AS sh
		WHERE sh.order_id=o.id AND sh.shipped
		),0)>0			
	ORDER BY o.date_time DESC
	;
ALTER VIEW ast_calls_client_ship_hist_list OWNER TO beton;