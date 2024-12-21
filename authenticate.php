<?php
session_start();

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Sanitize inputs using mysqli_real_escape_string
    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // Success: Set session variables for logged-in user
            $_SESSION['logged_in'] = true;
            $_SESSION['matric'] = $userDetails['matric'];
            $_SESSION['role'] = $userDetails['role'];

            // Redirect to the read.php page
            header('Location: read.php');
            exit();
        } else {
            // Failure: Display alert and redirect to login page
            echo "<script>
                    alert('Login Failed: Invalid Matric or Password.');
                    window.location.href = 'login.php'; // Redirect back to login page
                  </script>";
            exit();
        }
    } else {
        // Validation error: Display alert and redirect to login page
        echo "<script>
                alert('Please fill in all required fields.');
                window.location.href = 'login.php'; // Redirect back to login page
              </script>";
        exit();
    }
}
?>