<?php
include 'Database.php';
include 'User.php';

try {
    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);

    // Ensure POST data is set before proceeding
    if (isset($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role'])) {
        // Register the user using POST data
        $result = $user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);

        if ($result) {
            // Redirect to read.php on success
            header('Location: read.php');
            exit();
        } else {
            // Handle user creation failure
            echo '<script>alert("Failed to create user.")</script>';
            header('Location: login.php');
        }
    } else {
        echo "Invalid input data.";
    }
} catch (Exception $e) {
    // Handle exceptions
    echo "Error: " . $e->getMessage();
} finally {
    // Close the database connection if it supports close()
    if (method_exists($db, 'close')) {
        $db->close();
    }
}

