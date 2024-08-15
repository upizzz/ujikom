<?php
session_start();
require_once 'includes/Auth.php';

// Buat objek Auth dan panggil metode logout
$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);
$auth->logout();
?>
