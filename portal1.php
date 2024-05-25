<?php
session_start();

// Check if the username is stored in the session
if (!isset($_SESSION['User_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login1.php");
    exit;
}

// Retrieve the username from the session
$username = $_SESSION['User_id'];

// Include database connection
include ('dbconnection.php');

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
    $photoPath = $row['Photo']; // Or fetch photo binary data
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
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
        }
    </style>
</head>

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
                    <li><a href="portal1.php">Home</a></li>
                    <li><a href="timetable.php">Time Table</a></li>
                    <li><a href="notice.php">Notice Board</a></li>
                    <li><a href="marks1.php">Marks</a></li>
                    <li><a href="assignment_portal.php">Assignment</a></li>
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
                </ul>
            </div>
        </div>
        <div class="info_tab">
            <h2>Personal Information</h2>
            <div class="section">
                <table>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <?php
                    // Query to fetch personal information based on username
                    $query_personal_info = mysqli_query($con, "SELECT * FROM users WHERE User_ID='$username'");
                    while ($row = mysqli_fetch_assoc($query_personal_info)) {
                        ?>
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $row['FirstName']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $row['LastName']; ?></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><?php echo $row['DOB']; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo $row['Gender']; ?></td>
                        </tr>
                        <tr>
                            <td>Nationality</td>
                            <td><?php echo $row['Nationality']; ?></td>
                        </tr>
                        <tr>
                            <td>Student ID</td>
                            <td><?php echo $row['User_id']; ?></td>
                        </tr>
                        <tr>
                            <td>Course</td>
                            <td><?php echo $row['Course']; ?></td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td><?php echo $row['Semester']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

            <h2>Contact Information</h2>
            <div class="section">
                <table>
                    <tr>
                        <th>Field</th>
                        <th>Value</th>
                    </tr>
                    <?php
                    // Query to fetch contact information based on username
                    $query_contact_info = mysqli_query($con, "SELECT * FROM users WHERE User_id='$username'");
                    while ($row = mysqli_fetch_assoc($query_contact_info)) {
                        ?>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $row['Email']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td><?php echo $row['PhoneNumber']; ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><?php echo $row['Address']; ?></td>
                        </tr>
                        <tr>
                            <td>Emergency Contact</td>
                            <td><?php echo $row['EmergencyContactPersonName']; ?></td>
                        </tr>
                        <tr>
                            <td>Emergency Contact Number</td>
                            <td><?php echo $row['EmergencyContactNumber']; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>