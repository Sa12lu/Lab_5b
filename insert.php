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
    if (!empty($_POST['matric']) && !empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        // Register the user using POST data
        $result = $user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);

        if ($result === true) {
            // On success, redirect to login with a success alert
            echo "<script>
                alert('Registration successful! You can now log in.');
                window.location.href = 'login.php';
            </script>";
        } else {
            // On failure, show an alert with the error message
            echo "<script>
                alert('Registration failed: " . addslashes($result) . "');
                window.history.back();
            </script>";
        }
    } else {
        echo "<script>
            alert('Please fill in all required fields.');
            window.history.back();
        </script>";
    }
} catch (Exception $e) {
    // Handle exceptions and show an alert
    echo "<script>
        alert('Error: " . addslashes($e->getMessage()) . "');
        window.history.back();
    </script>";
} finally {
    // Close the database connection if it supports close()
    if (method_exists($db, 'close')) {
        $db->close();
    }
}
