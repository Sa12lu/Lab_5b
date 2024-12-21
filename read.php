<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require 'Database.php';
require 'User.php';

try {
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $result = $user->getUsers();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFDEC;
            color: #333;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: #FFE2E2;
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
        <h2 class="text-center mb-4">User List</h2>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["matric"]); ?></td>
                            <td><?= htmlspecialchars($row["name"]); ?></td>
                            <td><?= htmlspecialchars($row["role"]); ?></td>
                            <td>
                                <a href="update_form.php?matric=<?= urlencode($row["matric"]); ?>" class="btn btn-custom btn-sm">Update</a>
                            </td>
                            <td>
                                <a href="delete.php?matric=<?= urlencode($row["matric"]); ?>" class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>