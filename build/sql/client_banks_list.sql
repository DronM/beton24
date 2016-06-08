-- VIEW: client_banks_list;

--DROP VIEW client_banks_list;

CREATE OR REPLACE VIEW client_banks_list AS
	SELECT
		cb.client_id,
		cb.bank_id,
		b.bik,
		b.name,
		b.account
	FROM client_banks cb
	LEFT JOIN banks b ON b.id=cb.bank_id
	;
	
ALTER VIEW client_banks_list OWNER TO beton;
