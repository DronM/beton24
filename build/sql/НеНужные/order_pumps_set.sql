-- Function: order_pumps_set(order_pumps)

--DROP FUNCTION order_pumps_set(order_pumps)

CREATE OR REPLACE FUNCTION order_pumps_set(order_pumps)
RETURNS void as $$
BEGIN
	IF ($1.comment IS NULL OR $1.comment='')
	AND $1.viewed=FALSE THEN
		DELETE FROM order_pumps WHERE order_id = $1.order_id;
	ELSE
		UPDATE order_pumps
		SET comment = $1.comment,
			viewed = $1.viewed
		WHERE order_id = $1.order_id;
		
		IF NOT FOUND THEN
			BEGIN
				INSERT INTO order_pumps
				(order_id,comment,viewed)
				VALUES
				($1.order_id,$1.comment,$1.viewed);
			EXCEPTION WHEN OTHERS THEN
				UPDATE order_pumps
				SET comment = $1.comment,
					viewed = $1.viewed
				WHERE order_id = $1.order_id;
			END;	
		END IF;	
	END IF;	
END;	
$$ language plpgsql;

ALTER FUNCTION order_pumps_set(order_pumps)
  OWNER TO beton;

