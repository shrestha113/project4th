<?php
session_start();

// Check if the username is stored in the session
if (!isset($_SESSION['User_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login1.php");
    exit;
}

// Retrieve the username from the session
$username = $_SESSION['User_id'];

// Include database connection
include ('dbconnection.php');

// Initialize variables to store first and last name and photo path
$firstName = "";
$lastName = "";
$photoPath = ""; // Or photo binary data

// Query to fetch first and last name and photo path based on username
$query_info = mysqli_query($con, "SELECT FirstName, LastName, Photo FROM users WHERE User_id='$username'");
if ($query_info && mysqli_num_rows($query_info) > 0) {
    $row = mysqli_fetch_assoc($query_info);
    $firstName = $row['FirstName'];
    $lastName = $row['LastName'];
    $photoPath = $row['Photo']; // Or fetch photo binary data
}
if(isset($_GET['delid'])){
    // Get the assignment ID to be deleted
    $id = $_GET['delid'];
    
    // Prepare and execute the delete query
    $query_delete = mysqli_query($con, "DELETE FROM assignment WHERE id='$id'");
    
    if($query_delete){
        // If deletion is successful, redirect to the same page with a success message
        header("Location: assignment.php?deletesuccess");
        exit;
    } else {
        // If deletion fails, redirect to the same page with an error message
        header("Location: assignment.php?deleteerror");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Portal</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="src/style.css">
    <style>
        .section {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        } body {
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
                <!-- Display the photo fetched from the database -->
                <img src="<?php echo $photoPath; ?>" alt="">
            </div>
            <div class="student_info">
                <!-- Display first and last name fetched from the database -->
                <h3><?php echo $firstName . " " . $lastName; ?></h3>
            </div>
            <div class="navigation">
            <ul>
                    <li><a href="teacher_dashboard.php">Home</a></li>
                    <li><a href="assignment.php">Assignment</a></li>
                    <li><a href="teacher_notice.php">Notice Board</a></li>
                    <li><a href="logout.php" class="logout-btn">Logout</a></li>
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
                                    <h2>Assignment <b>Management</b></h2>
                                </div>
                                <div class="addbutton" align="right">
                                    <a href="addassignment.php" class="add-user-btn">Add New Assignment </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Course</th>
                                                <th>Title</th>
                                                <th>Change</th>
                                            </tr>
                                        </thead>
                            <body>
                                <?php
                                $sql = "SELECT * FROM assignment";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                           
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo $row['Course']. " ".$row['Semester'];?></td>
                                            <td><?php echo $row['Title']; ?></td>
                                            <td>
                                                <a href="editassignment.php?editid=<?php echo htmlentities($row['id']); ?>"
                                                    class="action-icons edit" title="Edit" data-toggle="tooltip">
                                                       
                                            <i class='fas fa-edit'></i></a>
                                                <a href="assignment.php?delid=<?php echo htmlentities($row['id']); ?>"
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
    </div>
</body>

</html>
