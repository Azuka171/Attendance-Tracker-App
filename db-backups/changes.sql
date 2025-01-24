CREATE TABLE temp_table AS 
SELECT MIN(id) AS min_id, employeeId, `date`, timeIn, timeOut
FROM attendance
GROUP BY  employeeId, `date`, timeIn, timeOut;

DELETE FROM attendance;

CREATE TABLE temp_attendance AS
SELECT MIN(id) AS min_id, employeeId, `date`, timeIn
FROM attendance
GROUP BY employeeId, `date`, timeIn;

DELETE FROM attendance;


INSERT INTO attendance
SELECT a.*
FROM temp_attendance t
JOIN attendance a ON t.min_id = a.id;

DROP TABLE temp_attendance;