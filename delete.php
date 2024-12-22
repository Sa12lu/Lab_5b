<?php
include 'Database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);
    $result = $user->deleteUser($matric);

    // Close the connection
    $db->close();

    // Redirect or show a message based on the result
    if ($result === true) {
        echo "<script>
                alert('User deleted successfully.');
                window.location.href = 'read.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting user: " . addslashes($result) . "');
                window.history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.history.back();
          </script>";
}