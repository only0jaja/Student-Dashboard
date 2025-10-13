<?php
// db.php - PHPmyadmin Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'student_dashboard_v2';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
