<?php
// Database Connection file
include('dbconnection.php');

// Delete records
if (isset($_GET['delid'])) {
    $delete_id = intval($_GET['delid']); // Sanitize the input to prevent SQL injection

    // Code for deletion
    $query_delete_marks = mysqli_prepare($con, "DELETE FROM marks WHERE User_id=?");
    mysqli_stmt_bind_param($query_delete_marks, "i", $delete_id);
    $result_delete_marks = mysqli_stmt_execute($query_delete_marks);

    if (!$result_delete_marks) {
        echo "Error deleting record from marks: " . mysqli_error($con);
    }

    // Close prepared statements
    mysqli_stmt_close($query_delete_marks);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="src/style.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        .row {
            display: flex;
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

    
        .title {
            text-align: center;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Additional style for the sidebar */
        .sidebar {
            background-color: #f9f9f9;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }

        .sidebar a {
            display: block;
            padding: 5px 0;
            text-decoration: none;
            color: #333;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }
        button .dropdown-btnd{
            background-color:none;
        }
        .sub-dropdown-container{
            flex-direction:column;
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
                    <li class="dropdown" id="marks-dropdown">
                    <div class="dropdown-btn">Marks 
                    <i class="fa fa-caret-down"></i>
                </div>
                <div class="dropdown-container">
                    <a href="marks_portal.php">BCA</a>
                    <div class="sub-dropdown-container" style="display: none;">
                    <a href="sem1.php">Semester1</a>
                    <a href="sem2.php">Semester2</a>
                    <a href="sem3.php">Semester3</a>
                    <a href="sem4.php">Semester4</a>
                    <a href="sem5.php">Semester5</a>
                    <a href="sem6.php">Semester6</a>
                    <a href="sem7.php">Semester7</a>
                    <a href="sem8.php">Semester8</a>
                    </div>
  </div>
</li>
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
                                    <h2>Marks <b>Management</b></h2>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
            $sql = "SELECT * FROM users WHERE Role='student' AND Course='BCA' AND Semester='7th'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                $cnt = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                  <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $row['FirstName'] . ' ' . $row['LastName']; ?></td>
                        <td><?php echo $row['Course'] . " " . $row['Semester']; ?></td>
                        <td>
                            <?php
                            $marks_exist_query = mysqli_prepare($con, "SELECT * FROM marks WHERE User_id=?");
                            mysqli_stmt_bind_param($marks_exist_query, "i", $row['id']);
                            mysqli_stmt_execute($marks_exist_query);
                            mysqli_stmt_store_result($marks_exist_query);
                            $num_rows = mysqli_stmt_num_rows($marks_exist_query);
                            mysqli_stmt_close($marks_exist_query);

                            if ($num_rows == 0) {
                                ?>
                                <a href="add_marks.php?addid=<?php echo htmlentities($row['id']); ?>"
                                    class="add-marks-btn" title="Add Marks" data-toggle="tooltip"><i class='fas fa-eye'></i></a>
                            <?php } ?>
                            <a href="edit_marks.php?editid=<?php echo htmlentities($row['id']); ?>"
                                class="edit-marks-btn" title="Edit Marks" data-toggle="tooltip"><i class='fas fa-edit'></i></a>
                            <a href="marks_portal.php?delid=<?php echo htmlentities($row['User_id']); ?>"
                                class="delete-btn" title="Delete" data-toggle="tooltip"><i class='fas fa-trash-alt'></i></a>
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
            <?php } ?>
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;

        for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            } else {
            dropdownContent.style.display = "block";
            }
        });
        }

        // Additional script for the double dropdown
        var subDropdown = document.getElementsByClassName("sub-dropdown-container");

        for (i = 0; i < subDropdown.length; i++) {
        subDropdown[i].previousElementSibling.addEventListener("click", function() {
            var subDropdownContent = this.nextElementSibling;
            if (subDropdownContent.style.display === "flex") {
            subDropdownContent.style.display = "none";
            } else {
            subDropdownContent.style.display = "flex";
            }
        });
        }
        </script>
</body>

</html>
