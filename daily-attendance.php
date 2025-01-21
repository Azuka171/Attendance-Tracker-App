<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee daily attendance page</title>
</head>
<body>
    <h1>Daily Attendance</h1>
    <form action="" method="GET">
        <input type="date" name="selected_date"  value="
            <?php if(isset($_GET['selected_date'])){
                echo $_GET['selected_date'];
            }?>"
        >
        <input type="submit" value="Select">
    </form>
        <h4 style="text-align: center; color:black">
            <?php if(isset($_GET['selected_date'])){
                echo date('jS F, Y', strtotime($_GET['selected_date']));
            }?>
        </h4>
    <style>
        /* General body styling */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #343a40;
            line-height: 1.6;
        }

        /* Centered container styling */
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header styling */
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Form styling */
        form {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="date"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #ffffff;
        }

        table thead {
            background-color: #007bff;
            color: white;
        }

        table th, table td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        table tbody tr:hover {
            background-color: #e9ecef;
        }

        /* No records message */
        tbody td[colspan="3"] {
            text-align: center;
            color: #6c757d;
            font-style: italic;
        }

        /* Footer styling */
        footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
    <?php 
        $selected_date = $_GET['selected_date'] ??  date('Y-m-d');
        // $sql = "SELECT e.first_name, e.last_name, a.timeIn, a.timeOut 
        //     FROM attendance a JOIN employees e
        //     WHERE a.date = '$selected_date'
        $sql = "SELECT e.first_name, e.last_name, a.timeIn, a.timeOut 
            FROM attendance a 
            JOIN employees e ON e.id= a.employeeId
            WHERE a.date = '$selected_date'
        ";
        // echo $sql;die;
        $result = $conn->query($sql);
        if($result !== FALSE ){
            $attendance_rec = $result->fetch_all(MYSQLI_ASSOC);
        }else{
            echo "Error". "<br>". $conn->error;
            $conn->close();
        }
    ?>
    <table border="1">
        <thead>
            <tr>
                <td>Full Name</td>
                <td>Time In</td>
                <td>Time Out</td>
            </tr>
        </thead>
        <tbody>
        <?php 
            if($attendance_rec){
                foreach($attendance_rec as $record){
        ?>
                    <tr>
                        <td><?php echo $record['first_name'].' '.$record['last_name']?></td>
                        <td><?php echo date('h:i:s a',strtotime($record['timeIn']))?></td>
                        <td><?php echo date('h:i:s a',strtotime($record['timeOut']))?></td>
                    </tr>
        <?php
                }
            }else{
                echo "<tr><td colspan='3'> No employee attendance Record Found for $selected_date </td></tr>";
            }
        ?>
        </tbody>
    </table>
</body>
</html>