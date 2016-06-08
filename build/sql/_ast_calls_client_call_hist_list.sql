-- VIEW: ast_calls_client_call_hist_list

--DROP VIEW ast_calls_client_call_hist_list;

CREATE OR REPLACE VIEW ast_calls_client_call_hist_list AS
	SELECT
		ast.unique_id,
		ast.client_id,
		date8_time5_descr(ast.dt) AS dt_descr,
		ast.manager_comment
	FROM ast_calls AS ast	
	ORDER BY ast.dt;
ALTER VIEW ast_calls_client_call_hist_list OWNER TO beton;