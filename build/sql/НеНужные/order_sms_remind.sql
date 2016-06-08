-- View: order_sms_remind

--DROP VIEW order_sms_remind;

CREATE OR REPLACE VIEW order_sms_remind AS 
	WITH shift AS
		(SELECT * FROM get_shift_bounds((CURRENT_TIMESTAMP+'1 day'::interval)::timestamp without time zone) AS (shift_start timestamp,shift_end timestamp))
		
	SELECT o.phone_cel,
	replace( 
		replace( 
			replace( 
				replace( 
					replace( 
						(SELECT pt.pattern AS text FROM sms_patterns AS pt WHERE pt.lang_id=o.lang_id AND pt.sms_type='remind'::sms_types), '[quant]'::text , o.quant::text
					), '[dest]'::text, d.name
				), '[concrete]',concr.name
			),'[date]',date8_descr((now()+'1 day')::date)
		),'[day_of_week]',dow_descr((now()+'1 day')::date)
	)
	AS text,
	s.id AS sms_serv_id
		
	FROM sms_service AS s
	LEFT JOIN orders AS o ON o.id=s.order_id
	LEFT JOIN concrete_types AS concr ON concr.id=o.concrete_type_id
	LEFT JOIN destinations AS d ON d.id=o.destination_id
	WHERE o.date_time BETWEEN (SELECT shift_start FROM shift) AND (SELECT shift_end FROM shift)
	AND s.sms_id_remind IS NULL;

ALTER TABLE order_sms_remind OWNER TO beton;
