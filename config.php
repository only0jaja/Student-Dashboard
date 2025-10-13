<?php
// config.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'studentapplicationdb');

// Email configuration
define('EMAIL_FROM', 'no-reply@yourdomain.com');
define('EMAIL_SUBJECT', 'Password Reset Request');
define('SITE_URL', 'http://localhost/student-application'); // Updated for subdirectory

// Connect to database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>