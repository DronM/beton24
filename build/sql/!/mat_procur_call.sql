SELECT * FROM mat_plan_procur1(
	get_shift_end(get_shift_start(now()::timestamp without time zone))+'1 second',
	'2014-12-07 06:59'::timestamp,
	get_shift_start(now()::timestamp without time zone- (const_days_for_plan_procur_val()||' days')::interval),
	get_shift_end(get_shift_start(now()::timestamp without time zone)-'1 day'::interval),
	(SELECT m.id FROM raw_materials  m
	WHERE m.name='Цемент')
	)