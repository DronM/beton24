-- View: sms_pump_order

--DROP VIEW sms_pump_order;

CREATE OR REPLACE VIEW sms_pump_order AS 
	SELECT
		o.id AS order_id,
		pvh.phone_cel,
		sms_templates_text(
			ARRAY[
			format('("quant","%s")',
				o.quant::text)::template_value,
			format('("time","%s")',
				time5_descr(o.date_time::time)::text)::template_value,
			format('("date","%s")',
				date8_descr(o.date_time::date)::text)::template_value,
			format('("dest","%s")',
				dest.name::text)::template_value,				
			format('("concrete","%s")',
				ct.name::text)::template_value
			],
			(SELECT t.pattern FROM sms_patterns t
			WHERE t.sms_type='order_for_pump'::sms_types
			AND t.lang_id=1)
		) AS message
		
	FROM orders o	
	LEFT JOIN concrete_types ct ON ct.id=o.concrete_type_id	
	LEFT JOIN destinations dest ON
		dest.id=o.destination_id		
	LEFT JOIN pump_vehicles pvh ON pvh.id=o.pump_vehicle_id
	WHERE o.pump_vehicle_id IS NOT NULL
		AND pvh.phone_cel IS NOT NULL
		AND pvh.phone_cel<>''
		AND o.quant<>0
	;
ALTER TABLE sms_pump_order OWNER TO beton;