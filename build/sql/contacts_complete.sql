-- View: contacts_complete

-- DROP VIEW contacts_complete;

CREATE OR REPLACE VIEW contacts_complete AS 
	SELECT
		ct.id,
		ct.post,
		coalesce(ct.last_name,'')||' '||coalesce(ct.first_name,'')||' '||coalesce(ct.middle_name,'') AS name
	FROM contacts ct
	ORDER BY ct.last_name||' '||ct.first_name;

ALTER TABLE contacts_complete OWNER TO beton;
