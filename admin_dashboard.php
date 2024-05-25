<?php
  session_start();  
  
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

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container1 {
      display: flex;
      flex-direction: column;
      margin: 0 auto;
      padding: 20px;
    }

    .dashboard-header h1 {
      text-align: center;
    }

    .dashboard-cards {
      display: flex;
      flex-direction: row;
    }

    .card {
      color: rgb(0, 0, 0);
      background-color: white;
      margin: 20px;
      border-radius: 4px;
      padding: 20px;
      margin text-align: center;
    }

    .logout-btn {
      display: inline-block;
      padding: 10px 20px;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .logout-btn:hover {
      background-color: #d32f2f;
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
    <div class="container1">
      <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
      </div>
      <div class="dashboard-cards">
        <?php
        // Include database connection
        include('dbconnection.php');

        // Query to fetch total number of students
        $query_total_students = mysqli_query($con, "SELECT COUNT(*) AS total_students FROM users WHERE role='student'");
        // Check if query is successful
        if ($query_total_students && mysqli_num_rows($query_total_students) > 0) {
          $total_students_row = mysqli_fetch_assoc($query_total_students);
          $total_students = $total_students_row['total_students'];
        } else {
          $total_students = 0;
        }
        
        // Query to fetch total number of teachers
        $query_total_teachers = mysqli_query($con, "SELECT COUNT(*) AS total_teachers FROM users WHERE role='teacher'");
        // Check if query is successful
        if ($query_total_teachers && mysqli_num_rows($query_total_teachers) > 0) {
          $total_teachers_row = mysqli_fetch_assoc($query_total_teachers);
          $total_teachers = $total_teachers_row['total_teachers'];
          
        } else {
          $total_teachers = 0;
        }
        ?>
        <div class="card">
          <h2>Total Students</h2>
          <p><?php echo $total_students?></p>
        </div>
        <div class="card">
          <h2>Total Teachers</h2>
          <p><?php echo $total_teachers; ?></p>
        </div>
        <!-- Add more cards as needed -->
      </div>
      <!-- Placeholder for charts, graphs, etc. -->
      <div id="chart-container">
        <!-- Add charts/graphs using libraries like Chart.js, D3.js, etc. -->
      </div>
    </div>
  </div>
</body>

</html>
