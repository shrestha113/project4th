<?php
include ('dbconnection.php');
session_start();
$id=$_SESSION['id'];
if (isset($_POST['submit'])) {
    $course_id = $_POST['course'];
    $sem = $_POST['sem'];
    $time_1 = $_POST['time_1'];
    $time_2 = $_POST['time_2'];
    $time_3 = $_POST['time_3'];
    $time_4 = $_POST['time_4'];
    $time_5 = $_POST['time_5'];
    $period_1 = $_POST['period_1'];
    $period_2 = $_POST['period_2'];
    $period_3 = $_POST['period_3'];
    $period_4 = $_POST['period_4'];
    $period_5 = $_POST['period_5'];

    // Query for data insertion
    $query = mysqli_prepare($con, "INSERT INTO timetable (User_id,Course, Semester, time1, time2, time3, time4, time5, period1, period2, period3, period4, period5) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    mysqli_stmt_bind_param($query, "issssssssssss",$id, $course_id, $sem, $time_1, $time_2, $time_3, $time_4, $time_5, $period_1, $period_2, $period_3, $period_4, $period_5);

    // Execute query
    $result = mysqli_stmt_execute($query);

    if ($result) {
        echo "<script>alert('You have successfully inserted the data');</script>";
        echo "<script type='text/javascript'> document.location ='table.php'; </script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }

    // Close statement
    mysqli_stmt_close($query);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHP Crud Operation!!</title>
    <link rel="stylesheet" href="src/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #63738a;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .signup-form {
            width: 800px;
            margin: 50px auto;
            padding: 30px 20px;
            background: #f2f3f7;
            border-radius: 5px;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        }

        .signup-form h2 {
            color: #636363;
            text-align: center;
            margin-bottom: 20px;
        }

        .signup-form p {
            color: #999;
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-form form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: calc(50% - 5px);
            /* Adjust the width as needed */
            height: 40px;
            border: 1px solid #ccc;
            border-radius: 3px;
            padding: 10px;
            box-sizing: border-box;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .form-group select {
            width: 100%;
            /* Full width for select dropdown */
        }

        .form-group textarea {
            height: 80px;
        }

        .form-group button {
            width: 100%;
        }

        /* For smaller screens, adjust the input width to 100% */
        @media screen and (max-width: 768px) {

            .form-group input,
            .form-group textarea,
            .form-group select {
                width: 100%;
            }
        }

        input[type=date],
        input[type=file] {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-center a {
            color: #5cb85c;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="head_wrap">
        <div class="side_menu">

        <div class="avatar_profile">
            <img src="./src/images/ass.png" alt="">
        </div>
        <div class="student_info">
             <h3>Admin</h3>
        </div>

            <div class="navigation"> 
            <ul>
                    <li><a href="admin_dashboard.php">Home</a></li>
                    <li><a href="index1.php">Records</a></li>
                    <li><a href="table.php">Time Table</a></li>
                    <li><a href="noticeboard.php">Notice Board</a></li>
                    <li><a href="marks_portal.php">Marks</a></li>
                    <a href="login1.php" class="logout-btn">Logout</a>
                 </ul>
            </div>
        </div>

        <div class="info_tab">
            <div class="signup-form">
                <form method="POST" enctype="multipart/form-data">
                    <h2>Fill Data</h2>
                    <p>Fill below form.</p>
                    <div class="form-group">
                        <input type="text" name="course" placeholder="Course" required>
                        <input type="text" name="sem" placeholder="Sem" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="time_1" placeholder="time_1" required>
                        <input type="text" name="period_1" placeholder="1st Period" required>
                        <input type="text" name="time_2" placeholder="time_2" required>
                        <input type="text" name="period_2" placeholder="2nd Period" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="time_3" placeholder="time_3" required>
                        <input type="text" name="period_3" placeholder="3rd Period" required>
                        <input type="text" name="time_4" placeholder="time_4" required>
                        <input type="text" name="period_4" placeholder="4th Period" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="time_5" placeholder="time_5" required>
                        <input type="text" name="period_5" placeholder="5th Period" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>
                <div class="text-center">View Already Inserted Data!! <a href="table.php">View</a></div>
            </div>
        </div>
    </div>
</body>


</html>
