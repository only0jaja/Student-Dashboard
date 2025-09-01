<?php
// db.php - PHPmyadmin Database connection
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'student_dashboard';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// AWS RDS CONNECTION
/*
$servername = "student-info-db.c6nowq6wu0qq.us-east-1.rds.amazonaws.com"; 
$username = "admin";
$password = "n3Iv8kyoWGhx8wN65pjY";
$dbname = "student_info_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
?>
