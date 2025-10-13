<?php
include 'db.php';

  // Student Info from Database
  $sql = "SELECT name, student_id FROM students WHERE student_id = ?";
  $stmt = $conn->prepare(query: $sql);
  $stmt->bind_param("s", $student_id_session);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $student_name = $row['name'];
      $student_id = $row['student_id'];
     // $profile_pic = $row['profile_pic']; 
  } else {
      // Default
      $student_name = "Oliver Doe";   
      $student_id = "000000";
      $profile_pic = "uploads/default_profile.jpg";
  }

    // Courses Info 
    $sql_courses = "SELECT * FROM courses WHERE id = ? ORDER BY id ASC";
    $stmt = $conn->prepare($sql_courses);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $courses_result = $stmt->get_result();

    // Borrowed Books
    $sql_books = "SELECT * FROM borrowed_books WHERE id = ? ORDER BY borrowed_date DESC";
    $stmt_books = $conn->prepare($sql_books);
    $stmt_books->bind_param("s", $student_id);
    $stmt_books->execute();
    $books_result = $stmt_books->get_result();

    // Total Library Points 
    $sql_points = "SELECT SUM(points) AS total_points FROM library_points WHERE student_id = ?";
    $stmt_points = $conn->prepare($sql_points);
    $stmt_points->bind_param("s", $student_id);
    $stmt_points->execute();
    $points_result = $stmt_points->get_result();

    // Recent Points
    $sql_transactions = "SELECT * FROM library_points WHERE student_id = ? ORDER BY created_at DESC";
    $stmt_transactions = $conn->prepare($sql_transactions);
    $stmt_transactions->bind_param("s", $student_id);
    $stmt_transactions->execute();
    $transactions = $stmt_transactions->get_result();



?>