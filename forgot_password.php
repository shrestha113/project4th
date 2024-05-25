<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
    if (isset($_POST['email']) && isset($_POST['role'])) {
        $email = $_POST['email'];
        $role = $_POST['role'];

        // Check if the email exists
        $sql = "SELECT * FROM users WHERE Email=? AND Role=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email exists
            $row = $result->fetch_assoc();
            $token = bin2hex(random_bytes(50));
            $sql = "UPDATE users SET reset_token=? WHERE Email=? AND Role=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $token, $email,$role);
            $stmt->execute();

            // Send email to reset password
            sendResetEmail($row['Email'], $token);

            $success_message = "Password reset link has been sent to your email.";
        } else {
            // Email does not exist
            $error_message = "Invalid email or role.";
        }

        $stmt->close();
    } else {
        // Form fields are not set, set error message
        $error_message = "Form fields are not set.";
    }

    $conn->close();
}

function sendResetEmail($email, $token)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'schoolprojectmockup@gmail.com';                     //SMTP username
        $mail->Password   = 'izmf oitg bxru vsdo';                               //SMTP password
        $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('schoolprojectmockup@gmail.com');
        $mail->addAddress($email);               //Name is optional
        $mail->addReplyTo('your_email@gmail.com', 'Information');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body    = "To reset your password, click the link below:<br><br>" .
            "<a href='http://localhost/project4th/reset_password.php?email=$email&token=$token'>Reset Password</a>";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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

        input[type="text"],
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
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Forgot Password</h2>
        <?php
        // Display error message if it is set
        if (isset($error_message)) {
            echo '<p style="color: red;">' . $error_message . '</p>';
        } elseif (isset($success_message)) {
            echo '<p style="color: green;">' . $success_message . '</p>';
        }
        ?>
        <form id="forgot-password-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <input type="text" name="email" placeholder="Email" required>
            <select name="role" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>

</html>
