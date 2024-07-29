<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>CFAS School</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #0072b3;
            color: #fff;
        }
        header img {
            width: 100px;
            height: 100px;
        }
        .container {
            margin: 20px;
        }
        h2 {
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #0072b3;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <script src="data.js"></script>
    <header>
        <img src="cfas_logo.png" alt="CFAS Logo">
        <img src="school_bus.png" alt="School Bus">
    </header>
    <div class="container">
        <h1>Courses</h1>
        <table id="course-table">
            <tr>
                <th>Course</th>
                <th>You Enrolled</th>
                <th>Complete</th>
            </tr>
        </table>
        <h2>Quizzes</h2>
        <div class="button-container">
            <button class="button">Knowledge Assessment Quiz</button>
            <button class="button">Knowledge GAINED Assessment Quiz</button>
        </div>
    </div>

    <script>
        console.log
        // Function to fetch data from the API and populate the table
        fetch('https://proxyencase.cut.ac.cy:8090/api/public/edu/get/https:--www.facebook.com-peter.encase')
            .then(response => response.json())
            .then(data => {
                const table = document.getElementById('course-table');

                data.forEach(item => {
                    const courseName = `<a href="https://proxyencase.cut.ac.cy:8090/proxy_api/php/en/view_course.php?${item.course_childid}">${item.course}</a>`;
                    const enrolled = item.child_id === '1' ? 'Yes' : 'No';
                    const complete = item.parent_id === '1' ? 'Yes' : 'No';

                    const row = table.insertRow(-1);
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);

                    cell1.innerHTML = courseName;
                    cell2.innerHTML = enrolled;
                    cell3.innerHTML = complete;
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>
</body>
</html>

