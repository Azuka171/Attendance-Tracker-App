<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee details page</title>
</head>
<body>
    <?php if($_GET['id']){?>
        <?php
            $id = $_GET['id']; 

            $emp_query = "SELECT * FROM employees WHERE id = $id";
            $emp_result = $conn->query($emp_query);
            $employee_name = $emp_result;
            $employee_id = "N/A";
            if ($emp_result && $emp_result->num_rows > 0) {
                $emp_data = $emp_result->fetch_assoc();
                $employee_name = $emp_data['first_name'] . " " . $emp_data['last_name'];
                $employee_id = $emp_data['id'];
            }

            $sql = "SELECT  * FROM attendance WHERE employeeId = $id AND MONTH(date) = $month AND YEAR(date) = $year";
            $result = $conn->query($sql);
            if($result !== FALSE){
                $emp_records = $result->fetch_all(MYSQLI_ASSOC);          
                $abs_days = $total_w_days - count($emp_records);
            }else{
                echo "Error". $sql . "<br>" . $conn->error;
                $conn->close();
            }
        ?>
    <?php}else{?>
        <div>No valid employee selected. Go back to employee page <a href="./employee-records.php"></a></div>
    <?php}?>
</body>
</html>