-- Function: email_user_reset_pwd(user_id integer,pwd varchar(32))

--DROP FUNCTION email_user_reset_pwd(integer,varchar(32));

CREATE OR REPLACE FUNCTION email_user_reset_pwd(integer,varchar(32))
  RETURNS RECORD AS
$BODY$
	WITH 
		templ AS (
		SELECT
			t.template AS v,
			t.mes_subject AS s
		FROM email_templates t
		WHERE t.email_type='reset_pwd'
		)	
	SELECT
		sms_templates_text(
			ARRAY[
			format('("name","%s")',
				u.name::text)::template_value,
			format('("pwd","%s")',
				$2::text)::template_value				
			],
			(SELECT v FROM templ)
		)
		AS mes_body,		
		u.email::text AS email,
		(SELECT s FROM templ) AS mes_subject,
		'Еробетон'::text AS name_from,
		u.name::text AS name_to
	FROM users u
	WHERE u.id=$1
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION email_user_reset_pwd(integer,pwd varchar(32)) OWNER TO polimerplast;
