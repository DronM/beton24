-- View: lab_entry_detail_list_view

-- DROP VIEW lab_entry_detail_list_view;

CREATE OR REPLACE VIEW lab_entry_detail_list_view AS 
 SELECT sh.id AS shipment_id, lab.id, (sh.id::text || '/'::text) || lab.id::text AS code, date5_descr(sh.date_time::date) AS ship_date_time_descr, lab.ok, lab.weight, round(
        CASE
            WHEN concr.pres_norm IS NOT NULL AND concr.pres_norm > 0::numeric THEN (( SELECT avg(round(s_lab_det.kn::numeric / concr.mpa_ratio,2)) AS avg
               FROM lab_entry_details s_lab_det
              WHERE s_lab_det.shipment_id = sh.id AND s_lab_det.id < 3)) / concr.pres_norm * 100::numeric
            ELSE 0::numeric
        END) AS p7, round(
        CASE
            WHEN concr.pres_norm IS NOT NULL AND concr.pres_norm > 0::numeric THEN (( SELECT avg(round(s_lab_det.kn::numeric / concr.mpa_ratio,2)) AS avg
               FROM lab_entry_details s_lab_det
              WHERE s_lab_det.shipment_id = sh.id AND s_lab_det.id >= 3)) / concr.pres_norm * 100::numeric
            ELSE 0::numeric
        END) AS p28, 
        CASE
            WHEN lab.id < 3 THEN date5_descr((sh.date_time::date + '7 days'::interval)::date)
            ELSE date5_descr((sh.date_time::date + '28 days'::interval)::date)
        END AS p_date_time_descr, lab.kn, round(lab.kn::numeric / concr.mpa_ratio, 2) AS mpa, round(
        CASE
            WHEN lab.id < 3 THEN ( SELECT avg(round(s_lab_det.kn::numeric / concr.mpa_ratio,2)) AS avg
               FROM lab_entry_details s_lab_det
              WHERE s_lab_det.shipment_id = sh.id AND s_lab_det.id < 3)
            ELSE ( SELECT avg(round(s_lab_det.kn::numeric / concr.mpa_ratio,2)) AS avg
               FROM lab_entry_details s_lab_det
              WHERE s_lab_det.shipment_id = sh.id AND s_lab_det.id >= 3)
        END, 2) AS mpa_avg, concr.pres_norm
   FROM lab_entry_details lab
   LEFT JOIN shipments sh ON sh.id = lab.shipment_id
   LEFT JOIN orders o ON o.id = sh.order_id
   LEFT JOIN concrete_types concr ON concr.id = o.concrete_type_id
  ORDER BY lab.shipment_id, lab.id;

ALTER TABLE lab_entry_detail_list_view
  OWNER TO beton;

