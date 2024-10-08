<?php
$host = 'localhost'; // MySQL host
$dbname = 'test1'; // Database name
$username = 'root'; // MySQL username
$password = 'root@123'; // MySQL password

try {
    // Connect to MySQL database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

