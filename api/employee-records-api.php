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
            $employeeObject->email = $employee[6];
            $employeeObject->phone = $employee[7];
            $employeeObject->date_of_employment = $employee[8];
            $employees[] = $employeeObject;
        }
        // print_r($employees_raw[0][8]);die;
        echo json_encode($employees);
    }else{
        echo 'error';
    }
?>

