<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
    <link rel="stylesheet" href="src/style.css">
    <style>
        form {
            width: 50%;
            margin: auto;
        }
        input[type="text"], input[type="email"], input[type="number"], select, textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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

<form action="/submit_exam" method="post">
    
<h2>Exam Registration Form</h2>

    <label for="student_id">Student ID Number:</label>
    <input type="text" id="student_id" name="student_id" required>

    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="subject_code">Subject Code:</label>
    <input type="text" id="subject_code" name="subject_code" required>

    <label for="registration_number">Registration Number:</label>
    <input type="text" id="registration_number" name="registration_number" required>

    <label for="subject">Subject:</label>
    <select id="subject" name="subject" required>
        <option value="">Select a subject</option>
        <option value="Math">Math</option>
        <option value="Science">Science</option>
        <option value="History">History</option>
        <option value="Literature">Literature</option>
    </select>

    <label for="exam_date">Exam Date:</label>
    <input type="date" id="exam_date" name="exam_date" required>

    <label for="message">Additional Notes:</label>
    <textarea id="message" name="message" rows="4"></textarea>

    <input type="submit" value="Submit">
</form>

    <!-- heading ends -->
  </body>
</html>
