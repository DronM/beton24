-- View: mat_current_state

--DROP VIEW mat_current_state;

CREATE OR REPLACE VIEW mat_current_state AS 
	WITH mat AS (
		SELECT
			m.id,
			m.name
		FROM raw_materials AS m
		WHERE m.concrete_part
		ORDER BY m.ord
	)
	SELECT
		m.id AS material_id,
		m.name AS material_descr,
		COALESCE(orders.quant,0) AS ordered,
		COALESCE(procur.quant,0) AS procured,
		COALESCE(consump.quant,0) AS balance
	FROM mat m
	--Из заявок поставщиков
	LEFT JOIN (
		SELECT 
			o.material_id,
			sum(o.quant) AS quant
		FROM supplier_orders o
		WHERE o.date=now()::date
		GROUP BY o.material_id
	) AS orders ON orders.material_id=m.id
	--Фактический приход
	LEFT JOIN (
		SELECT 
			ra.material_id,
			sum(ra.quant) AS quant
		FROM ra_materials ra
		WHERE ra.date_time BETWEEN get_shift_start(now()::timestamp) AND get_shift_end(get_shift_start(now()::timestamp))
			AND ra.doc_type='material_procurement'::doc_types
			AND ra.deb
		GROUP BY ra.material_id
	) AS procur ON procur.material_id=m.id

	--Фактический ОСТАТОК
	LEFT JOIN (
		SELECT 
			rg.material_id,
			sum(rg.quant) AS quant
		FROM rg_materials_balance(ARRAY(SELECT t.id FROM mat t)) rg
		GROUP BY rg.material_id
	) AS consump ON consump.material_id=m.id
	
	
	;

ALTER TABLE mat_current_state OWNER TO beton;
