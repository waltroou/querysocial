<?php
$host = "cpsc336-fa25-proj.c8iy1t7vl9pp.us-east-1.rds.amazonaws.com";           // VM MySQL
$dbname = "querycrew";   // the DB you already created
$username = "querycrew";
$password = "336FA25querycrew";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
