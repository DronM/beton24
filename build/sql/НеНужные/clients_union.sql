-- Function: clients_union(in_main_client_id integer, in_client_ids integer[])

-- DROP FUNCTION clients_union(in_main_client_id integer, in_client_ids integer[]);

CREATE OR REPLACE FUNCTION clients_union(in_main_client_id integer, in_client_ids integer[])
  RETURNS VOID AS
$BODY$
DECLARE
	rel_row RECORD;
	--t text;
BEGIN	
	--t = '';
	FOR rel_row IN	
		SELECT
			tc.table_name,
			kcu.column_name
		FROM information_schema.referential_constraints AS rc
			JOIN information_schema.table_constraints AS tc USING(constraint_catalog,constraint_schema,constraint_name)
			JOIN information_schema.key_column_usage AS kcu USING(constraint_catalog,constraint_schema,constraint_name)
			JOIN information_schema.key_column_usage AS ccu ON(ccu.constraint_catalog=rc.unique_constraint_catalog AND ccu.constraint_schema=rc.unique_constraint_schema AND ccu.constraint_name=rc.unique_constraint_name)
		WHERE 
			ccu.table_catalog='beton'
			AND ccu.table_schema='public'
			AND ccu.table_name='clients'
			AND ccu.column_name='id'
	LOOP
		FOR i IN 1..array_upper(in_client_ids, 1) LOOP
			IF in_client_ids[i]<>in_main_client_id THEN
				IF rel_row.table_name='client_tels' THEN
					--t = t || ' '||
					EXECUTE format('DELETE FROM client_tels WHERE client_id=%s',in_client_ids[i]);
				ELSE
					--t = t || ' '||
					EXECUTE format('UPDATE %I SET %I=%s WHERE %I=%s',
						rel_row.table_name,
						rel_row.column_name,
						in_main_client_id,
						rel_row.column_name,
						in_client_ids[i]
						
					);
				END IF;				
			END IF;
		END LOOP;
	END LOOP;

	FOR i IN 1..array_upper(in_client_ids, 1) LOOP
		--t = t || ' '||
		EXECUTE format('DELETE FROM clients WHERE id=%s',in_client_ids[i]);
	END LOOP;
	
	--RAISE '%',t;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION clients_union(in_main_client_id integer, in_client_ids integer[])
  OWNER TO beton;
