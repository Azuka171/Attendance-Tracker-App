<?php require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Email</label><br>
        <input type="text" name="email"><br>
        <label for="">Password</label><br>
        <input type="password" name="password"><br>
        <input type="submit" name="submit" value="Login"><br>
    </form>
    <?php
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $password  = $_POST['password'];
            $sql = " SELECT * FROM users WHERE email = '$email' AND `password` = '$password'";
            $result = $conn->query($sql);
            $emp = $result->fetch_assoc();
            // echo print_r(count($emp)>0);die;
            if($result !== FALSE && $emp!==null){
                echo "login successful";
                // $_SESSION['sucess'] = 'New record for employee created';
                // header('Location: ' .$_SERVER['HTTP_REFERER']);
                exit;

            }else{
                echo "login unsuccessful";
                // echo "Error: " . $sql . "<br>" . $conn->error;
                $conn->close();
            }
        }

    ?>

</body>
</html>