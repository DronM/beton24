-- View: lab_orders_list

--DROP VIEW lab_orders_list;

CREATE OR REPLACE VIEW lab_orders_list AS 
	SELECT
		o.*,
		CASE
			WHEN need_t.need_cnt>0 THEN 'нужно'
			ELSE ''
		END AS need
	FROM orders_make_list_view AS o
	LEFT JOIN lab_entry_30days AS need_t ON need_t.concrete_type_id=o.concrete_type_id
	WHERE o.date_time BETWEEN get_shift_start(now()::timestamp) AND get_shift_end(get_shift_start(now()::timestamp))
	;
ALTER TABLE lab_orders_list OWNER TO beton;	
		