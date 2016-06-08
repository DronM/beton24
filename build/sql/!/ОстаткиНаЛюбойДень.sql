--SELECT get_shift_end(get_shift_start(now()::timestamp without time zone))+'1 second'

SELECT sum(sub.q) FROM(
SELECT  SUM(ra.quant) q FROM ra_materials ra WHERE ra.material_id=6 AND ra.date_time<'2014-11-02 07:00' AND ra.deb
UNION
SELECT  -SUM(ra.quant) q FROM ra_materials ra WHERE ra.material_id=6 AND ra.date_time<'2014-11-02 07:00' AND ra.deb=FALSE
) AS sub



SELECT
					rg.material_id,
					SUM(rg.quant) AS quant
				FROM rg_materials_balance1(
				--get_shift_end(get_shift_start(now()::timestamp without time zone))+'1 second'
				'2014-11-02 07:00'::timestamp
				,'{6}'
				
				) AS rg
				GROUP BY rg.material_id