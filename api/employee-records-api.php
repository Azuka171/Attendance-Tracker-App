<?php require_once '../db_connection.php';?>
<?php
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
    if($result !== FALSE){
        $employees_raw = $result->fetch_all();
        $employees = [];
        foreach ($employees_raw as $employee) {
            $employeeObject = new stdClass();
            $employeeObject->employeeId = $employee[0];
            $employeeObject->firstname = $employee[1];
            $employeeObject->lastname = $employee[2];
            $employeeObject->email = $employee[3];
            $employeeObject->phone = $employee[4];
            $employees[] = $employeeObject;
        }
        echo json_encode($employees);
    }else{
        echo 'error';
    }
?>

