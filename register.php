<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method ="POST">
        <!-- fname lname username password confirm_pass email position -->
        <label for="">firstname</label><br>
        <input type="text" name="firstname"><br>
        <label for="">lastname</label><br>
        <input type="text" name="lastname"><br>
        <label for="">username</label><br>
        <input type="text" name="username"><br>
        <label for="">Password</label><br>
        <input type="password" name="password"><br>
        <label for="">Confirm Password</label><br>
        <input type="password" name="confirm_password"><br>
        <label for="">Email</label><br>
        <input type="email" name="email"><br>
        <label for="">Position</label><br>
        <input type="text" name="position"><br>
        <input type="submit" name="submit">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $firstname = $_POST['firstname'];
            $lastname  = $_POST['lastname'];
            $username  = $_POST['username'];
            $password  = $_POST['password'];
            $email     = $_POST['email'];
            $position  = $_POST['position'];
            $sql = " INSERT INTO users ( firstname, lastname, username, `password`, email, position) VALUE('$firstname', '$lastname', '$username' , '$password', '$email',  '$position') ";
            if($conn->query($sql) === TRUE){
                echo "New user created sucessfully";
                
                // $_SESSION['sucess'] = 'New record for employee created';
                // header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }

    ?>

</body>
</html>