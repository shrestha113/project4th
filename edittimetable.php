<?php
// Database Connection file
include('dbconnection.php');

if (isset($_POST['submit'])) {
	$eid = $_GET['editid'];
    $course_id = $_POST['course_id'];
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

    // Query for data update
    $query = mysqli_prepare($con, "UPDATE timetable SET time1=?, time2=?, time3=?, time4=?, time5=?, period1=?, period2=?, period3=?, period4=?, period5=? ,Course=? , Semester=? WHERE Timetable_ID=?");

    // Check if the prepare() call failed
    if ($query === false) {
        echo "Prepare failed: (" . mysqli_errno($con) . ") " . mysqli_error($con);
    }

    // Bind parameters
    mysqli_stmt_bind_param($query, "sssssssssssss", $time_1, $time_2, $time_3, $time_4, $time_5, $period_1, $period_2, $period_3, $period_4, $period_5, $course_id, $sem,$eid);

    // Execute query
    $result = mysqli_stmt_execute($query);

    // Check if the execute() call failed
    if ($result === false) {
        echo "Execute failed: (" . mysqli_errno($con) . ") " . mysqli_error($con);
    } else {
        // Check if any rows were affected
        if (mysqli_stmt_affected_rows($query) > 0) {
            echo "<script>alert('You have successfully updated the timetable');</script>";
            echo "<script type='text/javascript'> document.location ='table.php'; </script>";
        } else {
            echo "<script>alert('No rows were updated. Please check your input and try again.');</script>";
        }
    }

    // Close statement
    mysqli_stmt_close($query);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Timetable</title>
    
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

		input,
		.form-group select {
			width: calc(50% - 5px);
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
			<form method="POST">
    <?php
    // Check if 'editid' is set in the URL
    if (isset($_GET['editid'])) {
        $eid = $_GET['editid'];
        $ret = mysqli_query($con, "SELECT * FROM timetable WHERE Timetable_ID='$eid'");
        while ($row = mysqli_fetch_array($ret)) {
    ?>
        <div class="form-group">
            <label for="course_id">Course ID:</label>
            <input type="text" id="course_id" name="course_id" value="<?php echo $row['Course']; ?>" >
			<label for="sem">Sem:</label>
            <input type="text" id="sem" name="sem" value="<?php echo $row['Semester']; ?>" required>
        </div>
		<div class="form-group">
            <label for="time_1">Time1:</label>
            <input type="text" id="time_1" name="time_1" value="<?php echo $row['time1']; ?>" required>
            <label for="period_1">1st Period:</label>
            <input type="text" id="period_1" name="period_1" value="<?php echo $row['period1']; ?>" required>
        </div>
		<div class="form-group">
            <label for="time_2">Time2:</label>
            <input type="text" id="time_2" name="time_2" value="<?php echo $row['time2']; ?>" required>
            <label for="period_2">2nd Period:</label>
            <input type="text" id="period_2" name="period_2" value="<?php echo $row['period2']; ?>" required>
        </div>
		<div class="form-group">
            <label for="time_3">Time3:</label>
            <input type="text" id="time_3" name="time_3" value="<?php echo $row['time3']; ?>" required>
            <label for="period_3">3rd Period:</label>
            <input type="text" id="period_3" name="period_3" value="<?php echo $row['period3']; ?>" required>
        </div>
		<div class="form-group">
            <label for="time_4">Time4:</label>
            <input type="text" id="time_4" name="time_4" value="<?php echo $row['time4']; ?>" required>
            <label for="period_4">4th Period:</label>
            <input type="text" id="period_4" name="period_4" value="<?php echo $row['period4']; ?>" required>
        </div>
		<div class="form-group">
            <label for="time_5">Time5:</label>
            <input type="text" id="time_5" name="time_5" value="<?php echo $row['time5']; ?>" required>
            <label for="period_5">5th Period:</label>
            <input type="text" id="period_5" name="period_5" value="<?php echo $row['period5']; ?>" required>
        </div>
    <?php 
        }
    }
    ?>
    <div class="form-group">
        <button type="submit" name="submit">Update Timetable</button>
    </div>
</form>

			</div>
		</div>

</body>

</html>
