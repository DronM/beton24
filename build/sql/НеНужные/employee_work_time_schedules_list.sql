-- Function: employee_work_time_schedules_list(date,date)

-- DROP FUNCTION employee_work_time_schedules_list(date,date);

CREATE OR REPLACE FUNCTION employee_work_time_schedules_list(date,date)
  RETURNS TABLE(
	employee_id int,
	employee_descr text,
	day date,
	hours int,
	day_off boolean
)  AS
$BODY$

	SELECT
		e.id AS employee_id,
		e.name::text As employee_descr,
		m_date::date AS day,
		w.hours AS hours,
		(EXTRACT(DOW FROM m_date)=6 OR EXTRACT(DOW FROM m_date)=0) AS day_off
	FROM employees e
	CROSS JOIN generate_series($1::date,$2::date,'1 day'::interval) AS m_date
	LEFT JOIN employee_work_time_schedules AS w ON w.employee_id=e.id AND w.day=m_date::date
	WHERE e.employed
	ORDER BY e.name,m_date::date
	;
$BODY$
  LANGUAGE sql VOLATILE
  COST 100;
ALTER FUNCTION employee_work_time_schedules_list(date,date)
  OWNER TO beton;
	