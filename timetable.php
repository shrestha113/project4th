<?php
// Start the session
session_start();

// Check if the username is set in the session
if (isset($_SESSION['User_id'])) {
    // Retrieve the username from the session
    $username = $_SESSION['User_id'];

    // Include database connection
    include ('dbconnection.php');

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
        
        // Store course in session variable
        $_SESSION['course'] = $course;
    }
    
    // Query to fetch periods based on course and semester
    $query_timetable = mysqli_query($con, "SELECT time1, time2, time3, time4, time5, period1, period2, period3, period4, period5 FROM timetable WHERE Course='$course' AND Semester='$semester'");
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
            background-color:white;
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
    <?php if (empty($rows)): ?>
        <h2 style="color:red;">No record found.</h2>
    <?php else: ?>
    <table>
        <caption><h2>Class Routine</h2></caption>
        <tr>
            <th>Day/Time</th>
            <th><?php echo $rows[0]['time1']; ?></th>
            <th><?php echo $rows[0]['time2']; ?></th>
            <th><?php echo $rows[0]['time3']; ?></th>
            <th><?php echo $rows[0]['time4']; ?></th>
            <th><?php echo $rows[0]['time5']; ?></th>
        </tr>
        <?php foreach ($rows as $row): ?>
        <tr>
            <td>Sunday</td>
            <td><?php echo $row['period1']; ?></td>
            <td><?php echo $row['period2']; ?></td>
            <td><?php echo $row['period3']; ?></td>
            <td><?php echo $row['period4']; ?></td>
            <td><?php echo $row['period5']; ?></td>
        </tr>
        <tr>
            <td>Monday</td>
            <td><?php echo $row['period1']; ?></td>
            <td><?php echo $row['period2']; ?></td>
            <td><?php echo $row['period3']; ?></td>
            <td><?php echo $row['period4']; ?></td>
            <td><?php echo $row['period5']; ?></td>
        </tr>
        <tr>
            <td>Tuesday</td>
            <td><?php echo $row['period1']; ?></td>
            <td><?php echo $row['period2']; ?></td>
            <td><?php echo $row['period3']; ?></td>
            <td><?php echo $row['period4']; ?></td>
            <td><?php echo $row['period5']; ?></td>
        </tr>
        <tr>
            <td>Wednesday</td>
            <td><?php echo $row['period1']; ?></td>
            <td><?php echo $row['period2']; ?></td>
            <td><?php echo $row['period3']; ?></td>
            <td><?php echo $row['period4']; ?></td>
            <td><?php echo $row['period5']; ?></td>
        </tr>
        <tr>
            <td>Thursday</td>
            <td><?php echo $row['period1']; ?></td>
            <td><?php echo $row['period2']; ?></td>
            <td><?php echo $row['period3']; ?></td>
            <td><?php echo $row['period4']; ?></td>
            <td><?php echo $row['period5']; ?></td>
        </tr>
        <tr>
            <td>Friday</td>
            <td><?php echo $row['period1']; ?></td>
            <td><?php echo $row['period2']; ?></td>
            <td><?php echo $row['period3']; ?></td>
            <td><?php echo $row['period4']; ?></td>
            <td><?php echo $row['period5']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>
</div>

</div>
  
</body>
</html>