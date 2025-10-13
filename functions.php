<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php'; 
// Add this to functions.php if missing
function generateResetToken() {
    return bin2hex(random_bytes(32));
}

// Add this to functions.php if missing
function storeResetToken($conn, $email, $token) {
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error . " | SQL: UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
    }
    $stmt->bind_param("sss", $token, $expires, $email);
    $success = $stmt->execute();
    if (!$success) {
        die("Execute failed: " . $stmt->error);
    }
    $stmt->close();
    return $success;
}


function sendResetEmail($email, $token) {
    $resetLink = "http://localhost/student-application/reset_password.php?token=" . urlencode($token) . "&email=" . urlencode($email);

    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'abellareyvergel@gmail.com'; // Your Gmail address
        $mail->Password   = 'zxfc gbhl snur mbzd';   // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('abellareyvergel@gmail.com', 'Student Application');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Click the following link to reset your password:<br><a href='$resetLink'>$resetLink</a>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
// Generate a 6-digit OTP
function generateOTP() {
    return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
}

// Store OTP and expiry in the database for the user
function storeOTP($conn, $email, $otp) {
    $expires = date("Y-m-d H:i:s", strtotime("+10 minutes"));
    $stmt = $conn->prepare("UPDATE users SET otp = ?, otp_expires = ? WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error . " | SQL: UPDATE users SET otp = ?, otp_expires = ? WHERE email = ?");
    }
    $stmt->bind_param("sss", $otp, $expires, $email);
    $success = $stmt->execute();
    if (!$success) {
        die("Execute failed: " . $stmt->error);
    }
    $stmt->close();
    return $success;
}


// Send OTP to user's email
function sendOTPEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'abellareyvergel@gmail.com'; // Your Gmail address
        $mail->Password   = 'zxfc gbhl snur mbzd';   // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('abellareyvergel@gmail.com', 'Student Application');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your One-Time Password (OTP) is: <b>$otp</b><br>This code will expire in 10 minutes.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

?>