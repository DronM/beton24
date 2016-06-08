DELETE FROM rg_materials WHERE date_time::date='3000-01-01 00:00:00';

INSERT INTO rg_materials (date_time,material_id,quant)
(SELECT 
	'3000-01-01 00:00:00',
	material_id,
	quant+
	(
		SELECT sum(quant) FROM ra_materials as r WHERE r.date_time BETWEEN '2014-10-01 00:00:00' AND '2014-12-01 00:00:00' AND deb=TRUE
	)
	-
	(
		SELECT sum(quant) FROM ra_materials as r WHERE r.date_time BETWEEN '2014-10-01 00:00:00' AND '2014-12-01 00:00:00' AND deb=FALSE
	)
	AS quant
	
 FROM rg_materials WHERE date_time::date='2014-10-01 00:00:00'
 )
--SELECT * FROM rg_materials WHERE date_time::date='2014-10-01 00:00:00'