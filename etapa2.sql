select 
	depts.dept_name as 'Departamento', 
	concat(emp.first_name, " ", emp.last_name) as 'Nome Completo', 
    datediff(dep.to_date,dep.from_date) as 'Dias Trabalhados' 
from 
	employees as emp
join 
	dept_emp as dep 
on 
	emp.emp_no = dep.emp_no 
join 
	departments as depts 
on 
	emp.dept_no = depts.dept_no 
order by 3 desc 
limit 10