<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

include 'Database.php';
include 'User.php';

// Check if the 'matric' parameter is present in the URL
if (isset($_GET['matric']) && !empty($_GET['matric'])) {
    $matric = $_GET['matric'];

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();

    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    background-color: #FFFDEC;
                    color: #333;
                }
                .container {
                    margin-top: 50px;
                    background-color: #FFE2E2;
                    padding: 30px;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                .btn-custom {
                    background-color: #86A788;
                    color: white;
                }
                .btn-custom:hover {
                    background-color: #6f8e6f;
                }
            </style>
        </head>

        <body>
            <div class="container">
                <h2 class="text-center">Update User</h2>
                <form action="update.php" method="post">
                    <div class="mb-3">
                        <label for="matric" class="form-label">Matric:</label>
                        <input type="text" id="matric" name="matric" class="form-control" value="<?php echo htmlspecialchars($userDetails['matric']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Access Level:</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">Please select</option>
                            <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                            <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-custom">Update</button>
                        <a href="read.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </body>

        </html>
        <?php
    } else {
        echo "Error: User not found.";
    }
} else {
    echo "Error: Missing 'matric' parameter.";
    header("Location: read.php");
    exit();
}
?>