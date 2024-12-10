<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $sql = "SELECT * FROM employees";
        $result = $conn->query($sql);
        if($result !== FALSE){
            $employees = $result->fetch_all(MYSQLI_ASSOC);
            // print_r($result);
            // echo '<br><br><br><br><br><br>';
            // print_r($employees);

        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
            $conn->close();
        }
    ?>
    <table border='1'>
        <?php foreach($employees as $emp){ ?>
            <tr>
                <td><?php echo $emp['employeeId'];?></td>
                <td><?php echo $emp['firstname'];?></td>
                <td><?php echo $emp['lastname'];?></td>
                <td><?php echo $emp['email'];?></td>
                <td><?php echo $emp['phone'];?></td>
                <td><button> view record </button></td>
            </tr>
        <?php }?>
    </table>
</body>
</html>