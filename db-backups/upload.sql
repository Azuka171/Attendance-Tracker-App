SELECT e.first_name, e.last_name, a.timeIn, a.timeOut 
            FROM attendance a JOIN employees e
            WHERE a.date = '2024-10-10'
            
            
       
SELECT e.first_name, e.last_name, a.timeIn, a.timeOut 
FROM attendance a 
JOIN employees e ON e.id = a.employeeId
WHERE a.date = '2024-10-10'

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, date_of_employment) VALUES ( 'B15310663', 'Gideon', 'Azuka', 'gideonazuka100@gmail.com', '07025935847', 2025-01-22)