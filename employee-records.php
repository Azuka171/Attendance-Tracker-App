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
        <a href="./staff-onboarding"><button>Add</button></a>
    </div>
    <table border="1">
        <thead>
            <tr>
                <td>Employee ID</td>
                <td> FullName</td>
                <td> Email</td>
                <td> Phone</td>
                <td> Date OF Employment</td>
                <td>view</td>
            </tr>
        </thead>
        <tbody id="employees_records">
            <!-- inject from js -->
        </tbody>
    </table>


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

                employeeTbody.appendChild(employeeRow);
            });

        }).catch(error=>console.error(error))
    </script>
</body>
</html>
