<?php
// Notification function
function addNotification($conn, $title, $message) {
    $stmt = $conn->prepare("INSERT INTO notifications (title, message, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $title, $message);
    $stmt->execute();
    $stmt->close();
}
// New Applicants
$newApplicants = $conn->query("SELECT applicant_id, name FROM applications_2 WHERE status='New' AND notified=0");
while ($app = $newApplicants->fetch_assoc()) {
    $title = "New Application";
    $message = "New applicant: " . $app['name'] . " has applied.";
    $conn->query("INSERT INTO notifications (title, message, created_at) VALUES ('$title', '$message', NOW())");
    // mark applicant as notified
    $conn->query("UPDATE applications_2 SET notified=1 WHERE applicant_id=" . $app['applicant_id']);
}

// Dashboard stats
$totalStudents = $conn->query("SELECT COUNT(*) AS total FROM students")->fetch_assoc()['total'];
$totalApplicants  = $conn->query("SELECT COUNT(*) AS total FROM applications_2 WHERE status='New'")->fetch_assoc()['total'];
$totalUsers = $totalStudents + $totalApplicants;

// Recent notifications
$notifications = $conn->query("SELECT * FROM notifications ORDER BY created_at DESC LIMIT 5");
?>