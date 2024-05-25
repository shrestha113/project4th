<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['username'])) {
    // Retrieve the username from the session
    $username = $_SESSION['username'];

    // Include database connection
    include ('dbconnection.php');

    // Initialize variables to store first and last name and photo path
    $firstName = "";
    $lastName = "";
    $photoPath = ""; // Or photo binary data

    // Query to fetch first and last name and photo path based on username
    $query_info = mysqli_query($con, "SELECT FirstName, LastName, Photo, Course FROM tabledata WHERE StudentID='$username'");
    if ($query_info && mysqli_num_rows($query_info) > 0) {
        $row = mysqli_fetch_assoc($query_info);
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $photoPath = $row['Photo']; // Or fetch photo binary data
        $course = $row['Course'];
        
        // Store course in session variable
        $_SESSION['course'] = $course;
    }
    
    // Query to fetch periods based on course
    $query_timetable = mysqli_query($con, "SELECT period1, period2, period3, period4, period5 FROM timetable WHERE course='$course'");
    // Check if query is successful
    if ($query_timetable) {
        // Fetch all rows
        $rows = mysqli_fetch_all($query_timetable, MYSQLI_ASSOC);
    } else {
        // If query fails, set rows to an empty array
        $rows = array();
    }
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
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
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
                <li><a href="portal.php">Home</a></li>
                <li><a href="examform.php">Registration Form</a></li>
                <li><a href="timetable.php">Time Table</a></li>
                <li><a href="marks.php">Marks</a></li>
                <li><a href="notice.php">Notice Board</a></li>

            </ul>
        </div>
      </div>
<body>

<table>

    <caption><h2>Class Routine</h2></caption>
    <tr>
   
    

</body>
</html>
