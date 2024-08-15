<?php
session_start();
require_once 'includes/database.php';
require_once 'includes/User.php';
require_once 'includes/Auth.php';


$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$auth = new Auth($db);


if (!$auth->isAuthenticated()) {
    header("Location: login.php");
    exit();
}

if ($auth->isAdmin()) {
    $users = $user->read();
} else {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $users = $stmt->get_result();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>User List</h2>
        <?php 
         echo 'Welcome, ' ;
        ?> <br>
        
        <?php if ($auth->isAdmin()): ?>
            <a href="create.php" class="btn btn-primary mb-2">Add User</a>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-danger mb-2">Logout</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                <?php if ($auth->isAdmin()): ?>
                        <td>ID</td>
                    <?php endif; ?>
                    <th>Name</th>
                    <th>Email</th>
                    <?php if ($auth->isAdmin()): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                <?php if ($auth->isAdmin()): ?>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <?php endif; ?>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <?php if ($auth->isAdmin()): ?>
                        <td>
                            <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
