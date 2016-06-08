SELECT DISTINCT(v.plate)
FROM car_tracking AS t
LEFT JOIN vehicles AS v ON v.tracker_id=t.car_id
WHERE t.period BETWEEN '2014-07-01 00:00:00'::timestamp-'6 hours'::interval AND '2014-07-31 23:59:59'::timestamp-'6 hours'::interval
ORDER BY v.plate