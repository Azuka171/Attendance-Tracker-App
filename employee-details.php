<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee details page</title>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(255, 255, 255); 
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .summary-box {
            .summary-box 
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            margin: 20px auto;
        }

        .summary-box img {
            border-radius: 50%;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .summary-box p {
            margin: 10px 0;
            font-size: 16px;
            line-height: 1.5;
            
        }

        .summary-box p strong {
            color: #007bff;
        }

        .summary-box button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto 0;
        }

        .summary-box button:hover {
            background-color: #0056b3;
        }

        .error-message {
            text-align: center;
            color: red;
            font-size: 18px;
        }

        .error-message a button {
            background-color: #6c757d;
        }
    </style>
    <?php if(isset($_GET['id'])){?>
        <?php
            $id = $_GET['id']; 
           
            $emp_query = "SELECT * FROM employees WHERE id = $id";
            $emp_result = $conn->query($emp_query);
            // $employee_name = "Unknown Employee";
            // $employee_id = "N/A";
            if ($emp_result && $emp_result->num_rows > 0) {
                $emp_data = $emp_result->fetch_assoc();
                $employee_name = $emp_data['first_name'] . " " . $emp_data['last_name'];
                //$employee_id = $emp_data['id'];
            }else{
                echo "Error". $sql . "<br>" . $conn->error;
                $conn->close();
            }

            // $sql = "SELECT  * FROM attendance WHERE employeeId = $id AND MONTH(date) = $month AND YEAR(date) = $year";
            // $result = $conn->query($sql);
            // if($result !== FALSE){
            //     $emp_records = $result->fetch_all(MYSQLI_ASSOC);          
            //     $abs_days = $total_w_days - count($emp_records);
            // }else{
            //     echo "Error". $sql . "<br>" . $conn->error;
            //     $conn->close();
            // }
        ?>
        <!-- <h1></?php echo  $employee_name; ?></h1> -->
        <div class="summary-box">
            <img src="<?php  echo $emp_data['passport_photo'] ?  $emp_data['employee_pic'] : 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541' ?>" alt="" width="100">
            <p>Employee Name: <?php echo htmlspecialchars($employee_name); ?></p>
            <p>Employee ID: <?php echo  htmlspecialchars($emp_data['employee_id'] ); ?></p>
            <p>Employee Marital Status: <?php echo  htmlspecialchars($emp_data['marital_status'] ); ?></p>
            <p>Employee Gender: <?php echo  htmlspecialchars($emp_data['gender'] ); ?></p>
            <p>Employee Email: <?php echo  htmlspecialchars($emp_data['email'] ); ?></p>
            <p>Employee Phone number: <?php echo  htmlspecialchars($emp_data['phone_number'] ); ?></p>
            <p>Employee Date of Employment : <?php echo  htmlspecialchars($emp_data['date_of_employment'] ); ?></p>
            <p>Employee Date of Birth: <?php echo  htmlspecialchars($emp_data['date_of_birth'] ); ?></p>
            <p>Employee Nationality: <?php echo  htmlspecialchars($emp_data['nationality'] ); ?></p>
            <p>Employee Religion: <?php echo  htmlspecialchars($emp_data['religion'] ); ?></p>
            <p>Employee State of Origin: <?php echo  htmlspecialchars($emp_data['state_Of_Origin'] ); ?></p>
            <p>Employee LGA: <?php echo  htmlspecialchars($emp_data['lga'] ); ?></p>
            <p>Employee Next of kin name: <?php echo  htmlspecialchars($emp_data['next_Of_Kin_FullName'] ); ?></p>
            <p>Employee next of kin Relationship: <?php echo  htmlspecialchars($emp_data['next_Of_Kin_Relationship'] ); ?></p>
            <p>Employee next of kin Email: <?php echo  htmlspecialchars($emp_data['next_Of_Kin_Email'] ); ?></p>
            <p>Employee next of kin Phone number: <?php echo  htmlspecialchars($emp_data['next_Of_Kin_Phone'] ); ?></p>
            <a href="staff-onboarding.php?id=<?php echo $_GET['id'] ?>&mode=edit"><button>Edit record</button></a>
        </div>
    <?php }else{ ?>
        <div>No valid employee selected. Go back to employee page <a href="./employee-records.php"><button>go back to employee records</button></a></div>
    <?php } ?>
</body>
</html>