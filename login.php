<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = ""; // Or your MySQL password
    $dbname = "phpcrud";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Validate login credentials
        $sql = "SELECT * FROM users WHERE username=? AND password=? AND role=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $password, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Login successful, redirect based on role
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;

            if ($role === 'student') {
                header("Location: portal.php");
                exit;
            } elseif ($role === 'teacher') {
                header("Location: teacher_dashboard.php");
                exit;
            } elseif ($role === 'admin') {
                header("Location: admin_dashboard.php");
                exit;
            }
        } else {
            // Login failed
            echo "Invalid username or password.";
        }

        $stmt->close();
    } else {
        echo "Form fields are not set.";
    }

    $conn->close();
} else {
    echo "Form not submitted.";
}
?>
