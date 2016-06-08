-- View: mat_balance_for_sms

DROP VIEW mat_balance_for_sms;

CREATE OR REPLACE VIEW mat_balance_for_sms AS 
	SELECT
		concrete_short_name(m.name::text) AS mat,
		b.quant
	FROM rg_materials_balance(now()::timestamp without time zone,
		(SELECT
			ARRAY(SELECT id FROM raw_materials
				WHERE concrete_part=TRUE
			)
		)
	) AS b
	LEFT JOIN raw_materials AS m ON m.id=b.material_id
	ORDER BY m.ord;

ALTER TABLE mat_balance_for_sms OWNER TO beton;
