SELECT
	sub.dt,
	get_month_str(sub.dt)||' '||EXTRACT(YEAR FROM sub.dt) AS mon,
	sub.expense_type_id,
	sub.expense_type_descr,
	sum(sub.total_expences) AS total_expences,
	sum(sub.total_sales) AS total_sales,
	sum(sub.total_mat_disp) AS total_mat_disp,
	sum(sub.total_mat_cost) AS total_mat_cost
FROM
(
	(SELECT
		date_trunc('month', exp_h.date_time)::date AS dt,
		exp_t.expence_type_id AS expense_type_id,
		exp.name::text AS expense_type_descr,
		sum(exp_t.total) AS total_expences,
		0::numeric AS total_sales,
		0::numeric AS total_mat_disp,
		0::numeric AS total_mat_cost
		
	FROM doc_expences_t_expence_types AS exp_t
	LEFT JOIN doc_expences AS exp_h ON exp_h.id=exp_t.doc_id
	LEFT JOIN expence_types AS exp ON exp.id=exp_t.expence_type_id
	GROUP BY
		date_trunc('month', exp_h.date_time),
		exp_t.expence_type_id,
		exp.name
	)

	UNION ALL

	(SELECT
		date_trunc('month', s.date_time)::date AS dt,
		NULL AS expense_type_id,
		NULL AS expense_type_descr,
		0::numeric AS total_expences,
		sum(s.total) AS total_sales,
		0::numeric AS total_mat_disp,
		0::numeric AS total_mat_cost
		
	FROM doc_sales AS s
	GROUP BY date_trunc('month', s.date_time)
	)

	UNION ALL

	(SELECT
		date_trunc('month', ra.date_time)::date AS dt,
		
		NULL AS expense_type_id,
		NULL AS expense_type_descr,
		0::numeric AS total_expences,
		0::numeric AS total_sales,
			
		sum(CASE
			WHEN ra.doc_type='material_disposal' THEN ra.cost
			ELSE 0
		END) AS total_mat_disp,

		sum(CASE
			WHEN ra.doc_type IN ('production','sale')
				THEN ra.cost
			ELSE 0
		END) AS total_mat_cost
		
	FROM ra_materials AS ra
	WHERE ra.deb=FALSE
	GROUP BY date_trunc('month', ra.date_time)
	)
) AS sub
GROUP BY
	sub.dt,
	mon,
	sub.expense_type_id,
	sub.expense_type_descr
ORDER BY sub.dt	
