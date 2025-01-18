<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to bottom, #4e54c8, #8f94fb);
            color: #333;
        }

        /* Header Styling */
        h1 {
            text-align: center;
            color: #fff;
            font-size: 28px;
            margin-bottom: 20px;
        }

        /* Summary Box Styling */
        .summary-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            margin: 20px auto;
        }

        div p {
            font-size: 16px;
            margin: 10px 0;
            font-weight: bold;
        }

        /* Form Styling */
        form {
            text-align: center;
            margin-bottom: 20px;
        }

        form input[type="month"],
        form input[type="submit"] {
            padding: 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        form input[type="month"] {
            width: 150px;
        }

        form input[type="submit"] {
            background: #4e54c8;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        form input[type="submit"]:hover {
            background: #3a41a7;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            overflow: hidden;
        }

        table thead {
            background: #4e54c8;
            color: #fff;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tbody tr:hover {
            background: #f1f1f1;
        }

        /* Button Styling */
        a button {
            background: #4e54c8;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            font-size: 14px;
            transition: background 0.3s ease-in-out;
        }

        a button:hover {
            background: #3a41a7;
        }
    </style>
    <h1>An Individual Monthly Attendance</h1>
    <!-- add box with summary -->
     <!-- 
    No. Days Present:
    No. Days Absent:
    Current Month:
       -->
    <?php if(isset($_GET['id'])){ 
        $months = [
            "01" => 'January',
            "02" => 'February',
            "03" => 'March',
            "04" => 'April',
            "05" => 'May',
            "06" => 'June',
            "07" => 'July',
            "08" => 'August',
            "09" => 'September',
            "10" => 'October',
            "11" => 'November',
            "12" => 'December'
        ];
        ?>
        <?php
            $id = $_GET['id']; 
            $selected_month = $_GET['month'] ?? date('Y-m');//null coalescing operator
            //2024-10
            $total_mon_days = date('t', strtotime($selected_month));
            //echo $total_mon_days; exit;
            // if month is current month -> total_w_days = date
            // else total_w_days = total_mon_days 
            // abs_days = total_w_days - no_records
            if($selected_month === date('Y-m')){
                $total_w_days = date('d');
            }else{$total_w_days = $total_mon_days;}

            
            $month = substr($selected_month, 5, 2 );
            $year = substr($selected_month, 0, 4);

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
        <form action="" method="GET">
            <input type="month" name="month">
            <input type="hidden" name="id" value="<?php echo $_GET['id']?>">
            <input type="submit" value="Filter">
        </form>
        <div class="summary-box">
            <p>No. Days Present:<?php echo count($emp_records)?> </p>
            <p>No. Days Absent: <?php echo $abs_days?></p>
            <p>Current Month:<?php echo date('F Y',strtotime($selected_month));?></p>
        </div>
        <table border = "1">
            <thead>
                <tr>
                    <td>Day</td>
                    <td>Date</td>
                    <td>TimeIn</td>
                    <td>TimeOut</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($emp_records){
                        foreach($emp_records as $record){
                ?>
                            <tr>
                                <td><?php echo date('l', strtotime($record['date'])); ?></td>
                                <td><?php echo date('jS F, Y', strtotime($record['date'])); ?></td>
                                <td><?php echo date('h:i:s a',strtotime($record['timeIn'])); ?></td>
                                <td><?php echo date('h:i:s a',strtotime($record['timeOut'])); ?></td>
                            </tr>
                <?php 
                        }
                    }else{
                        echo "No Records Found For the Month of $months[$month]";
                    }
                ?>
            </tbody>
        </table>
        <a href="./employee-records.php"> <button>Back to employee records</button></a>
        
    <?php }  else{?>
        Sorry Link is Not Valid
    <?php }  ?>
        
</body>
</html>