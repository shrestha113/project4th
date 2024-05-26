<?php
// Database Connection file
include('dbconnection.php');

if (isset($_GET['delid'])) {
    $delete_id = intval($_GET['delid']); 

    // Code for deletion           
    
    $query_delete_timetable = mysqli_prepare($con, "DELETE FROM timetable WHERE Timetable_ID=?");
    mysqli_stmt_bind_param($query_delete_timetable, "i", $delete_id);
    $result_delete_timetable = mysqli_stmt_execute($query_delete_timetable);

    if (!$result_delete_timetable) {
        echo "Error deleting record from timetable: " . mysqli_error($con);
    }

    // Close prepared statement
    mysqli_stmt_close($query_delete_timetable);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="src/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #566787;
        }

        .container-xl {
            width: 80%;
            margin: 0 auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        }

        .table th,
        .table td {
            border: 1px solid #e9e9e9;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td {
            text-align: left;
        }

        .table-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .add-user-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            text-decoration: none;
        }

        .add-user-btn:hover {
            background-color: #0056b3;
        }

        .action-icons {
            font-size: 18px;
            margin-right: 5px;
        }

        .action-icons.edit {
            color: #28a745;
        }

        .action-icons.delete {
            color: #dc3545;
        }

        .action-icons.view {
            color: #17a2b8;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger a {
            color: #721c24;
            text-decoration: underline;
        }

        .title {
            text-align: center;
        }
    </style>
</head>

<body>
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
                    <li><a href="marks_portal.php"> Marks</a></li></a></li>
                    <a href="login1.php" class="logout-btn">Logout</a>
                 </ul>
            </div>
        </div>

        <div class="info_tab">
            <div class="container-xl">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="title">
                                    <h2>Table <b>Management</b></h2>
                                </div>
                                <div class="addbutton" align="right">
                                    <a href="addtable.php" class="add-user-btn">Add New Time Table</a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Courses</th>
                                                <th>1st</th>
                                                <th>2nd</th>
                                                <th>3rd</th>
                                                <th>4th</th>
                                                <th>5th</th>
                                                <th>Change</th>
                                            </tr>
                                        </thead>
                            <body>
                                <?php
                                $sql = "SELECT * FROM timetable";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                           
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['Course']. " ".$row['Semester'];?></td>
                                            <td><?php echo $row['period1']; ?></td>
                                            <td><?php echo $row['period2']; ?></td>
                                            <td><?php echo $row['period3']; ?></td>
                                            <td><?php echo $row['period4']; ?></td>
                                            <td><?php echo $row['period5']; ?></td>
                                            <td>
                                                <a href="edittimetable.php?editid=<?php echo htmlentities($row['Timetable_ID']); ?>"
                                                    class="action-icons edit" title="Edit" data-toggle="tooltip"><i class='fas fa-edit'></i></a>
                                                <a href="table.php?delid=<?php echo htmlentities($row['Timetable_ID']); ?>"
                                                    class="action-icons delete" title="Delete" data-toggle="tooltip"
                                                    onclick="return confirm('Do you really want to delete?');"><i class='fas fa-trash-alt'></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        $cnt++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" style="text-align:center; color:red;">No Record Found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </body>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>