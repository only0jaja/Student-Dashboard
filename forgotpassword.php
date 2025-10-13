<?php
include 'conn.php';
require_once 'functions.php';

session_start();
$success_message = '';
$error_message = '';
$step = 1;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        // Step 1: User submits email
        $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
        if (empty($email)) {
            $error_message = "Please enter your email address.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format.";
        } else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $otp = generateOTP();
                if (storeOTP($conn, $email, $otp) && sendOTPEmail($email, $otp)) {
                    $success_message = "An OTP code has been sent to your email.";
                    $step = 2;
                    $_SESSION['reset_email'] = $email;
                } else {
                    $error_message = "Failed to send OTP email. Please try again.";
                }
            } else {
                $error_message = "No account found with that email address.";
            }
            $stmt->close();
        }
    } elseif (isset($_POST['otp'], $_POST['new_password'], $_POST['confirm_password'])) {
        // Step 2: User submits OTP and new password
        $email = $_SESSION['reset_email'] ?? '';
        $otp = trim($_POST['otp']);
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $step = 2;
        if (empty($otp) || empty($new_password) || empty($confirm_password)) {
            $error_message = "Please fill in all fields.";
        } elseif (!preg_match('/^\d{6}$/', $otp)) {
            $error_message = "Invalid OTP format. Please enter the 6-digit code sent to your email.";
        } elseif ($new_password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            $stmt = $conn->prepare("SELECT id, otp_expires FROM users WHERE email = ? AND otp = ?");
            $stmt->bind_param("ss", $email, $otp);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                if (strtotime($row['otp_expires']) < time()) {
                    $error_message = "OTP has expired. Please request a new one.";
                } else {
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update = $conn->prepare("UPDATE users SET password = ?, otp = NULL, otp_expires = NULL WHERE id = ?");
                    $update->bind_param("si", $hashed_password, $row['id']);
                    if ($update->execute()) {
                        $success_message = "Your password has been reset successfully.";
                        $step = 3;
                        unset($_SESSION['reset_email']);
                    } else {
                        $error_message = "Failed to reset password. Please try again.";
                    }
                    $update->close();
                }
            } else {
                $error_message = "Invalid OTP code.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --medium-blue: #64b5f6;
            --light-blue: #e3f2fd;
            --dark-blue: #0d47a1;
            --primary: #4361ee;
        }

        body {
              background: linear-gradient(120deg, #1e88e5, #1565c0);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

        }

        .container {
            width: 400px;
            margin: 50px auto;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;

        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #0960EA;
            border-radius: 4px;
            font-size: 1rem;
        }

        .form-control input:focus {
            border-color: var(--medium-blue);
        }

        .btn {
            background-color: var(--dark-blue);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            text-decoration: none;
        }
         
        .btn:hover {
            background-color: #0e4ba8ff;
        }

        .error-message,
        .success-message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .back-to-login {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .back-to-login a {
            color: var(--primary);
            text-decoration: none;
            font-size: 1.6rem;
        }

        .back-to-login h2 {
            margin: 0;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .forgot-content {

            margin-bottom: 10px;
        }

        .forgot-content h1 {
            margin: 0;
            font-size: 1.8rem;
            color: var(--dark-blue);
        }

        .forgot-content p {
            margin: 5px 0 0;
            font-size: 16px;
        }

        .checkmark {
            stroke: #2e7d32;
            stroke-width: 2;
            stroke-miterlimit: 10;
            box-shadow: 0 0 5px #2e7d32;
            background: #e8f5e9;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .checkmark__circle {
            stroke-dasharray: 166;
            stroke-dashoffset: 166;
            stroke-width: 2;
            stroke: #2e7d32;
            fill: none;
            animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        .checkmark__check {
            transform-origin: 50% 50%;
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            stroke-width: 3;
            stroke: #2e7d32;
            animation: stroke 0.4s 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
        }

        @keyframes stroke {
            100% {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if ($step !== 3): ?>
            <div class="cont-icons">
                <div class="back-to-login">
                    <a href="login.php"><i class="fas fa-arrow-left"></i></a>
                    <h2>Lyceum</h2>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($step !== 3 && $step !== 2): ?>
            <div class="forgot-content">
                <h1>Forgot Password</h1>
                <p>Enter your email address to recieve OTP code</p>
            </div>
        <?php endif; ?>

      

        <?php if ($success_message): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        <?php if ($error_message): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if ($step === 1): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Send OTP</button>
            </form>
        <?php elseif ($step === 2): ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="otp" class="form-label">OTP Code</label>
                    <input type="text" id="otp" name="otp" class="form-control" maxlength="6" pattern="\d{6}" required>
                </div>
                <div class="form-group">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn"><i class="fas fa-key"></i> Reset Password</button>
            </form>
        <?php elseif ($step === 3): ?>
            <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;margin-top:30px;">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52" width="80" height="80">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16" />
                </svg>
                <div style="text-align:center;margin-top:20px;">
                    <a href="login.php" class="btn">Back to Login</a>
                </div>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>