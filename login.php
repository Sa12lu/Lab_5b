<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFDEC;
            color: #333;
        }
        .container {
            margin-top: 100px;
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
        <h2 class="text-center">Login</h2>
        <form action="authenticate.php" method="post">
            <div class="mb-3">
                <label for="matric" class="form-label">Matric:</label>
                <input type="text" id="matric" name="matric" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="submit" class="btn btn-custom">Login</button>
                <a href="register_form.php" class="btn btn-secondary">Register</a>
            </div>
        </form>
    </div>
</body>

</html>