<?php
include('dbconnection.php');

$errors = [];

if (isset($_POST['submit'])) {
    // Validate required fields
    $required_fields = ['fname', 'lname', 'dob', 'gender', 'role', 'nationality', 'User_id', 'password', 'email', 'phone', 'address', 'emergency_contact_name', 'emergency_contact_number'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . " is required.";
        }
    }

    // Validate email format
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Validate phone number format
    if (!preg_match("/^[0-9]{10}$/", $_POST['phone'])) {
        $errors['phone'] = "Invalid phone number format. It should be 10 digits.";
    }

    // Validate emergency contact number format
    if (!preg_match("/^[0-9]{10}$/", $_POST['emergency_contact_number'])) {
        $errors['emergency_contact_number'] = "Invalid emergency contact number format. It should be 10 digits.";
    }

    // If there are no validation errors, proceed with data insertion
    if (empty($errors)) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $role = $_POST['role'];
        $nationality = $_POST['nationality'];
        $student_id = $_POST['User_id']; // Changed from $user_id
        $password = $_POST['password'];
        $course = $_POST['course'];
        $semester = $_POST['semester'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $emergency_contact_name = $_POST['emergency_contact_name'];
        $emergency_contact_number = $_POST['emergency_contact_number'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if User_id already exists
        $check_query = mysqli_prepare($con, "SELECT User_id FROM users WHERE User_id = ?");
        mysqli_stmt_bind_param($check_query, "s", $student_id);
        mysqli_stmt_execute($check_query);
        mysqli_stmt_store_result($check_query);

        if (mysqli_stmt_num_rows($check_query) > 0) {
            $errors['User_id'] = "User ID already exists. Please choose a different User ID.";
        }

        mysqli_stmt_close($check_query);


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
        $query = mysqli_prepare($con, "INSERT INTO users (FirstName, LastName, DOB, Gender, Role, Nationality, User_id, Password, Course, Semester, Email, PhoneNumber, Address, EmergencyContactPersonName, EmergencyContactNumber, Photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($query) {
            mysqli_stmt_bind_param($query, "ssssssssssssssss", $fname, $lname, $dob, $gender, $role, $nationality, $student_id, $hashed_password, $course, $semester, $email, $phone, $address, $emergency_contact_name, $emergency_contact_number, $photo_path);

            $result = mysqli_stmt_execute($query);

            if ($result) {
                echo "<script>alert('You have successfully inserted the data');</script>";
                echo "<script type='text/javascript'> document.location ='index1.php'; </script>";
                exit;
            } else {
                echo "<script>alert('Something Went Wrong. Please try again');</script>";
            }
        } else {
            echo "<script>alert('Error in preparing SQL query. Please try again');</script>";
        }

        mysqli_stmt_close($query);
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
                <form method="POST" enctype="multipart/form-data" name="userForm" onsubmit="return validateForm()">
                    <h2>Fill Data</h2>
                    <p>Fill below form.</p>
                    <div class="form-group">
                        <input type="text" name="fname" placeholder="First Name" pattern="[A-Za-z]+" required>
                        <input type="text" name="lname" placeholder="Last Name"pattern="[A-Za-z]+" required>
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
                        <input type="text" name="User_id" placeholder="User ID" required pattern="[0-9]+">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="text" name="course" placeholder="Course" >
                    </div>
                    <div class="form-group">
                        <input type="text" name="semester" placeholder="Semester" >
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}">
                        <input type="text" name="address" placeholder="Address" required></input>
                    </div>
                    <div class="form-group">
                        <input type="text" name="emergency_contact_name" placeholder="Emergency Contact Person Name"
                            >
                        <input type="tel" name="emergency_contact_number" placeholder="Emergency Contact Number"
                             pattern="[0-9]{10}">
                    </div>
                    <div class="form-group">
                        <label for="photo">Upload Photo:</label>
                        <input type="file" name="photo" id="photo" accept="image/*">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit">Submit</button>
                    </div>
                </form>
                <div class="text-center">View Already Inserted Data!! <a href="index1.php">View</a></div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            var firstName = document.forms["userForm"]["fname"].value;
            var lastName = document.forms["userForm"]["lname"].value;
            var dob = document.forms["userForm"]["dob"].value;
            var gender = document.forms["userForm"]["gender"].value;
            var role = document.forms["userForm"]["role"].value;
            var nationality = document.forms["userForm"]["nationality"].value;
            var userId = document.forms["userForm"]["User_id"].value;
            var password = document.forms["userForm"]["password"].value;
            var email = document.forms["userForm"]["email"].value;
            var phone = document.forms["userForm"]["phone"].value;
            var address = document.forms["userForm"]["address"].value;
            var emergencyContactName = document.forms["userForm"]["emergency_contact_name"].value;
            var emergencyContactNumber = document.forms["userForm"]["emergency_contact_number"].value;

            // Validation logic
            if (firstName == "" || lastName == "" || dob == "" || gender == "" || role == "" || nationality == "" || userId == "" || password == "" || email == "" || phone == "" || address == "" || emergencyContactName == "" || emergencyContactNumber == "") {
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
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }
            // Validate emergency contact number format
            if (!phoneRegex.test(emergencyContactNumber)) {
                alert("Invalid emergency contact number format. It should be 10 digits.");
                return false;
            }

            // If all validations pass, return true
            return true;
        }
    </script>
</body>

</html>
