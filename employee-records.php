<?php //require_once 'db_connection.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Employee</h2>
    <div>
        <input type="search">
        <a href="./staff-onboarding.php"><button>Add</button></a>
    </div>
    
    <table border="1">
        <thead>
            <tr>
                <td>Employee ID</td>
                <td> FullName</td>
                <td> Email</td>
                <td> Phone</td>
                <td> Date OF Employment</td>
                <td>View Records</td>
                <td>View Details</td>
            </tr>
        </thead>
        <tbody id="employees_records">
            <!-- inject from js -->
        </tbody>
    </table>

    <!-- <td>
        <a href="./employee-attendance?3">
            <button>View Records</button>
        </a>
    </td> -->
    <style>
        /* General Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f6fa;
            color: #333;
        }

        /* Heading Styling */
        h2 {
            text-align: center;
            color: #4e54c8;
            margin-bottom: 20px;
            font-size: 24px;
            text-transform: uppercase;
        }

        /* Search and Add Button Container */
        div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px auto;
            max-width: 80%;
        }

        /* Search Input Styling */
        div input[type="search"] {
            padding: 10px;
            width: 60%;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Add Button Styling */
        div a button {
            background: #4e54c8;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        div a button:hover {
            background: #3a41a7;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
        }

        /* Table Header Styling */
        table thead {
            background: #4e54c8;
            color: #fff;
            text-transform: uppercase;
            font-size: 14px;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Table Row Styling */
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        table tbody tr:hover {
            background: #f1f1f1;
            transition: background 0.3s ease-in-out;
        }

        /* View Records Button Styling */
        table tbody td a button {
            background: #4e54c8;
            color: #fff;
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        table tbody td a button:hover {
            background: #3a41a7;
        }
    </style>

    <script>
        const url = 'api/employee-records-api.php';
        const employeeTbody = document.getElementById("employees_records");
        fetch(url).then(response=>response.json())
        .then((data)=>{
            console.log(data);
            //! loop through and display employees
            data.forEach(employee => {
                const employeeRow = document.createElement('tr');

                const employeeId_td = document.createElement('td');
                employeeId_td.innerHTML = employee.employeeId;
                employeeRow.appendChild(employeeId_td);

                const firstname_td = document.createElement('td');
                firstname_td.innerHTML = employee.lastname + ' ' + employee.firstname;
                employeeRow.appendChild(firstname_td);

                // const lastname_td = document.createElement('td');
                // lastname_td.innerHTML = employee.lastname;
                // employeeRow.appendChild(lastname_td);

                const email_td = document.createElement('td');
                email_td.innerHTML = employee.email;
                employeeRow.appendChild(email_td);

                const phone_td = document.createElement('td');
                phone_td.innerHTML = employee.phone;
                employeeRow.appendChild(phone_td);
                
                const date_of_employment = document.createElement('td');
                date_of_employment.innerHTML = employee.date_of_employment;
                employeeRow.appendChild(date_of_employment);

                const view_records = document.createElement('td');
                const record_link = document.createElement('a');
                record_link.href = './employee-attendance.php?id=' + employee.id;
                const record_btn = document.createElement('button');
                record_btn.innerHTML = 'View Records';
                record_link.appendChild(record_btn);
                view_records.appendChild(record_link);
                employeeRow.appendChild(view_records);
                
                const view_details = document.createElement('td');
                const detail_link = document.createElement('a');
                detail_link.href = './employee-details.php?id=' + employee.id;
                const detail_btn = document.createElement('button');
                detail_btn.innerHTML = 'View Details';
                detail_link.appendChild(detail_btn);
                view_details.appendChild(detail_link);
                employeeRow.appendChild(view_details);


                employeeTbody.appendChild(employeeRow);
            });

        }).catch(error=>console.error(error))
    </script>
</body>
</html>
