<?php
// Simple DB config for XAMPP (change as needed)
// Place this file in the project root.
$host = 'localhost';
$user = 'root';
$pass = ''; // XAMPP default has empty password for root
$db   = 'student_db';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
