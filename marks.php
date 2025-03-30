<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
    <link rel="stylesheet" href="src/style.css">
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: auto;
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
</head>
<h2>Mark Sheet</h2>

<table>
    <tr>
        <th>Subject</th>
        <th>Marks Obtained</th>
    </tr>
    <tr>
        <td>Mathematics</td>
        <td>85</td>
    </tr>
    <tr>
        <td>Science</td>
        <td>78</td>
    </tr>
    <tr>
        <td>English</td>
        <td>90</td>
    </tr>
    <tr>
        <td>History</td>
        <td>82</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; font-weight: bold;">Total Marks: 335</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: center; font-weight: bold;">Percentage: 83.75%</td>
    </tr>
</table>

</body>
</html>

