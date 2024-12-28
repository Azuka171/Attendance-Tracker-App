<?php require_once 'db_connection.php';?>
<?php 

if(isset($_POST['employeeId'])){ 
    $emID = $_POST['employeeId'];
    $sql = "SELECT * FROM employees WHERE employeeId = $emID";
    $result = $conn->query($sql);
    if($result !== FALSE){
        $emp = $result->fetch_all(MYSQLI_ASSOC);
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
    }
    if($emp){
        // at this point we have confirmed that the employee is a real one
        // search the attandance table and find if the emp has an attendance for that day
        // the result: id,date,timein,timeout,employeeId or empty result
        // test if timeout is null, if it is null it means the emp has not signed out for the day
        $today = date('Y-m-d');
        $attendanceSql = "SELECT * FROM attendance WHERE employeeId = $emID AND date = '$today'";
        $attendanceResult = $conn->query($attendanceSql);
            if($attendanceResult !== FALSE){
                // $attendance = $attendanceResult->fetch_all(MYSQLI_ASSOC);
                $attendance = $attendanceResult->fetch_assoc();
                if($attendance ){
                    if(!isset($attendance['timeOut'])){
                    // if(is_null($attendance['timeout'])){
                        echo "Employee has not signed out for today.";
                    }else{
                        echo "Employee has signed out for today at " . $attendance['timeOut'];
                    }
                }else{
                    echo "No attendance record found for this employee today.";
                }
            }else {
                echo "Error: " . $attendanceSql . "<br>" . $conn->error;
            }
    }else{
        // echo 'No records found for this employee ID';
    }
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Attendance</title>
</head>
<body>
    <?php if(!isset($_POST['employeeId'])){?>
        <form action="" method="POST">
            <label>Employee ID</label><br>
            <input type="text" required name="employeeId">
            <input type="submit" value="next">
        </form>
    <?php } elseif(!$emp){?>
        <p>ID is not a valid employee ID.</p>
    <?php } else{?>
        <!-- make visible only when a record of the employee is found, meaning only employee should be able to see the clockin-clockout form -->
        <div onsubmit="return preventSubmit(event)">
            <label class="second_emp">Employee ID</label><br>
            <input type="text" class="emp2">
            <button onclick="clockIn()" id="clockInBtn" class="btn-signIn" <?php if($attendance){echo 'disabled';}?>>ClockIn</button>
            <!-- <button onclick="clockIn()" class="btn-signIn" <?php //if($att_rec->timein){echo 'disbled'}?>>ClockIn</button> -->
            <!-- <button onclick="clockIn()" class="btn-signIn" <?php //if($att_rec->timeout){echo 'disbled'}?>>ClockOut</button> -->
            <?php if($attendance){?>
                <button onclick="clockOut()" id="clockOutBtn" class="btn-signOut" <?php if(isset($attendance['timeOut'])){echo 'disabled';}?>>ClockOut</button>
            <?php } else{?>
                <button onclick="clockOut()" id="clockOutBtn" class="btn-signOut" disabled>ClockOut</button>
            <?php }?>
            <div id="error"></div>
            <div id="userLocation"></div>
        </div>
    <?php }?>
    

    <!-- <button onclick="clockIn()" class="btn-signIn" <?php if(TRUE){echo 'disabled';}?>>ClockIn</button> -->

    
    <style>
        label{
            font-size: .625rem;
            font-style: italic;
            color: blue;
            text-transform:capitalize;
            text-align: center;
            padding-left:3.125rem ;
        }
        .second_emp{
            display:none;
        }
        .emp2{
            display:none;
        }
        .btn-signIn{
            background-color: rgb(8, 8, 106);
            color: white;
            border-radius: .3125rem;
            width: fit-content;
        }
        .btn-signOut{
            background-color: rgb(8, 8, 106);
            color: white;
            border-radius: .3125rem;
            width: fit-content;
        }
        .correct{
            color: rgb(3, 43, 3);
            font-size: .5rem;
            font-style: italic;
        }
        .wrong{
            color: red;
            font-size: .5rem;
            font-style: italic;
        }
        #userLocation{
            font-size: .5rem;
            font-style: italic;
            color: green;
        }
        button[disabled]{
            background-color: #999;
            cursor: not-allowed;
        }
    </style>
    <script>
        const accessGranted = confirm('do you want to give us your exact location');
        //actual office coordinates
        // const officelat = 6.2439578;
        // const officeLong = 6.5961918;

        //testing coord for home
        const officelat = 4.8463872;
        const officeLong = 7.0156288;
        
        //const officelat = 6.1854861 ;
        //const officeLong = 6.735517;
        const lat_dif = 0.0039682;
        const lon_dif = 0.0093421;
        const max_lat = officelat + lat_dif
        const min_lat = officelat - lat_dif
        const max_lon = officeLong + lon_dif
        const min_lon = officeLong - lon_dif
        let userLat = null;
        let userLong = null;
        let url = "api/attendance-api.php";
        const x = document.getElementById('error');
        const userLocation = document.getElementById('userLocation');
        
        function clockIn(){
            if(accessGranted){
                if (navigator.geolocation) {
                   navigator.geolocation.getCurrentPosition(updatePosition);
                } else { 
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }
        }
        function clockOut(){
            if(accessGranted){
                if (navigator.geolocation) {
                   navigator.geolocation.getCurrentPosition(updatePosition);
                } else { 
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }
        }
        function preventSubmit(event){
            event.preventDefault();
        }
        function updatePosition(position) {
           // x.innerHTML = "Latitude: " + position.coords.latitude + 
           // "<br>Longitude: " + position.coords.longitude;
            userLong = position.coords.longitude;
            userLat = position.coords.latitude;
            console.log(userLat, userLong);
            
            // userLocation.innerHTML = 'your latitude:'+ userLat +' '+ 'your longitude:'+ userLong+`<br> is the lat bigger than min? ${userLat >min_lat}<br> |min_lat-->${min_lat}<br> is the lat smaller than max? ${userLat <max_lat}<br> |max_lat-->${max_lat}`;
            userLocation.innerHTML = 'your latitude:'+ userLat +' '+ 'your longitude:'+ userLong;

            console.log(userLat >min_lat && userLat < max_lat && userLong >min_lon && userLong < max_lon);
            
            if(userLat >min_lat && userLat < max_lat && userLong >min_lon && userLong < max_lon){
                x.innerHTML = 'you are within the office location you can clockIn';
                x.classList= 'correct'; 

                let formdata = new FormData();
                formdata.append("empID", "<?php if(isset($emID)){echo $emID;}?>");
                //let formdata = {message :"hello"};
                fetch(
                    url, 
                    {
                        method : "POST", 
                        body : formdata
                    }
                ).then(response=>response.text())
                .then((data)=>{
                    console.log('response from api: ',data);
                    if(data.trim()==='attendance added successfully'){
                        console.log('clock in response test pass')
                        clockInBtn.disabled = true;
                        //check time for closing and update checkout btn accordingly
                        closingTimeCheck();
                    }else if(data.trim()==='attendance updated successfully'){
                        console.log('clock out response test pass')
                        clockOutBtn.disabled = true;
                    }else{

                        console.log(data.trim()==='attendance added successfully')
                        console.log(data.trim()==='attendance updated successfully')
                        console.log('clock out response test fail')
                    }
                })
                .catch(error=>console.error('error : ', error));
            }else{
                x.innerHTML = 'you are not within the office location you can not clockIn';
                x.classList ='wrong';
            }
        }
        function closingTimeCheck(){
            let today = new Date();
            let currentHour = today.getHours();
            if(currentHour >= 7){
                clockOutBtn.disabled = false;
                console.log('closing time has reached');
            }else{
                clockOutBtn.disabled = true;
                console.log('closing time has not reached');
                const closingNote = document.createElement('div');
                closingNote.innerText = 'closing time has not reached please check back by 5pm to clockout';
                closingNote.style.color = 'blue';
                closingNote.style.fontSize = '20px';
                
                document.querySelector('body').appendChild(closingNote);
            }
        }
        <?php if(isset($attendance) && $attendance){?>
            closingTimeCheck();
        <?php } ?>
       
        
          
    </script>
</body>
</html