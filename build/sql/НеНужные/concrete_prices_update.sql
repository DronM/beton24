-- Function: concrete_prices_update(IN in_concrete_type_id int, IN in_date_time timestamp, IN in_price numeric(15,2))

--DROP FUNCTION concrete_prices_update(IN in_concrete_type_id int, IN in_date_time timestamp, IN in_price numeric(15,2))

CREATE OR REPLACE FUNCTION concrete_prices_update(
	IN in_concrete_type_id int,
	IN in_date_time timestamp,
	IN in_price numeric(15,2)
)
RETURNS void as $$
BEGIN
	UPDATE concrete_prices
		SET price = in_price
	WHERE concrete_type_id=in_concrete_type_id
		AND date_time=in_date_time;
	
	IF FOUND THEN
		RETURN;
	END IF;
	BEGIN
		INSERT INTO concrete_prices (concrete_type_id, date_time, price)
		VALUES (in_concrete_type_id, in_date_time, price);
	EXCEPTION WHEN OTHERS THEN
		UPDATE concrete_prices
			SET price = in_price
		WHERE concrete_type_id=in_concrete_type_id
			AND date_time=in_date_time;
		END;
	RETURN;
END;
$$ language plpgsql;

ALTER FUNCTION concrete_prices_update(IN in_concrete_type_id int, IN in_date_time timestamp, IN in_price numeric(15,2))
OWNER TO beton;
