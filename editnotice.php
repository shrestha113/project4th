<?php
// Database Connection file
include('dbconnection.php');

if (isset($_POST['submit'])) {
    // Getting the post values
	$eid = $_GET['editid'];
    $title = $_POST['title']; // Ensure id is sent via form
    $notice = $_POST['notice'];

    // Query for data update
    $query = mysqli_prepare($con, "UPDATE notice_board SET title=? ,notice=? WHERE Notice_id=?");

    // Bind parameters
    mysqli_stmt_bind_param($query, "ssi",$title, $notice, $eid);

    // Execute query
    $result = mysqli_stmt_execute($query);

    if ($result) {
        echo "<script>alert('You have successfully updated the notice');</script>";
        echo "<script type='text/javascript'> document.location ='noticeboard.php'; </script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
        // Check for errors
        echo "Error: " . mysqli_stmt_error($query);
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

		input,
		.form-group select {
			width: 100%;
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
			height: 120px;
            width: 100%;
            resize:none;
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
    $eid = $_GET['editid'];
    $ret = mysqli_query($con, "SELECT * FROM notice_board WHERE Notice_id='$eid'");
    while ($row = mysqli_fetch_array($ret)) {
    ?>
        <div class="form-group">
            <label for="notice">Notice:</label>
            <div class="form-group">
    <label for="notice">Notice:</label>
    <input type="text" name="title" value=<?php echo $row['Title'];?>>
    <textarea id="notice" name="notice" rows="6" required><?php echo $row['notice']; ?></textarea>
</div>

        </div>
        
    <?php } ?>
    <div class="form-group">
        <button type="submit" name="submit">Update notice</button>
    </div>
</form>

			</div>
		</div>

</body>

</html>