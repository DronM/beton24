-- VIEW: calls_active

DROP VIEW calls_active;

CREATE OR REPLACE VIEW calls_active AS
	SELECT DISTINCT ON (ast.ext)
		ast.unique_id::text,
		ast.ext,
		ast.call_type,
		ast.caller_id_num::text AS caller_id_num,		
		ast.dt AS ring_time,		
		ast.start_time AS answer_time,		
		ast.end_time AS hangup_time,

		--contact_details
		ast.contact_detail_id,
		ctd.name AS contact_detail_name,

		--contact
		ast.contact_id,
		ct.post AS contact_post,
		ct.last_name AS contact_last_name,
		ct.first_name AS contact_first_name,
		ct.middle_name AS contact_middle_name,
		coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'')||' '||coalesce(ct.middle_name,'') AS contact_name,
		ct.description AS contact_description,

		--clients	
		ast.client_id,
		cl.name::text AS client_descr
	FROM calls AS ast

	LEFT JOIN contact_details AS ctd ON ctd.id=ast.contact_detail_id
	LEFT JOIN contacts AS ct ON ct.id=ast.contact_id
	LEFT JOIN clients AS cl ON cl.id=ast.client_id
	
	WHERE
		ast.end_time IS NULL
		AND char_length(ast.ext)<>char_length(ast.caller_id_num)
		AND ast.caller_id_num<>''
	ORDER BY ast.ext,ast.dt DESC
	;
	
ALTER VIEW calls_active OWNER TO beton;
