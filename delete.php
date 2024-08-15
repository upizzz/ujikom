<?php
require_once 'includes/database.php';
require_once 'includes/User.php';

$id = $_GET['id'];

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

if ($user->delete($id)) {
    header("Location: index.php");
} else {
    echo "Error: " . $db->error;
}
?>
