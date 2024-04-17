<?php
// Database Connection file
include ('dbconnection.php');

if (isset($_POST['submit'])) {
	// Getting the post values
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$role = $_POST['role'];
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

	// Query for data insertion
	$query = mysqli_prepare($con, "INSERT INTO tabledata (FirstName, LastName, DOB, Gender, Nationality, StudentID, Password, Course, Semester, Email, PhoneNumber, Address, EmergencyContactPersonName, EmergencyContactNumber, Photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

	// Bind parameters
	mysqli_stmt_bind_param($query, "sssssssssssssss", $fname, $lname, $dob, $gender, $nationality, $student_id, $password, $course, $semester, $email, $phone, $address, $emergency_contact_name, $emergency_contact_number, $photo_path);

	// Execute query
	$result = mysqli_stmt_execute($query);

	// Check if the username already exists
	$query_username_check = mysqli_prepare($con, "SELECT userid FROM users WHERE username = ?");
	mysqli_stmt_bind_param($query_username_check, "s", $student_id);
	mysqli_stmt_execute($query_username_check);
	mysqli_stmt_store_result($query_username_check);

	if (mysqli_stmt_num_rows($query_username_check) > 0) {
		echo "<script>alert('Username already exists. Please choose a different username.');</script>";
	} else {
		// Insert data into the users table only if the username is unique
		$query_users = mysqli_prepare($con, "INSERT INTO users (username, password, role, userid) VALUES (?, ?, ?, ?)");

		// Bind parameters
		mysqli_stmt_bind_param($query_users, "ssss", $student_id, $password, $role, $student_id);

		// Execute query
		$result_users = mysqli_stmt_execute($query_users);

		if ($result_users) {
			echo "<script>alert('You have successfully inserted the data');</script>";
			echo "<script type='text/javascript'> document.location ='index.php'; </script>";
		} else {
			echo "<script>alert('Something Went Wrong. Please try again');</script>";
		}

		// Close statement
		mysqli_stmt_close($query_users);
	}

	// Close statement
	mysqli_stmt_close($query);
	mysqli_stmt_close($query_username_check);
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
				<form method="POST" enctype="multipart/form-data">
					<h2>Fill Data</h2>
					<p>Fill below form.</p>
					<div class="form-group">
						<input type="text" name="fname" placeholder="First Name" required>
						<input type="text" name="lname" placeholder="Last Name" required>
					</div>
					<div class="form-group">
						<input type="date" name="dob" placeholder="Date of Birth" required>
						<select name="gender" required>
							<option value="">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							<option value="Other">Other</option>
						</select>
					</div>
					<div class="form-group">
						<select name="role" required>
							<option value="">Select Role</option>
							<option value="student">Student</option>
							<option value="teacher">Teacher</option>
							<option value="admin">Admin</option>
						</select>
					</div>
					<div class="form-group">
						<input type="text" name="nationality" placeholder="Nationality" required>
						<input type="text" name="student_id" placeholder="Student ID" required>
					</div>
					<div class="form-group">
						<input type="password" name="password" placeholder="Password" required>
						<input type="text" name="course" placeholder="Course" required>
					</div>
					<div class="form-group">
						<input type="text" name="semester" placeholder="Semester" required>
						<input type="email" name="email" placeholder="Email" required>
					</div>
					<div class="form-group">
						<input type="tel" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}">
						<input type="text" name="address" placeholder="Address" required></input>
					</div>
					<div class="form-group">
						<input type="text" name="emergency_contact_name" placeholder="Emergency Contact Person Name"
							required>
						<input type="tel" name="emergency_contact_number" placeholder="Emergency Contact Number"
							required pattern="[0-9]{10}">
					</div>
					<div class="form-group">
						<label for="photo">Upload Photo:</label>
						<input type="file" name="photo" id="photo" accept="image/*">
					</div>
					<div class="form-group">
						<button type="submit" name="submit">Submit</button>
					</div>
				</form>
				<div class="text-center">View Already Inserted Data!! <a href="index.php">View</a></div>
			</div>
		</div>
	</div>
</body>


</html>