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
            <img src="./src/images/ass.png" alt="">
        </div>
        <div class="student_info">
             <h3>Shreebisha Shrestha</h3>
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

<div class="notice-container">
    
    <h2>Notice Board</h2>
    <div class="notice">
        <h3 class="notice-title">Notice 1</h3>
        <p class="notice-content">This is the content of Notice 1.</p>
    </div>
    <div class="notice">
        <h3 class="notice-title">Notice 2</h3>
        <p class="notice-content">This is the content of Notice 2.</p>
    </div>
    <!-- Add more notices here -->
</div>
    <!-- heading ends -->
  </body>
</html>
