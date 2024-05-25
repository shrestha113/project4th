<?php
// Database Connection file
include('dbconnection.php');

// Initialize variables
$student_id = $subject1 = $marks1 =  $subject2 = $marks2 = $subject3 = $marks3 = $subject4 = $marks4 = $subject5 = $marks5 = $gpa = '';

if (isset($_POST['submit'])) {
    // Getting the post values
    $student_id = $_POST['student_id'];
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
    if ($_POST['edit_id']) {
        // Update existing data
        $edit_id = $_POST['edit_id'];
        $query = mysqli_prepare($con, "UPDATE marks SET  subject1=?,semester=?, marks1=?,  subject2=?, marks2=?, subject3=?, marks3=?, subject4=?, marks4=?,  subject5=?, marks5=?,gpa=? WHERE User_id=?");

        // Bind parameters
        mysqli_stmt_bind_param($query, "ssdsdsdsdsddi",  $subject1,$sem,$marks1,$subject2, $marks2,  $subject3, $marks3,  $subject4, $marks4,  $subject5, $marks5,$gpa, $edit_id);

        // Execute query
        $result = mysqli_stmt_execute($query);

        if ($result) {
            echo "<script>alert('You have successfully updated the data');</script>";
            echo "<script type='text/javascript'> document.location ='marks_portal.php'; </script>";
        } else {
            echo "<script>alert('Something Went Wrong. Please try again');</script>";
        }

        // Close statement
        mysqli_stmt_close($query);
    } else {
        // Insert new data
        $query = mysqli_prepare($con, "INSERT INTO marks (student_id, subject1, marks1,subject2, marks2, subject3, marks3, subject4, marks4,  subject5, marks5,gpa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");

        // Bind parameters
        mysqli_stmt_bind_param($query, "isdsdsdsdsdd", $student_id, $sem,    $subject1, $marks1,  $subject2, $marks2,  $subject3, $marks3, $subject4, $marks4,  $subject5, $marks5,$gpa);

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

// Fetch data from database for editing
if (isset($_GET['editid'])) {
    $edit_id = intval($_GET['editid']); // Sanitize the input to prevent SQL injection

    // Fetch data
    $query = mysqli_prepare($con, "SELECT * FROM marks WHERE User_id=?");
    mysqli_stmt_bind_param($query, "i", $edit_id);
    mysqli_stmt_execute($query);
    $result = mysqli_stmt_get_result($query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $sem= $row['semester'];
        $student_id = $row['User_id'];
        $subject1 = $row['subject1'];
        $marks1 = $row['marks1'];
        $subject2 = $row['subject2'];
        $marks2 = $row['marks2'];
        $subject3 = $row['subject3'];
        $marks3 = $row['marks3'];
        $subject4 = $row['subject4'];
        $marks4 = $row['marks4'];
        $subject5 = $row['subject5'];
        $marks5 = $row['marks5'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Marks</title>
    <link rel="stylesheet" href="src/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #566787;
        }

        .container {
            width: 50%;
            margin: 0 auto;
        }

        .signup-form {
            background: #f2f3f7;
            padding: 30px;
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
    <div class="container">
        <div class="signup-form">
            <form method="POST" enctype="multipart/form-data">
                <h2>Edit Marks</h2>
                <p>Fill in the marks below.</p>
                <div class="form-group">
                    <input type="text" name="semester" placeholder="Semester" value="<?php echo $sem; ?>" required>
                </div>
                <div class="form-group">
                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                    <input type="text" name="subject1" placeholder="Subject 1" value="<?php echo $subject1; ?>" required>
                    <input type="text" name="marks1" placeholder="Marks 1" value="<?php echo $marks1; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject2" placeholder="Subject 2" value="<?php echo $subject2; ?>" required>
                    <input type="text" name="marks2" placeholder="Marks 2" value="<?php echo $marks2; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject3" placeholder="Subject 3" value="<?php echo $subject3; ?>" required>
                    <input type="text" name="marks3" placeholder="Marks 3" value="<?php echo $marks3; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject4" placeholder="Subject 4" value="<?php echo $subject4; ?>" required>
                    <input type="text" name="marks4" placeholder="Marks 4" value="<?php echo $marks4; ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="subject5" placeholder="Subject 5" value="<?php echo $subject5; ?>" required>
                    <input type="text" name="marks5" placeholder="Marks 5" value="<?php echo $marks5; ?>" required>
                </div>
                <?php if(isset($_GET['editid'])): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $_GET['editid']; ?>">
                <?php endif; ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
