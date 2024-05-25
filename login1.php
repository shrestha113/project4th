<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Or your MySQL password
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $username = $_POST['User_id'];
    $password = $_POST['password'];
    
    $role = $_POST['role'];

    // Validate form fields
    if (empty($username) || empty($password) || empty($role)) {
        $error_message = "All fields are required.";
    } else {
        // Validate login credentials
        $sql = "SELECT * FROM users WHERE User_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['Password']) && $row['Role'] === $role) {
                // Login successful, set session username and role
                $_SESSION['User_id'] = $username;
                $_SESSION['Role'] = $role;
                $_SESSION['id']=$row['id'];


                // Redirect to dashboard
                switch ($role) {
                    case 'student':
                        header("Location: portal1.php");
                        exit;
                    case 'teacher':
                        header("Location: teacher_dashboard.php");
                        exit;
                    case 'admin':
                        header("Location: admin_dashboard.php");
                        exit;
                    default:
                        $error_message = "Invalid role.";
                        break;
                }
            } else {
                // Login failed, set error message
                $error_message = "Invalid username, password, or role.";
            }
        } else {
            // Login failed, set error message
            $error_message = "Invalid username.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(10deg, rgba(31, 31, 31, 1) 0%, rgba(0, 15, 97, 1) 100%);
        }

        .login-container {
            width: 300px;
            padding: 30px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .forgot-password {
            margin: 10px;
            text-align: center;
        }
        .forgot-password a{
            text-decoration:none;
            color:blue;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php
        // Display error message if it is set
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        }
        ?>
        <form id="login-form" action="login1.php" method="POST">
            <input type="text" name="User_id" placeholder="User_id" required>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <select name="role" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
        <div class="forgot-password">
            <a href="forgot_password.php">Change Password</a>
        </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
