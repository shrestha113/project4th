<?php
// Database Connection file
include ('dbconnection.php');

if (isset($_POST['submit'])) {
	// Getting the post values
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$nationality = $_POST['nationality'];
	$student_id = $_POST['student_id'];
	$password = $_POST['password'];
	$course = $_POST['course'];
	$semester = $_POST['semester'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$emergency_contact_name = $_POST['emergency_contact_name'];
	$emergency_contact_number = $_POST['emergency_contact_number'];

	// Handle file upload
	if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
		$photo = $_FILES['photo']['name'];
		$photo_tmp = $_FILES['photo']['tmp_name'];
		$photo_path = "photos/" . $photo;
		move_uploaded_file($photo_tmp, $photo_path);
	} else {
		$photo_path = null; // Set to null if no photo is uploaded
	}

	// Query for data insertion for tabledata
	$query = mysqli_prepare($con, "UPDATE tabledata SET FirstName=?, LastName=?, DOB=?, Gender=?, Nationality=?, StudentID=?, Password=?, Course=?, Semester=?, Email=?, PhoneNumber=?, Address=?, EmergencyContactPersonName=?, EmergencyContactNumber=?, Photo=? WHERE UserID=?");

	// Bind parameters
	mysqli_stmt_bind_param($query, "sssssssssssssssi", $fname, $lname, $dob, $gender, $nationality, $student_id, $password, $course, $semester, $email, $phone, $address, $emergency_contact_name, $emergency_contact_number, $photo_path, $student_id);

	// Execute query
	$result = mysqli_stmt_execute($query);

	// Query for data insertion for users
	$query_users = mysqli_prepare($con, "UPDATE users SET username=?, password=? WHERE userid=?");

	// Bind parameters
	mysqli_stmt_bind_param($query_users, "ssi", $student_id, $password, $student_id);

	// Execute query
	$result_users = mysqli_stmt_execute($query_users);


	if ($result && $result_users) {
		echo "<script>alert('You have successfully updated the data');</script>";
		echo "<script type='text/javascript'> document.location ='index.php'; </script>";
	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}

	// Close statements
	mysqli_stmt_close($query);
	mysqli_stmt_close($query_users);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Crud Operation</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

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
				<h3>Shreebisha Shrestha</h3>
			</div>

			<div class="navigation">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="examform.html">Registration Form</a></li>
					<li><a href="timetable.html">Time Table</a></li>
					<li><a href="marks.html">Marks</a></li>

				</ul>
			</div>
		</div>

		<div class="info_tab">
			<div class="signup-form">
				<form method="POST">
					<?php
					$eid = $_GET['editid'];
					$ret = mysqli_query($con, "SELECT * FROM tabledata WHERE StudentID='$eid'");
					while ($row = mysqli_fetch_array($ret)) {
						?>
						<h2>Update User Details</h2>
						<p>Update your information</p>
						<input type="text" name="fname" value="<?php echo $row['FirstName']; ?>" required>
						<input type="text" name="lname" value="<?php echo $row['LastName']; ?>" required>
						<input type="text" name="dob" value="<?php echo $row['DOB']; ?>" required>
						<select name="gender" required>
							<option value="Male" <?php if ($row['Gender'] == 'Male')
								echo 'selected'; ?>>Male</option>
							<option value="Female" <?php if ($row['Gender'] == 'Female')
								echo 'selected'; ?>>Female</option>
							<option value="Other" <?php if ($row['Gender'] == 'Other')
								echo 'selected'; ?>>Other</option>
						</select>
						<input type="text" name="nationality" value="<?php echo $row['Nationality']; ?>" required>
						<input type="text" name="student_id" value="<?php echo $row['StudentID']; ?>" required>
						<input type="text" name="password" value="<?php echo $row['Password']; ?>" required>
						<input type="text" name="course" value="<?php echo $row['Course']; ?>" required>
						<input type="text" name="semester" value="<?php echo $row['Semester']; ?>" required>
						<input type="email" name="email" value="<?php echo $row['Email']; ?>" required>
						<input type="tel" name="phone" value="<?php echo $row['PhoneNumber']; ?>" required
							pattern="[0-9]{10}">
						<input type="text" name="address" value="<?php echo $row['Address']; ?>" required>
						<input type="text" name="emergency_contact_name"
							value="<?php echo $row['EmergencyContactPersonName']; ?>" required>
						<input type="tel" name="emergency_contact_number"
							value="<?php echo $row['EmergencyContactNumber']; ?>" required pattern="[0-9]{10}">
						<div class="form-group">
							<label for="photo">Upload Photo:</label>
							<input type="file" name="photo" id="photo" accept="image/*">
						</div>
					<?php } ?>
					<button type="submit" class="btn" name="submit">Update</button>
				</form>
			</div>
		</div>

</body>

</html>