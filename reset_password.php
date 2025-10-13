
<?php
include 'conn.php';
require_once 'functions.php';

$success_message = '';
$error_message = '';


$otp = $_GET['otp'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($otp) || empty($new_password) || empty($confirm_password)) {
        $error_message = "Please enter the OTP code and your new password.";
    } elseif (!preg_match('/^\d{6}$/', $otp)) {
        $error_message = "Invalid OTP format. Please enter the 6-digit code sent to your email.";
    } elseif ($new_password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Verify OTP
        $stmt = $conn->prepare("SELECT id, otp_expires FROM users WHERE otp = ?");
        $stmt->bind_param("s", $otp);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            if (strtotime($row['otp_expires']) < time()) {
                $error_message = "OTP has expired.";
            } else {
                // Update password and clear OTP
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update = $conn->prepare("UPDATE users SET password = ?, otp = NULL, otp_expires = NULL WHERE id = ?");
                $update->bind_param("si", $hashed_password, $row['id']);
                if ($update->execute()) {
                    $success_message = "Your password has been reset successfully.";
                } else {
                    $error_message = "Failed to reset password. Please try again.";
                }
                $update->close();
            }
        } else {
            $error_message = "Invalid or expired OTP code.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your styles here or reuse from forgotpassword.php */
        .container { max-width: 400px; margin: 50px auto; padding: 20px; background: #f9f9f9; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);}
        .form-group { margin-bottom: 15px;}
        .form-label { display: block; margin-bottom: 5px; font-weight: 500;}
        .form-control { width: 100%; padding: 10px; border: 1px solid #0960EA; border-radius: 4px; font-size: 1rem;}
        .btn { background-color: #2c3e50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; width: 100%;}
        .btn:hover { background-color: #34495e;}
        .error-message, .success-message { margin: 10px 0; padding: 10px; border-radius: 4px;}
        .error-message { background: #ffebee; color: #c62828;}
        .success-message { background: #e8f5e9; color: #2e7d32;}
    </style>
</head>
<body>
    <div class="container">
        <h1>Reset Password</h1>
        <?php if ($success_message): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php elseif ($error_message): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if (!$success_message): ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="otp" class="form-label">OTP Code</label>
                <input type="text" id="otp" name="otp" class="form-control" maxlength="6" pattern="\d{6}" required value="<?php echo htmlspecialchars($otp); ?>">
            </div>
            <div class="form-group">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>