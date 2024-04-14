<?php
include ('dbconnection.php');

if (isset($_POST['submit'])) {
	$eid = $_GET['editid'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$contno = $_POST['contactno'];
	$email = $_POST['email'];
	$add = $_POST['address'];

	$query = mysqli_query($con, "UPDATE tblusers SET FirstName='$fname',LastName='$lname', MobileNumber='$contno', Email='$email', Address='$add' WHERE ID='$eid'");

	if ($query) {
		echo "<script>alert('You have successfully updated the data');</script>";
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Crud Operation</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
	
    <link rel="stylesheet" href="src/style.css">
	<style>
		body {
			color: #fff;
			background: #63738a;
			font-family: 'Roboto', sans-serif;
		}

		.signup-form {
			width: 450px;
			margin: 0 auto;
			padding: 30px;
			background: #f2f3f7;
			border-radius: 5px;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		}

		.signup-form h2 {
			color: #636363;
			margin-bottom: 15px;
			text-align: center;
		}

		.signup-form p {
			color: #999;
			margin-bottom: 30px;
			text-align: center;
		}

		.signup-form input[type="text"],
		.signup-form input[type="email"],
		.signup-form textarea {
			width: 100%;
			padding: 10px;
			background: #fff;
			border: 1px solid #ddd;
			border-radius: 3px;
			margin-bottom: 20px;
			color: #999;
		}

		.signup-form .btn {
			font-size: 16px;
			font-weight: bold;
			text-transform: uppercase;
			width: 100%;
			border: none;
			cursor: pointer;
			background: #5cb85c;
			color: #fff;
			padding: 10px;
			border-radius: 3px;
		}

		.signup-form .btn:hover {
			background: #4cae4c;
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
			$ret = mysqli_query($con, "SELECT * FROM tblusers WHERE ID='$eid'");
			while ($row = mysqli_fetch_array($ret)) {
				?>
				<h2>Update User Details</h2>
				<p>Update your information</p>
				<input type="text" name="fname" value="<?php echo $row['FirstName']; ?>" required>
				<input type="text" name="lname" value="<?php echo $row['LastName']; ?>" required>
				<input type="text" name="contactno" value="<?php echo $row['MobileNumber']; ?>" required maxlength="10"
					pattern="[0-9]+">
				<input type="email" name="email" value="<?php echo $row['Email']; ?>" required>
				<textarea name="address" required><?php echo $row['Address']; ?></textarea>
			<?php } ?>
			<button type="submit" class="btn" name="submit">Update</button>
		</form>
	</div>
			</div>
</body>

</html>