-- View: sms_pump_order_del

--DROP VIEW sms_pump_order_del;

CREATE OR REPLACE VIEW sms_pump_order_del AS 
	SELECT
		o.id AS order_id,
		pvh.phone_cel,
		sms_templates_text(
			ARRAY[
			format('("quant","%s")',
				o.quant::text)::template_value,
			format('("date","%s")',
				date5_descr(o.date_time::date)::text)::template_value,
			format('("time","%s")',
				time5_descr(o.date_time::time)::text)::template_value,
			format('("date","%s")',
				date8_descr(o.date_time::date)::text)::template_value,
			format('("dest","%s")',
				dest.name::text)::template_value,				
			format('("concrete","%s")',
				ct.name::text)::template_value,
			format('("client","%s")',
				cl.name::text)::template_value,
			format('("name","%s")',
				o.descr::text)::template_value,		
			format('("tel","%s")',
				o.phone_cel::text)::template_value,
			format('("car","%s")',
				vh.plate::text)::template_value								
			],
			(SELECT t.pattern FROM sms_patterns t
			WHERE t.sms_type='order_for_pump_del'::sms_types
			AND t.lang_id=1)
		) AS message
		
	FROM orders o	
	LEFT JOIN concrete_types ct ON ct.id=o.concrete_type_id	
	LEFT JOIN destinations dest ON
		dest.id=o.destination_id		
	LEFT JOIN pump_vehicles pvh ON pvh.id=o.pump_vehicle_id
	LEFT JOIN vehicles vh ON vh.id=pvh.vehicle_id
	LEFT JOIN clients cl ON cl.id=o.client_id
	WHERE o.pump_vehicle_id IS NOT NULL
		AND pvh.phone_cel IS NOT NULL
		AND pvh.phone_cel<>''
		AND o.quant<>0
		AND o.pump_vehicle_id IS NOT NULL
	;
ALTER TABLE sms_pump_order_del OWNER TO beton;