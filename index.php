<?php
// Include database connection file
include ('dbconnection.php');

// Code for deletion
if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "DELETE FROM tblusers WHERE ID=$rid");
    if ($sql) {
        echo "<script>alert('Data deleted');</script>";
        echo "<script>window.location.href = 'index.php'</script>";
    } else {
        echo "<script>alert('Failed to delete data');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
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
             <h3>Shreebisha Shrestha</h3>
        </div>
        
        <div class="navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="examform.html">Registration Form</a></li>
                <li><a href="timetable.html">Time Table</a></li>
                <li><a href="marks.html">Marks</a></li>

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
                            <h2>User <b>Management</b></h2>
                        </div>
                        <div class="addbutton" align="right">
                            <a href="insert.php" class="add-user-btn">Add New User</a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tblusers";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            $cnt = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></td>
                                    <td><?php echo $row['Email']; ?></td>
                                    <td><?php echo $row['MobileNumber']; ?></td>
                                    <td><?php echo $row['CreationDate']; ?></td>
                                    <td>
                                        <a href="read.php?viewid=<?php echo htmlentities($row['ID']); ?>"
                                            class="action-icons view" title="View" data-toggle="tooltip">View</a>
                                        <a href="edit.php?editid=<?php echo htmlentities($row['ID']); ?>"
                                            class="action-icons edit" title="Edit" data-toggle="tooltip">Edit</a>
                                        <a href="index.php?delid=<?php echo htmlentities($row['ID']); ?>"
                                            class="action-icons delete" title="Delete" data-toggle="tooltip"
                                            onclick="return confirm('Do you really want to delete?');">Delete</a>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    
</body>

</html>