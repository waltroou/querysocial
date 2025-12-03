<?php
$host = "localhost";           // VM MySQL
$dbname = "social_platform";   // the DB you already created
$username = "appuser";
$password = "StrongPassword123!";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
