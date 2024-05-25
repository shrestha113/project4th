<?php
include('dbconnection.php');

if (isset($_POST['submit'])) {
    // Getting the post values
    $eid = $_GET['editid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $nationality = $_POST['nationality'];
    $user_id = $_POST['user_id']; 
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
        // If no new image is uploaded, retain the existing image path
        $photo_path = $_POST['existing_photo']; // Assuming 'existing_photo' is a hidden input field containing the current photo path
    }

    // Query for data update
    $query = mysqli_prepare($con, "UPDATE users SET FirstName=?, LastName=?, DOB=?, Gender=?, Role=?, Nationality=?, Course=?, Semester=?, Email=?, PhoneNumber=?, Address=?, EmergencyContactPersonName=?, EmergencyContactNumber=?, Photo=? ,User_id=? WHERE id=?");

    if ($query === false) {
        die(mysqli_error($con));
    }
    
    // Bind parameters
    mysqli_stmt_bind_param($query, "sssssssssissisii", $fname, $lname, $dob, $gender, $role, $nationality, $course, $semester, $email, $phone, $address, $emergency_contact_name, $emergency_contact_number, $photo_path, $user_id,$eid);

    // Execute query
    $result = mysqli_stmt_execute($query);

    if ($result) {
        echo "<script>alert('You have successfully updated the data');</script>";
        echo "<script type='text/javascript'> document.location ='index1.php'; </script>";
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

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
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
                <form method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <?php
                    $eid = $_GET['editid'];
                    $ret = mysqli_query($con, "SELECT * FROM users WHERE id='$eid'");
                    while ($row = mysqli_fetch_array($ret)) {
                    ?>
                        <h2>Update User Details</h2>
                        <p>Update your information</p>
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" name="fname" id="fname"pattern="[A-Za-z]+" value="<?php echo $row['FirstName']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" name="lname" id="lname" pattern="[A-Za-z]+" value="<?php echo $row['LastName']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth:</label>
                            <input type="text" name="dob" id="dob" value="<?php echo $row['DOB']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="gender" required>
                                <option value="Male" <?php if ($row['Gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($row['Gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                <option value="Other" <?php if ($row['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="role" required>
                                <option value="">Select Role</option>
                                <option value="student" <?php if ($row['Role'] == 'student') echo 'selected'; ?>>Student</option>
                                <option value="teacher" <?php if ($row['Role'] == 'teacher') echo 'selected'; ?>>Teacher</option>
                                <option value="admin" <?php if ($row['Role'] == 'admin') echo 'selected'; ?>>Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nationality">Nationality:</label>
                            <input type="text" name="nationality" id="nationality" value="<?php echo $row['Nationality']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="user_id">User ID:</label>
                            <input type="text" name="user_id" id="user_id" value="<?php echo $row['User_id']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="course">Course:</label>
                            <input type="text" name="course" id="course" value="<?php echo $row['Course']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester:</label>
                            <input type="text" name="semester" id="semester" value="<?php echo $row['Semester']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" value="<?php echo $row['Email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo $row['PhoneNumber']; ?>"  pattern="[0-9]{10}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" id="address" value="<?php echo $row['Address']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="emergency_contact_name">Emergency Contact Name:</label>
                            <input type="text" name="emergency_contact_name" id="emergency_contact_name" value="<?php echo $row['EmergencyContactPersonName']; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="emergency_contact_number">Emergency Contact Number:</label>
                            <input type="tel" name="emergency_contact_number" id="emergency_contact_number" value="<?php echo $row['EmergencyContactNumber']; ?>"  pattern="[0-9]{10}">
                        </div>
                        <div class="form-group">
                            <label for="photo">Upload Photo:</label>
                            <input type="file" name="photo" id="photo" accept="image/*">
                            <input type="hidden" name="existing_photo" value="<?php echo $row['Photo']; ?>">
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn" name="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    <script>
         function validateForm() {
            var fname = document.getElementById('fname').value;
            var lname = document.getElementById('lname').value;
            var dob = document.getElementById('dob').value;
            var gender = document.getElementById('gender').value;
            var role = document.getElementById('role').value;
            var nationality = document.getElementById('nationality').value;
            var user_id = document.getElementById('user_id').value;
            var course = document.getElementById('course').value;
            var semester = document.getElementById('semester').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var address = document.getElementById('address').value;
            var emergency_contact_name = document.getElementById('emergency_contact_name').value;
            var emergency_contact_number = document.getElementById('emergency_contact_number').value;

            // Validation logic for all fields
            if (fname === "" || lname === "" || dob === "" || gender === "" || role === "" || nationality === "" || user_id === "" || course === "" || semester === "" || email === "" || phone === "" || address === "" || emergency_contact_name === "" || emergency_contact_number === "") {
                alert("All fields are required.");
                return false;
            }

            // Validate email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Invalid email format.");
                return false;
            }

            // Validate phone number format
            var phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phone)) {
                alert("Invalid phone number format. It should be 10 digits.");
                return false;
            }

            // Validate emergency contact number format
            if (!phoneRegex.test(emergency_contact_number)) {
                alert("Invalid emergency contact number format. It should be 10 digits.");
                return false;
            }

            // If all validations pass, return true
            return true;
        }
    </script>
    </script>
</body>

</html>
