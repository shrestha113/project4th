<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
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
        }
    </style>
</head>

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

    <div class="info_tab">


        <h2>Personal Information</h2>
        <div class="section">
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>John</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>Doe</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>1995-05-20</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>Male</td>
                </tr>
                <tr>
                    <td>Nationality</td>
                    <td>American</td>
                </tr>
                <tr>
                    <td>Student ID</td>
                    <td>123456789</td>
                </tr>
                <tr>
                    <td>Course</td>
                    <td>BCA</td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>4th</td>
                </tr>
            </table>
        </div>

        <h2>Contact Information</h2>
        <div class="section">
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>john.doe@example.com</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>123-456-7890</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>123 Main St, City, State, Zip</td>
                </tr>
                <tr>
                    <td>Emergency Contact</td>
                    <td>Jane Doe (Spouse)</td>
                </tr>
                <tr>
                    <td>Emergency Contact Number</td>
                    <td>987-654-3210</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- heading ends -->
    </body>

</html>