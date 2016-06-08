-- Function: doc_material_procurements_process()

-- DROP FUNCTION doc_material_procurements_process();

CREATE OR REPLACE FUNCTION doc_material_procurements_process()
  RETURNS trigger AS
$BODY$
DECLARE
	reg_act ra_materials%ROWTYPE;
			BEGIN
				IF (TG_WHEN='BEFORE' AND TG_OP='INSERT') THEN
					--SELECT coalesce(MAX(d.number),0)+1 INTO NEW.number FROM doc_material_procurements AS d;
					
					RETURN NEW;
				ELSIF (TG_WHEN='AFTER') THEN
					IF (TG_OP='INSERT') THEN
						--log
						INSERT INTO doc_log (doc_type,doc_id)
						VALUES ('material_procurement'::doc_types,NEW.id);
					END IF;

					--register actions
					--reg acts				
					reg_act.date_time		= NEW.date_time;
					reg_act.deb			= true;
					reg_act.doc_type  		= 'material_procurement'::doc_types;
					reg_act.doc_id  		= NEW.id;
					reg_act.material_id		= NEW.material_id;
					reg_act.quant			= NEW.quant_net;
					PERFORM ra_materials_add_act(reg_act);	
					
					RETURN NEW;
				ELSIF (TG_WHEN='BEFORE' AND TG_OP='UPDATE') THEN
					RETURN NEW;
				ELSIF (TG_WHEN='AFTER' AND TG_OP='UPDATE') THEN
					RETURN NEW;
				ELSIF (TG_WHEN='BEFORE' AND TG_OP='DELETE') THEN
					--detail tables
									
					
					--register actions					
					
					PERFORM ra_materials_remove_acts('material_procurement'::doc_types,OLD.id);
														
					
					--log
					DELETE FROM doc_log WHERE
					doc_type='material_procurement'::doc_types
					AND doc_id=OLD.id;
					
					RETURN OLD;
				ELSIF (TG_WHEN='AFTER' AND TG_OP='DELETE') THEN
					RETURN OLD;
				END IF;
			END;
			$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION doc_material_procurements_process()
  OWNER TO beton;
