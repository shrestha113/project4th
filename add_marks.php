<?php
include('dbconnection.php');

if (isset($_GET['addid'])) {
    $student_id = intval($_GET['addid']);

    if (isset($_POST['submit'])) {
        $sem = $_POST['semester'];
        $subject1 = $_POST['subject1'];
        $marks1 = floatval($_POST['marks1']);
        $subject2 = $_POST['subject2'];
        $marks2 = floatval($_POST['marks2']);
        $subject3 = $_POST['subject3'];
        $marks3 = floatval($_POST['marks3']);
        $subject4 = $_POST['subject4'];
        $marks4 = floatval($_POST['marks4']);
        $subject5 = $_POST['subject5'];
        $marks5 = floatval($_POST['marks5']);
        $gpa = ($marks1 + $marks2 + $marks3 + $marks4 + $marks5) / 5;
        // Query for data insertion
        $query = mysqli_prepare($con, "INSERT INTO marks (User_id,semester, subject1, marks1, subject2, marks2, subject3, marks3, subject4, marks4, subject5, marks5,gpa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

        // Bind parameters
        mysqli_stmt_bind_param($query, "issdsdsdsdsdd", $student_id,$sem, $subject1, $marks1, $subject2, $marks2, $subject3, $marks3, $subject4, $marks4, $subject5, $marks5,$gpa);

        // Execute query
        $result = mysqli_stmt_execute($query);

        if ($result) {
            echo "<script>alert('You have successfully inserted the data');</script>";
            echo "<script type='text/javascript'> document.location ='marks_portal.php'; </script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }

        // Close statement
        mysqli_stmt_close($query);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Marks</title>
    <link rel="stylesheet" href="src/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #fff;
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
                    <a href="login.php" class="logout-btn">Logout</a>
                </ul>
                </ul>
            </div>
        </div>

        <div class="info_tab">
            <div class="signup-form">
                <form method="POST" enctype="multipart/form-data">
                    <h2>Add Marks</h2>
                    <p>Fill below form.</p>
                    <div class="form-group">
                        <input type="text" name="semester" placeholder="Semester" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject1" placeholder="Subject 1" required>
                        <input type="text" name="marks1" placeholder="Marks 1" pattern="[0-9]+" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject2" placeholder="Subject 2" required>
                        <input type="text" name="marks2" placeholder="Marks 2" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject3" placeholder="Subject 3" required>
                        <input type="text" name="marks3" placeholder="Marks 3" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject4" placeholder="Subject 4" required>
                        <input type="text" name="marks4" placeholder="Marks 4" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject5" placeholder="Subject 5" required>
                        <input type="text" name="marks5" placeholder="Marks 5" required>
                    </div>
                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                    <div class="form-group">
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>
                <div class="text-center"><a href="table.php">View Already Inserted Data</a></div>
            </div>
        </div>
    </div>
</body>

</html>
