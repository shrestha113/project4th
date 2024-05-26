<?php
// Database Connection file
include('dbconnection.php');

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
    if (isset($_POST['password']) && isset($_POST['confirm_password']) && isset($_POST['email']) && isset($_POST['token'])) {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $email = $_POST['email'];
        $token = $_POST['token'];

        // Check if passwords match and are at least 8 characters long
        if ($password === $confirm_password && strlen($password) >= 8) {
            // Update password
            $sql = "UPDATE users SET Password=? WHERE Email=? AND reset_token=?";
            $stmt = $conn->prepare($sql);
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $hashed_password, $email, $token);
            $stmt->execute();

            // Clear the reset token after the password has been reset
            $sql = "UPDATE users SET reset_token=NULL WHERE Email=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            $success_message = "Your password has been successfully reset.";
        } else {
            // Passwords do not match or not long enough
            $error_message = "Passwords do not match or are not at least 8 characters long.";
        }

        $stmt->close();
    } else {
        // Form fields are not set, set error message
        $error_message = "Form fields are not set.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
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

        input[type="password"] {
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
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Reset Password</h2>
        <?php
        // Display error message if it is set
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        } elseif (isset($success_message)) {
            echo '<p style="color: green;">' . $success_message . '</p>';
        }
        ?>
        <form id="reset-password-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <?php if (isset($_GET['email']) && isset($_GET['token'])): ?>
            <input type="hidden" name="email" value="<?php echo $_GET['email']; ?>">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <?php endif; ?>
            <input type="password" name="password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>

</html>
