<?php require_once 'db_connection.php';?>
<?php session_start();?>
<?php require_once 'session-test.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Portal</title>
</head>
<body>
    <!-- <ul>
        <li><a href="staff-onboarding.php">staff onboarding</a></li>
        <li><a href="employee-records.php">employee records</a></li>
        <li><a href="daily-attendance.php">daily attendance</a></li>
        <li> <a href="employee-attendance.php"> employee attendance</a></li>
    </ul> -->
    
   <nav>
        <ul>
            <li><a href="staff-onboarding.php">Staff Onboarding</a></li>
            <li><a href="employee-records.php">Employee Records</a></li>
            <li><a href="daily-attendance.php">Daily Attendance</a></li>
            <li><a href="employee-attendance.php">Employee Attendance</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Welcome to HR Portal</h1>
        <p>Select an option from the navigation above to get started.</p>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f7fa;
        }

        nav {
            background: #1a73e8;
            padding: 15px 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 25px;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            font-size: 16px;
            transition: 0.3s ease;
            padding: 8px 12px;
            border-radius: 6px;
        }

        nav ul li a:hover {
            background: rgba(255,255,255,0.2);
        }

        .container {
            padding: 40px;
        }

        .container h1 {
            color: #333;
        }
    </style>
</body>
</html>