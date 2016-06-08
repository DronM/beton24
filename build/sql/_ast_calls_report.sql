-- Function: ast_calls_report(timestamp,timestamp,int)

--DROP FUNCTION ast_calls_report(timestamp,timestamp,int);

CREATE OR REPLACE FUNCTION ast_calls_report(timestamp,timestamp,int)
  RETURNS TABLE(
	manager_id int,
	manager_descr text,
	
	/* всего клиентов по менеджеру*/
	client_count int,
	
	/* всего клиентов по менеджеру
	с датой создания в интервале отчета*/
	new_client_count int,
	
	/* всего клиентов по менеджеру
	с отгрузками в интервале отчета ИЗ НОВЫХ КЛИЕНТОВ!!!*/
	buyer_count int,
	
	/* отношение покупателей к новым*/
	manager_k numeric,

	/* всего клиентов по менеджеру
	с отгрузками в интервале отчета ИЗ ВСЕХ КЛИЕНТОВ!!!*/
	buyer_count_from_all int,
	
	/* общий объем отгруженного по менеджеру
	новами клиентами (дата создания)*/
	manager_new_client_quant numeric,
	
	/* всего отгружено по менеджеру*/
	manager_quant numeric
	
  ) AS
$BODY$
	WITH
		det AS
		(SELECT DISTINCT ON (ast.client_id)
			cl.manager_id AS user_id,
			ast.client_id AS client_id,
			CASE
				WHEN (coalesce(o.quant,0)>0)
				AND (cl.create_date BETWEEN $1 AND $2) THEN 1
				ELSE 0
			END
			AS is_buyer,
			CASE
				WHEN (coalesce(o.quant,0)>0) THEN 1
				ELSE 0
			END
			AS is_buyer_from_all,
			
			coalesce(o.quant,0) AS quant,
			
			CASE
				WHEN (cl.create_date BETWEEN $1 AND $2) THEN 1
				ELSE 0
			END AS is_new
					
		FROM ast_calls AS ast
		LEFT JOIN clients cl ON cl.id=ast.client_id
		LEFT JOIN users u ON u.id=cl.manager_id		
		LEFT JOIN (
			SELECT
				orders.client_id,
				SUM(sh.quant) AS quant
			FROM shipments AS sh
			LEFT JOIN orders ON orders.id=sh.order_id
			WHERE sh.shipped
			GROUP BY orders.client_id						
			) AS o ON o.client_id=ast.client_id
		WHERE ast.client_id IS NOT NULL AND call_type='in'
			AND (($3=0 OR $3 IS NULL) OR ($3>0 AND $3=ast.user_id))
			AND ast.dt BETWEEN $1 AND $2
		)

	SELECT
		main.user_id AS manager_id,
		u.name::text AS manager_descr,
		
		COALESCE(
		COUNT(DISTINCT main.client_id),0)::int AS client_count,
		
		COALESCE(
			(SELECT SUM(tt.is_new) FROM (SELECT DISTINCT ON (t.client_id) t.is_new FROM det AS t WHERE t.user_id=main.user_id) AS tt)
		,0)::int AS new_client_count,		
		
		COALESCE(
			(SELECT SUM(tt.is_buyer) FROM (SELECT DISTINCT ON (t.client_id) t.is_buyer FROM det AS t WHERE t.user_id=main.user_id) AS tt)
		,0)::int AS buyer_count,		
		
		CASE
			WHEN (SELECT SUM(tt.is_new) FROM (SELECT DISTINCT ON (t.client_id) t.is_new FROM det AS t WHERE t.user_id=main.user_id) AS tt)=0 THEN 0
			ELSE
				COALESCE(
				ROUND(
					(SELECT SUM(tt.is_buyer) FROM (SELECT DISTINCT ON (t.client_id) t.is_buyer FROM det AS t WHERE t.user_id=main.user_id) AS tt)::numeric
					/
					(SELECT SUM(tt.is_new) FROM (SELECT DISTINCT ON (t.client_id) t.is_new FROM det AS t WHERE t.user_id=main.user_id) AS tt)::numeric
				,2)
				,0)::numeric
		END
		AS manager_k,
		
		COALESCE(
			(SELECT SUM(tt.is_buyer_from_all) FROM (SELECT DISTINCT ON (t.client_id) t.is_buyer_from_all FROM det AS t WHERE t.user_id=main.user_id) AS tt)
		,0)::int AS buyer_count_from_all,		
		
		COALESCE(
			(SELECT SUM(t3.quant)
			FROM det AS t3
			WHERE t3.user_id=main.user_id
				AND t3.is_new=1
			)
		,0)::numeric AS manager_new_client_quant,
		
		COALESCE(SUM(main.quant),0)::numeric AS manager_quant
		
	FROM det AS main	
	LEFT JOIN users AS u ON u.id=main.user_id
	GROUP BY main.user_id,u.name::text
	ORDER BY u.name::text
	;
$BODY$
  LANGUAGE sql VOLATILE
  CALLED ON NULL INPUT
  COST 100;
ALTER FUNCTION ast_calls_report(timestamp,timestamp,int)
  OWNER TO beton;
