<?php require_once '../db_connection.php';?>
<?php
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
    if($result !== FALSE){
        $employees_raw = $result->fetch_all();
        $employees = [];
        foreach ($employees_raw as $employee) {
            $employeeObject = new stdClass();
            $employeeObject->id = $employee[0];
            $employeeObject->employeeId = $employee[1];
            $employeeObject-> firstname = $employee[2];
            $employeeObject->lastname = $employee[3];
            $employeeObject->email = $employee[4];
            $employeeObject->phone = $employee[5];
            $employeeObject->date_of_employment = $employee[6];
            $employees[] = $employeeObject;
        }
        echo json_encode($employees);
    }else{
        echo 'error';
    }
?>

