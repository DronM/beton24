-- View: mat_cur_shift_virt_cons

-- DROP VIEW mat_cur_shift_virt_cons;

CREATE OR REPLACE VIEW mat_cur_shift_virt_cons AS 
	SELECT
		sub.material_id,
		SUM(sub.mat_cons) AS quant
	FROM (SELECT
		mr.material_id,
		mr.rate*SUM(
			COALESCE(o.quant,0)-
			COALESCE(
				(SELECT sum(sh.quant) FROM shipments sh WHERE sh.order_id=o.id)
			,0)
		) AS mat_cons
		FROM orders o
		LEFT JOIN (
			SELECT
				r.concrete_type_id,
				r.material_id,
				r.rate
			FROM raw_material_cons_rates(0,now()::timestamp) AS r
		) AS mr ON mr.concrete_type_id=o.concrete_type_id
		WHERE o.date_time BETWEEN get_shift_start(now()::timestamp) AND get_shift_end(get_shift_start(now()::timestamp))
		GROUP BY mr.rate,mr.material_id
		HAVING
			SUM(
				COALESCE(o.quant,0)-
				COALESCE(
					(SELECT sum(sh.quant) FROM shipments sh WHERE sh.order_id=o.id)
			,0))>0
	) AS sub
	GROUP BY sub.material_id
	;
ALTER TABLE mat_cur_shift_virt_cons
  OWNER TO beton;
