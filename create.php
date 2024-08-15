<?php
session_start();
require_once 'includes/database.php';
require_once 'includes/User.php';
require_once 'includes/Auth.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$auth = new Auth($db);

if (!$auth->isAuthenticated() || !$auth->isAdmin()) {
    header("Location: login.php");
    exit();
}                                                                                                                        

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    if ($user->create($name, $email)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $db->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Create User</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
