<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['User_id'])) {
    // Retrieve the username from the session
    $username = $_SESSION['User_id'];

    // Include database connection
    include('dbconnection.php');

    // Initialize variables to store first and last name and photo path
    $firstName = "";
    $lastName = "";
    $photoPath = ""; // Or photo binary data

    // Query to fetch first and last name and photo path based on username
    $query_info = mysqli_query($con, "SELECT FirstName, LastName, Photo, Course, Semester FROM users WHERE User_id='$username'");
    if ($query_info && mysqli_num_rows($query_info) > 0) {
        $row = mysqli_fetch_assoc($query_info);
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $photoPath = $row['Photo']; // Or fetch photo binary data
        $course = $row['Course'];
        $semester = $row['Semester'];

        // Store course and semester in session variables
        $_SESSION['course'] = $course;
        $_SESSION['semester'] = $semester;
    }

    // Query to retrieve assignments based on course and semester
    $query_assignments = mysqli_query($con, "SELECT title, upload FROM assignment WHERE Course='$course' AND Semester='$semester'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="src/style.css">
    <style>
        table {
            background-color: white;
            width: 80%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>

<body>
    <!-- heading  -->

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
                <caption><h2>Assignments</h2></caption>
                <?php while ($assignment = mysqli_fetch_assoc($query_assignments)) : ?>
                    <div class="pdf-cont">
                        <h1 align="center"><?php echo $assignment['title']; ?></h1><br>
                        <embed src="uploads/<?php echo $assignment['upload']; ?>" type="application/pdf" width="100%" height="600px" />
                    </div>



                <?php endwhile; ?>
        </div>
    </div>

</body>

</html>

<?php
    // Free result set
    mysqli_free_result($query_assignments);
}
?>
