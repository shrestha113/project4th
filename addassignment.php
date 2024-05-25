<?php
session_start();
$uid=$_SESSION['id'];
// Check if the username is stored in the session
if (!isset($_SESSION['User_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login1.php");
    exit;
}

// Retrieve the username from the session
$username = $_SESSION['User_id'];

// Include database connection
include('dbconnection.php');

// Initialize variables to store first and last name and photo path
$firstName = "";
$lastName = "";
$photoPath = ""; // Or photo binary data

// Query to fetch first and last name and photo path based on username
$query_info = mysqli_query($con, "SELECT FirstName, LastName, Photo FROM users WHERE User_id='$username'");
if ($query_info && mysqli_num_rows($query_info) > 0) {
    $row = mysqli_fetch_assoc($query_info);
    $firstName = $row['FirstName'];
    $lastName = $row['LastName'];
    $photoPath = $row['Photo'];
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Getting the post values
    $course = $_POST['course'];
    $semester = $_POST['semester'];
    $title = $_POST['title'];

    // File upload handling
    $targetDir = "uploads/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            // Insert data into database
            $query = mysqli_prepare($con, "INSERT INTO assignment (User_id,Course, Semester, Title, Upload) VALUES (?,?, ?, ?, ?)");
            mysqli_stmt_bind_param($query, "issss",$uid, $course, $semester, $title, $fileName);
            $result = mysqli_stmt_execute($query);

            if ($result) {
                echo "<script>alert('Assignment added successfully');</script>";
            } else {
                echo "<script>alert('Failed to add assignment');</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    } else {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG, GIF files are allowed.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Portal</title>
    <link rel="stylesheet" href="src/style.css">
    <style>
    .section {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    } body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        color: #566787;
    }

    .container-xl {
        width: 80%;
        margin: 0 auto;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
    }

    .table th,
    .table td {
        border: 1px solid #e9e9e9;
        padding: 8px;
    }

    .table th {
        background-color: #f2f2f2;
    }

    .table td {
        text-align: left;
    }

    .table-title {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .add-user-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 3px;
        text-decoration: none;
    }

    .add-user-btn:hover {
        background-color: #0056b3;
    }

    .action-icons {
        font-size: 18px;
        margin-right: 5px;
    }

    .action-icons.edit {
        color: #28a745;
    }

    .action-icons.delete {
        color: #dc3545;
    }

    .action-icons.view {
        color: #17a2b8;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid transparent;
        border-radius: 4px;
    }

    .alert-danger a {
        color: #721c24;
        text-decoration: underline;
    }

    .title {
        text-align: center;
    }/* Add this CSS to style the form elements */

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="file"] {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type="file"] {
    margin-top: 5px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Optional: Add some spacing and alignment */
.container-xl {
    max-width: 600px;
    margin: 0 auto;
}

.table-wrapper {
    margin-bottom: 40px;
}

.table-title {
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

button[type="submit"] {
    display: block;
    margin-top: 20px;
}

</style>
</head>

<body>
    <!-- Your HTML content here -->
    <body>
<div class="head_wrap">
    <div class="side_menu">
        <div class="avatar_profile">
            <!-- Display the photo fetched from the database -->
            <img src="<?php echo $photoPath; ?>" alt="">
        </div>
        <div class="student_info">
            <!-- Display first and last name fetched from the database -->
            <h3><?php echo $firstName . " " . $lastName; ?></h3>
        </div>
        <div class="navigation">
        <ul>
                    <li><a href="admin_dashboard.php">Home</a></li>
                    <li><a href="index1.php">Records</a></li>
                    <li><a href="table.php">Time Table</a></li>
                    <li><a href="noticeboard.php">Notice Board</a></li>
                    <li><a href="marks_portal.php">Add Marks</a></li>
                    <a href="login1.php" class="logout-btn">Logout</a>
                 </ul>
        </div>
    </div>

        <div class="info_tab">
            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="title">
                                    <h2>Add Assignment</h2>
                                </div>
                            </div>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="course">Course:</label>
                                <input type="text" class="form-control" id="course" name="course" required>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester:</label>
                                <input type="text" class="form-control" id="semester" name="semester" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="file">Upload PDF File:</label>
                                <input type="file" class="form-control-file" id="file" name="file" accept="application/pdf" required>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
