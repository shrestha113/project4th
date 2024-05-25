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
    $query_info = mysqli_query($con, "SELECT FirstName, LastName, Photo, Course FROM users WHERE User_id='$username'");
    if ($query_info && mysqli_num_rows($query_info) > 0) {
        $row = mysqli_fetch_assoc($query_info);
        $firstName = $row['FirstName'];
        $lastName = $row['LastName'];
        $photoPath = $row['Photo']; }
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
    .notice-container {
        width: 70%;
        margin: 0 auto;
        margin-left:25%;
        margin-top:20px;
    }
    
    .notice {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
    }
    
    .notice-title {
        margin-top: 0;
    }
    
    .notice-content {
        margin-bottom: 0;
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

<div class="notice-container">
    
    <h2 align=center>Notice Board</h2>
    <?php
            // Query to fetch notices from the notice table
            $query = mysqli_query($con, "SELECT * FROM notice_board");

            // Check if there are any notices
            if (mysqli_num_rows($query) > 0) {
                // Loop through each notice and display it
                while ($row = mysqli_fetch_assoc($query)) {
                    echo '<div class="notice">';
                    echo '<p class="notice-content">'.'<p style="font-size:16px;"> Date:'.  $row['Date'].'</p><h2>'. $row['Title'] .'</h2>' .$row['notice'] . '</p>';
                    echo '</div>';
                }
            } else {
                // If no notices found
                echo '<p>No notices found.</p>';
            }
            ?>
        
    <!-- Add more notices here -->
</div>
    <!-- heading ends -->
  </body>
</html>
