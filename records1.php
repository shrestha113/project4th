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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
    <link rel="stylesheet" href="src/style.css">
    <style>
        /* Add your CSS styles here */
    </style>
</head>

<body>
    <!-- Heading and Navigation Section -->
    <div class="head_wrap">
        <div class="side_menu">
            <!-- Sidebar content -->
        </div>

        <div class="info_tab">
            <!-- Content for user information -->
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
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Nationality</th>
                                    <th>Student ID</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Emergency Contact</th>
                                    <th>Emergency Contact Number</th>
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
                                            <td><?php echo $row['Username']; ?></td>
                                            <td><?php echo $row['Password']; ?></td>
                                            <td><?php echo $row['FirstName']; ?></td>
                                            <td><?php echo $row['LastName']; ?></td>
                                            <td><?php echo $row['DateOfBirth']; ?></td>
                                            <td><?php echo $row['Gender']; ?></td>
                                            <td><?php echo $row['Nationality']; ?></td>
                                            <td><?php echo $row['StudentID']; ?></td>
                                            <td><?php echo $row['Email']; ?></td>
                                            <td><?php echo $row['PhoneNumber']; ?></td>
                                            <td><?php echo $row['Address']; ?></td>
                                            <td><?php echo $row['EmergencyContact']; ?></td>
                                            <td><?php echo $row['EmergencyContactNumber']; ?></td>
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
                                        <td colspan="16" style="text-align:center; color:red;">No Record Found</td>
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
    </div>
</body>

</html>