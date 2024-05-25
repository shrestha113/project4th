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
            <h2>Marks Information</h2>
            <div class="section">
                <table>
                   
                    <?php
                    // Query to fetch marks information based on username
                    $query_marks_info = mysqli_query($con, "SELECT * FROM marks WHERE User_id='$username'");
                    if ($query_marks_info && mysqli_num_rows($query_marks_info) > 0) {
                        while ($row = mysqli_fetch_assoc($query_marks_info)) {
                            ?>
                             <tr>
                                <td><h2><?php echo $row['semester']; ?></h2></td>
                            </tr>
                             <tr>
                                <th>Subject</th>
                                <th>Marks</th>
                            </tr>
                           
                            <tr>
                                <td><?php echo $row['subject1']; ?></td>
                                <td><?php echo $row['marks1']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['subject2']; ?></td>
                                <td><?php echo $row['marks2']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['subject3']; ?></td>
                                <td><?php echo $row['marks3']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['subject4']; ?></td>
                                <td><?php echo $row['marks4']; ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['subject5']; ?></td>
                                <td><?php echo $row['marks5']; ?></td>
                            </tr>
                            <tr>
                                <td>GPA</td>
                                <td><?php echo $row['gpa']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="2" style="text-align:center; color:red;">No Marks Found</td>
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
