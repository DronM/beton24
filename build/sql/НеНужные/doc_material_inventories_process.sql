--process function
CREATE OR REPLACE FUNCTION doc_material_inventories_process()
  RETURNS trigger AS
$BODY$
DECLARE
	v_sql text;
	balance RECORD;
	reg_act ra_materials%ROWTYPE;
	v_deb boolean;
	v_quant numeric;
BEGIN
	IF (TG_WHEN='BEFORE' AND TG_OP='INSERT') THEN
		SELECT coalesce(MAX(d.number),0)+1 INTO NEW.number FROM doc_material_inventories AS d;
		
		RETURN NEW;
	ELSIF (TG_WHEN='AFTER' AND TG_OP='INSERT') THEN
		--log
		PERFORM doc_log_insert('material_inventory'::doc_types,NEW.id,NEW.date_time);
	
		RETURN NEW;
	ELSIF (TG_WHEN='BEFORE' AND TG_OP='UPDATE') THEN
		--remove register actions					
		
		PERFORM ra_materials_remove_acts('material_inventory'::doc_types,OLD.id);
											
	
		IF NEW.date_time<>OLD.date_time THEN
			PERFORM doc_log_update('material_inventory'::doc_types,NEW.id,NEW.date_time);
		END IF;
	
		RETURN NEW;
	ELSIF (TG_WHEN='AFTER' AND TG_OP='UPDATE') THEN
		IF doc_operative_processing('material_inventory'::doc_types,NEW.id) THEN
			--OPERATIVE PROCESSING
			v_sql = 
			'SELECT doct.material_id,doct.quant,coalesce(b.balance,0) AS balance
			FROM doc_material_inventories_t_materials AS doct
			LEFT JOIN (SELECT subb.material_id,SUM(subb.quant) AS balance
					FROM rg_materials_balance(
						ARRAY(SELECT t.material_id FROM doc_material_inventories_t_materials AS t WHERE t.doc_id='|| NEW.id ||')
					) AS subb
					GROUP BY subb.material_id
				) AS b
				ON b.material_id=doct.material_id
			WHERE doct.doc_id='|| NEW.id;
		ELSE
			--!!! NOT OPERATIVE PROCESSING  !!!
			v_sql = 
			'SELECT doct.material_id,doct.quant,coalesce(b.balance,0) AS balance
			FROM doc_material_inventories_t_materials AS doct
			LEFT JOIN (SELECT subb.material_id,SUM(subb.quant) AS balance
					FROM rg_materials_balance(
						''material_inventory''::doc_types,
						'|| NEW.id ||',
						ARRAY(SELECT t.material_id FROM doc_material_inventories_t_materials AS t WHERE t.doc_id='|| NEW.id ||')
					) AS subb
					GROUP BY subb.material_id
				) AS b
				ON b.material_id=doct.material_id
			WHERE doct.doc_id='|| NEW.id;
		END IF;	
			
		FOR balance IN EXECUTE v_sql LOOP
			IF balance.quant>balance.balance THEN
				v_deb=true;
				v_quant=balance.quant-balance.balance;
			ELSIF balance.quant<balance.balance THEN
				v_deb=false;
				v_quant=balance.balance-balance.quant;
			ELSE
				v_quant=0;						
			END IF;
			IF (v_quant>0) THEN
				reg_act.date_time		= NEW.date_time;
				reg_act.deb			= v_deb;
				reg_act.doc_type  		= 'material_inventory'::doc_types;
				reg_act.doc_id  		= NEW.id;
				reg_act.material_id		= balance.material_id;
				reg_act.quant			= v_quant;
				PERFORM ra_materials_add_act(reg_act);
			END IF;	
			
		END LOOP;
	
		RETURN NEW;
	ELSIF (TG_WHEN='BEFORE' AND TG_OP='DELETE') THEN
		--detail tables
		
		DELETE FROM doc_material_inventories_t_materials WHERE doc_id=OLD.id;
						
		
		--register actions					
		
		PERFORM ra_materials_remove_acts('material_inventory'::doc_types,OLD.id);
											
		
		--log
		PERFORM doc_log_delete('material_inventory'::doc_types,OLD.id);
		
		RETURN OLD;
	ELSIF (TG_WHEN='AFTER' AND TG_OP='DELETE') THEN
		RETURN OLD;
	END IF;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE COST 100;

ALTER FUNCTION doc_material_inventories_process() OWNER TO beton;
