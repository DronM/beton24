-- View: sms_patterns_list_view

--DROP VIEW sms_patterns_list_view;

CREATE OR REPLACE VIEW sms_patterns_list_view AS 
 SELECT p.id,
    p.sms_type,
    get_sms_types_descr(p.sms_type) AS sms_type_descr,
    l.name AS lang_descr,
    l.id AS lang_id,
    p.pattern,
	array_to_string(p.fields, ',') as fields
   FROM sms_patterns p
     LEFT JOIN langs l ON l.id = p.lang_id
  ORDER BY p.sms_type, l.id;

ALTER TABLE sms_patterns_list_view
  OWNER TO beton;
