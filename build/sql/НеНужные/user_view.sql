-- View: user_view

-- DROP VIEW user_view;

CREATE OR REPLACE VIEW user_view AS 
	SELECT users.id,
		users.name,
		users.email,
		users.role_id,
		get_role_types_descr(users.role_id) AS role_descr,
		users.tel_ext,
		users.phone_cel
	FROM users
	ORDER BY users.name;

ALTER TABLE user_view
  OWNER TO beton;
