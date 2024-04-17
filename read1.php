<?php
include ('dbconnection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Crud Operation Using PHP and MySQLi</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="src/style.css">
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        .container1 {
            width: 80%;
            margin: 0 auto;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-title h2 {
            margin: 5px 0 0;
        }

        .table tr th,
        .table tr td {
            border-color: #e9e9e9;
            padding: 12px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table td:last-child {
            width: 130px;
        }

        .table td a {
            color: #566787;
            display: inline-block;
            margin: 0 5px;
        }

        .table td a.view {
            color: #03A9F4;
        }

        .table td a.edit {
            color: #FFC107;
        }

        .table td a.delete {
            color: #E34724;
        }

        .table td i {
            font-size: 19px;
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
                    <li><a href="portal.html">Home</a></li>
                    <li><a href="examform.html">Registration Form</a></li>
                    <li><a href="timetable.html">Time Table</a></li>
                    <li><a href="marks.html">Marks</a></li>
                    <li><a href="notice.html">Notice Board</a></li>

                </ul>
            </div>
        </div>

        <div class="info_tab">
            <div class="container1">
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="title">
                                    <h2>User <b>Details</b></h2>
                                </div>
                            </div>
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered"
                            id="hidden-table-info">
                            <tbody>
                                <?php
                                $vid = $_GET['viewid'];
                                $ret = mysqli_query($con, "select * from tabledata where UserID =$vid");
                                $cnt = 1;
                                while ($row = mysqli_fetch_array($ret)) {
                                    ?>
                                    <tr>
                                        <th>First Name</th>
                                        <td><?php echo $row['FirstName']; ?></td>
                                        <th>Last Name</th>
                                        <td><?php echo $row['LastName']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $row['Email']; ?></td>
                                        <th>Mobile Number</th>
                                        <td><?php echo $row['PhoneNumber']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo $row['Address']; ?></td>

                                        <th>Nationality</th>
                                        <td><?php echo $row['Nationality']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td><?php echo $row['DOB']; ?></td>
                                        <th>Gender</th>
                                        <td><?php echo $row['Gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Student ID</th>
                                        <td><?php echo $row['StudentID']; ?></td>
                                        <th>Password</th>
                                        <td><?php echo $row['Password']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Course</th>
                                        <td><?php echo $row['Course']; ?></td>
                                        <th>Semester</th>
                                        <td><?php echo $row['Semester']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo $row['Email']; ?></td>
                                        <th>Phone Number</th>
                                        <td><?php echo $row['PhoneNumber']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Emergency Contact Person Name</th>
                                        <td><?php echo $row['EmergencyContactPersonName']; ?></td>
                                        <th>Emergency Contact Number</th>
                                        <td><?php echo $row['EmergencyContactNumber']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Photo</th>
                                        <td><img src="<?php echo $row['Photo']; ?>" width=100px alt="Student Photo"></td>
                                    </tr>


                                    <?php
                                    $cnt = $cnt + 1;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</body>

</html>