-- View: raw_material_cons_rates_dates_view

-- DROP VIEW raw_material_cons_rates_dates_view;

CREATE OR REPLACE VIEW raw_material_cons_rates_dates_view AS 
	SELECT
		d_from.id,
		d_from.dt,
		date8_descr(d_from.dt) AS dt_descr,
		(date8_descr(d_from.dt)::text || ' - '::text) || COALESCE(
		(
			SELECT
				date8_descr((d_to.dt - '1 day'::interval)::date)::text AS date
			FROM raw_material_cons_rate_dates d_to
			WHERE d_to.dt > d_from.dt
			ORDER BY d_to.dt ASC
			LIMIT 1
		), 
		CASE
		WHEN now()::date<d_from.dt THEN '---'
		ELSE date8_descr(now()::date)::text
		END
		) AS period,
		d_from.name
		
   FROM raw_material_cons_rate_dates d_from ORDER BY d_from.dt;

ALTER TABLE raw_material_cons_rates_dates_view
  OWNER TO beton;

