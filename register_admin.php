<?php
require_once 'includes/database.php';
require_once 'includes/Auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);

// Menambahkan akun admin
$name = 'Dimas';
$email = '';
$password = '123123'; // Pastikan ini adalah password yang sederhana untuk contoh
$role = 'admin';

if ($auth->register($name, $email, $password, $role)) {
    echo "Admin account created successfully.";
} else {
    echo "Error creating admin account.";
}
?>
