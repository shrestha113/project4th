<?php
// Database Connection file
include ('dbconnection.php');
if (isset($_POST['submit'])) {
	// Getting the post values
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$contno = $_POST['contactno'];
	$email = $_POST['email'];
	$add = $_POST['address'];

	// Query for data insertion
	$query = mysqli_query($con, "insert into tblusers(FirstName,LastName, MobileNumber, Email, Address) value('$fname','$lname', '$contno', '$email', '$add' )");
	if ($query) {
		echo "<script>alert('You have successfully inserted the data');</script>";
		echo "<script type='text/javascript'> document.location ='index.php'; </script>";
	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
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
			width: 450px;
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
			margin-bottom: 20px;
		}

		.form-group input,
		.form-group textarea {
			width: 100%;
			height: 40px;
			border: 1px solid #ccc;
			border-radius: 3px;
			padding: 10px;
			box-sizing: border-box;
			font-size: 14px;
		}

		.form-group textarea {
			height: 80px;
		}

		.form-group button {
			width: 100%;
			height: 40px;
			border: none;
			background: #5cb85c;
			color: #fff;
			border-radius: 3px;
			cursor: pointer;
			font-size: 16px;
		}

		.form-group button:hover {
			background: #4cae4c;
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
			<h2>Fill Data</h2>
			<p>Fill below form.</p>
			<div class="form-group">
				<div style="display: flex;">
					<input type="text" style="flex: 1; margin-right: 10px;" name="fname" placeholder="First Name"
						required>
					<input type="text" style="flex: 1; margin-left: 10px;" name="lname" placeholder="Last Name"
						required>
				</div>
			</div>
			<div class="form-group">
				<input type="text" name="contactno" placeholder="Enter your Mobile Number" required maxlength="10"
					pattern="[0-9]+" style="width: 100%;">
			</div>
			<div class="form-group">
				<input type="email" name="email" placeholder="Enter your Email id" required style="width: 100%;">
			</div>
			<div class="form-group">
				<textarea name="address" placeholder="Enter Your Address" required style="width: 100%;"></textarea>
			</div>
			<div class="form-group">
				<button type="submit" name="submit">Submit</button>
			</div>
		</form>
		<div class="text-center">View Aready Inserted Data!! <a href="index.php">View</a></div>
	</div>
	</div>
</body>

</html>