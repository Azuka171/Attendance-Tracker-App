<?php require_once 'db_connection.php';?>
<?php
   if(isset($_POST["empID"])){
        $employeeID = $_POST["empID"];
        // echo 'I can hear you now';
        // exit;
        
        $today = date('Y-m-d');
        $attendanceSql = "SELECT * FROM attendance WHERE employeeId = $employeeID AND date = '$today'";
        $result = $conn->query($attendanceSql);
        if($result !== FALSE){
            $attendanceRec = $result->fetch_all(MYSQLI_ASSOC);
            if($attendanceRec){
                // record found for user for today;
                if(isset($attendanceRec['timeout'])){
                     //employee has record and has clocked out for the day;
                     echo 'employee already signed out for the day';
                }else{ 
                    // employee has record and has not clocked out;
                     $sql = "UPDATE  attendance SET timeout = CURRENT_TIMESTAMP WHERE employeeId = $employeeID AND date = '$today'";
                     $result = $conn->query($sql);
                    if($result !== FALSE){
                         echo 'attendance updated successfully';
                    }else{
                         echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
            }else{
                //no record found for user for today;
                $sql = "INSERT  INTO attendance (employeeId) VALUES($employeeID)";
                $result = $conn->query($sql);
                if($result !== FALSE){
                    echo 'attendance added successfully';
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    $conn->close();
                }
            }
        }   
    } 
?>
<!-- <table border='1'>
        <?php foreach($attendance as $empID){ ?>
            <tr>
                <td><?php echo $emp['id'];?></td>
                <td><?php echo $emp['employeeId'];?></td>
                <td><?php echo $emp['CURRENT_DATE'];?></td>
                <td><?php echo $emp['CURRENT_TIME'];?></td>
                <td><?php echo $emp['timeOut TIME'];?></td>
                <td><button> view record </button></td>
            </tr>
        <?php }?>
    </table> -->
