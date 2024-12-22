<?php
include 'Database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the POST request
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $result = $user->updateUser($matric, $name, $role);

    // Close the connection
    $db->close();

    // Redirect or show a message based on the result
    if ($result === true) {
        echo "<script>
                alert('User updated successfully.');
                window.location.href = 'read.php';
              </script>";
    } else {
        echo "<script>
                alert('Error updating user: " . addslashes($result) . "');
                window.history.back();
              </script>";
    }
}