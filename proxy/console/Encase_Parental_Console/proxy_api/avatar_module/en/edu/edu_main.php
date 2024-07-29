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
            background-color: #00b0f03b;
            color: #fff;
        }
        header img {
            height: 80px;
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
tr:nth-child(even) {
  background-color: #c4edfc73;
}
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
	padding: 70px;
    font-size: 16px;
    background-color: #9700b3;
    color: #fff;
    border: none;
    cursor: pointer;
    border-radius: 25px;
    margin: 55px;
    font-size: larger;
    white-space: pre;
    text-align: center;

        }

/* Style for the modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    position: relative;
    margin: 15% auto;
    width: 30%;
    background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
}

.close {
    position: absolute;
    top: 0;
    right: 0;
    padding: 10px;
    cursor: pointer;
ont-size: xx-large;
    color: red;
}
li{
    font-size: x-large;
    color: black;
    width: 30%;
    text-align: center;
    margin: auto;
list-style-type: disclosure-closed;
}

    </style>
</head>
<body>
    <script src="data.js"></script>
    <header>
        <img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/images/cfas_trans.png" alt="CFAS Logo">
<h3 style="color: #595959;">CyberSafety Education</h3>
    </header>
    <div class="container">
<h1 style=" text-align: center; ">My Courses</h1>
<div style="
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    /* background-color: #00b0f03b; */
    /* color: #fff; */
border-bottom: 1px solid;
"><img src="https://proxyencase.cut.ac.cy:8090/schoolbus.png" alt="School Bus" style="
    margin-right: 55px;
">
        <table id="course-table">
            <tr>
                <th>Course</th>
                <th>You Enrolled</th>
                <th>Complete</th>
            </tr>
        <tr>
            <td>
                <a href="https://proxyencase.cut.ac.cy:8090/courses/A1-I.html">A1. Personal / Sensitive Data and Privacy - Intermediate</a>
            </td>
            <td>Yes</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>
                <a href="https://proxyencase.cut.ac.cy:8090/courses/A1-F.html">A1. Personal / Sensitive Data and Privacy</a>
            </td>
            <td>Yes</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>
                <a href="https://proxyencase.cut.ac.cy:8090/courses/A2-F.html">A2. Cyberbullying and Sexual Harassment-Foundation</a>
            </td>
            <td>Yes</td>
            <td> No</td>
        </tr>
        <tr>
            <td>
                <a href="https://proxyencase.cut.ac.cy:8090/courses/A3-F.html">A3. Inappropriate Content - Foundation</a>
            </td>
            <td>Yes</td>
            <td>Yes</td>
        </tr>
        </table>
</div>
        <div class="button-container">
            <button class="button" id="openAllQuizes" style=" background-color: #ff8100; ">Knowledge<br> Assessment Quiz</button>
            <button class="button">Knowledge GAINED<br> Assessment Quiz</button>

             <div id="quizModal" class="modal">
        <div class="modal-content">
            <!-- Quiz content will be displayed here -->
            <span class="close">&times;</span>
		<h1>Select Quiz</h1>
            <ul id="quizList"></ul>
        </div>
    </div>
        </div>
    </div>

    <script>
        var url_string = window.location.href
var url = new URL(url_string);
var fb_url = url.searchParams.get("fb_url");
        // Function to fetch data from the API and populate the table
//        fetch('https://proxyencase.cut.ac.cy:8090/api/public/edu/get/'+fb_url)
//            .then(response => response.json())
//            .then(data => {
 //               const table = document.getElementById('course-table');

//                data.forEach(item => {
//                    const courseName = `<a href="https://proxyencase.cut.ac.cy:8090/courses/course${item.course}.html">Course${item.course}</a>`;
//                    const enrolled = item.child_id === '1' ? 'Yes' : 'No';
//                    const complete = item.parent_id === '1' ? 'Yes' : 'No';

//                    const row = table.insertRow(-1);
//                    const cell1 = row.insertCell(0);
//                    const cell2 = row.insertCell(1);
//                    const cell3 = row.insertCell(2);

 //                   cell1.innerHTML = courseName;
 //                   cell2.innerHTML = enrolled;
 //                   cell3.innerHTML = complete;
  //              });
 //           })
//            .catch(error => {
 //               console.error('Error fetching data:', error);
 //           });



            document.getElementById("openAllQuizes").addEventListener("click", function () {
    // When the button is clicked, open the modal
    var modal = document.getElementById("quizModal");
    modal.style.display = "block";

    // Fetch data from the API
    fetch('https://proxyencase.cut.ac.cy:8090/api/public/quiz/get/'+fb_url)
        .then(response => response.json())
        .then(data => {
            var quizList = document.getElementById("quizList");

            // Clear any previous quiz data
            quizList.innerHTML = '';

            // Populate the modal with quiz data
            data.forEach(quiz => {
                var li = document.createElement("li");
               var link = document.createElement("a");
               link.setAttribute('target', '_blank');
                link.href = `https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/edu/quiz.php?childid=${quiz.childid}&quizid=${quiz.quizid}`;
                link.textContent = quiz.title;
                li.appendChild(link);
                quizList.appendChild(li);
            });
        })
        .catch(error => console.error('Error fetching data: ', error));
});

document.querySelector(".close").addEventListener("click", function () {
    // When the modal's close button is clicked, hide the modal
    var modal = document.getElementById("quizModal");
    modal.style.display = "none";
});

// Close the modal if the user clicks outside the modal
window.addEventListener("click", function (event) {
    var modal = document.getElementById("quizModal");
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

    </script>
<footer style="
    text-align: center;
    color: white;
    border-top: 1px solid black;
">
 <img src="https://proxyencase.cut.ac.cy:8090/fundedeu.jpg" alt="School Bus" style="
    width: 300px;
"><img src="https://proxyencase.cut.ac.cy:8090/proxy_api/avatar_module/en/edu/cybersafety.jpg" alt="School Bus" style="
    width: 200px;
    height: 100px;
">
</footer>
</body>
</html>
