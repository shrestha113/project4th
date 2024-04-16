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
      background-color: #f44336;
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
          <li><a href="records.php">Records</a></li>
          <a href="login.php" class="logout-btn">Logout</a>
        </ul>
      </div>
    </div>
    <div class="container1">
      <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
      </div>
      <div class="dashboard-cards">
        <!-- Sample cards for dashboard -->
        <div class="card">
          <h2>Total Students</h2>
          <p>500</p>
        </div>
        <div class="card">
          <h2>Total Courses</h2>
          <p>20</p>
        </div>
        <div class="card">
          <h2>Attendance Rate</h2>
          <p>75%</p>
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