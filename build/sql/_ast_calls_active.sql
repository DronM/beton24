-- VIEW: ast_calls_active

--DROP VIEW ast_calls_active;

CREATE OR REPLACE VIEW ast_calls_active AS
	SELECT DISTINCT ON (ast.ext)
		ast.unique_id::text,
		ast.ext,
		ast.caller_id_num::text AS num,		
		format_phone(ast.caller_id_num::text) AS num_descr,
		ast.dt AS ring_time,		
		ast.start_time AS answer_time,		
		time8_descr(ast.start_time::time) AS answer_time_descr,		
		ast.end_time AS hangup_time,
		time8_descr(ast.end_time::time) AS hangup_time_descr,
		ast.client_id,
		cl.name::text AS client_descr,
		get_client_kinds_descr(cl.client_kind) AS client_kind_descr,
		ast.manager_comment::text AS manager_comment,
		ast.informed,
		clt.name AS contact_name,
		cld.debt,
		man.name AS client_manager_descr
		
	FROM ast_calls AS ast
	LEFT JOIN clients AS cl ON cl.id=ast.client_id
	LEFT JOIN users AS man ON cl.manager_id=man.id
	LEFT JOIN client_tels AS clt
		ON clt.client_id=ast.client_id
		AND clt.tel=format_cel_phone(RIGHT(ast.caller_id_num,10)) 
	LEFT JOIN client_debts AS cld ON cld.client_id=ast.client_id
	WHERE
		ast.end_time IS NULL
		AND char_length(ast.ext)<>char_length(ast.caller_id_num)
		AND ast.caller_id_num<>''
	ORDER BY ast.ext,ast.dt DESC
	;
	
ALTER VIEW ast_calls_active OWNER TO beton;
