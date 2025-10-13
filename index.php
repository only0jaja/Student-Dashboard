<?php
session_start();
include 'conn.php';

$users = $_SESSION['id'];

if (!isset($users)) {
    header("Location: login.php");
    exit();
}
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection configuration
// Process form submission

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conn.php';

    // Sanitize inputs
    $firstName = filter_var($_POST['firstName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $lastName = filter_var($_POST['lastName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $middleName = filter_var($_POST['middleName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $age = filter_var($_POST['Age'] ?? '', FILTER_SANITIZE_NUMBER_INT);
    $height = filter_var($_POST['Height'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $dob = filter_var($_POST['dob'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $nationality = filter_var($_POST['nationality'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $religion = filter_var($_POST['religion'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $civilStatus = filter_var($_POST['civilStatus'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST['phone'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_var($_POST['address'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $campus = filter_var($_POST['campus'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $department = filter_var($_POST['department'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $course = filter_var($_POST['course'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    // Emergency contact
    $emergencyName = filter_var($_POST['emergencyName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $emergencyRelation = filter_var($_POST['emergencyRelation'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $emergencyPhone = filter_var($_POST['emergencyPhone'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $emergencyEmail = filter_var($_POST['emergencyEmail'] ?? '', FILTER_SANITIZE_EMAIL);

    // Guardian info
    $guardianFirstName = filter_var($_POST['guardianFirstName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianMiddleName = filter_var($_POST['guardianMiddleName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianLastName = filter_var($_POST['guardianLastName'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianRelationship = filter_var($_POST['guardianRelationship'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianDob = filter_var($_POST['guardianDob'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianOccupation = filter_var($_POST['guardianOccupation'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianEmployer = filter_var($_POST['guardianEmployer'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianEmail = filter_var($_POST['guardianEmail'] ?? '', FILTER_SANITIZE_EMAIL);
    $guardianPhone = filter_var($_POST['guardianPhone'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);
    $guardianAddress = filter_var($_POST['guardianAddress'] ?? '', FILTER_SANITIZE_SPECIAL_CHARS);

    // Optional fields
    $status = 'New';
    $notified = 0;
    $photoPath = '';

    // ✅ Photo upload
    if (isset($_FILES['studentPhoto']) && $_FILES['studentPhoto']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['studentPhoto']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $newFilename = uniqid('student_', true) . '.' . $ext;
            $uploadDir = __DIR__ . '/Uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $uploadPath = $uploadDir . $newFilename;
            if (move_uploaded_file($_FILES['studentPhoto']['tmp_name'], $uploadPath)) {
                $photoPath = 'Uploads/' . $newFilename;
            } else {
                $submissionError = "Failed to upload photo.";
            }
        } else {
            $submissionError = "Invalid file format. Only JPG, JPEG, or PNG are allowed.";
        }
    }

    // ✅ Required field validation
    $required = [$firstName, $lastName, $gender, $age, $height, $dob, $nationality, $religion, $email, $phone, $address];
    if (in_array('', $required, true)) {
        $submissionError = "Please fill out all required fields.";
    }

    // ✅ If no error → Insert into database
    if (!isset($submissionError)) {
        $sql = "INSERT INTO student_applications (
            first_name, last_name, middle_name, gender, age, height, date_of_birth,
            nationality, religion, civil_status, email, phone, address,
            campus, department, course,
            emergency_name, emergency_relation, emergency_phone, emergency_email,
            guardian_first_name, guardian_middle_name, guardian_last_name,
            guardian_relationship, guardian_dob, guardian_occupation, guardian_employer,
            guardian_email, guardian_phone, guardian_address,
            photo, status, notified
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param(
                "ssssisssssssssssssssssssssssssi",
                $firstName, $lastName, $middleName, $gender, $age, $height, $dob,
                $nationality, $religion, $civilStatus, $email, $phone, $address,
                $campus, $department, $course,
                $emergencyName, $emergencyRelation, $emergencyPhone, $emergencyEmail,
                $guardianFirstName, $guardianMiddleName, $guardianLastName,
                $guardianRelationship, $guardianDob, $guardianOccupation, $guardianEmployer,
                $guardianEmail, $guardianPhone, $guardianAddress,
                $photoPath, $status, $notified
            );

            if ($stmt->execute()) {
                $submissionSuccess = true;
            } else {
                $submissionError = "Database error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $submissionError = "Query preparation failed: " . $conn->error;
        }
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Application Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Popup Styles */
        .popup-overlay {
            display: <?php echo isset($submissionSuccess) || isset($submissionError) ? 'flex' : 'none'; ?>;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .popup-content h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .popup-content p {
            color: #555;
            margin-bottom: 1.5rem;
        }

        .popup-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .popup-btn {
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .popup-btn-primary {
            background-color: #2c3e50;
            color: white;
        }

        .popup-btn-primary:hover {
            background-color: #34495e;
        }

        .popup-btn-secondary {
            background-color: #95a5a6;
            color: white;
        }

        .popup-btn-secondary:hover {
            background-color: #7f8c8d;
        }

        .error-popup {
            background: #ffebee;
        }

        .error-popup h2 {
            color: #c62828;
        }
    </style>
</head>
<body>

   <?php 
      include 'conn.php';
       $sql = "select * from users where id = '$users'";
        $result = mysqli_query($conn, $sql);
   ?>
    <header>
        <form action=""method="POST">
        <nav class="navigation">
             <?php while($row = mysqli_fetch_array($result)){?>
            <div class="nav-id">
                <h3>Applicant ID: <?php echo $row['id']; ?></h3>
            </div>
             <?php } ?>
             </form>
            <div class="nav-btn">
                <button class="btn-logout">
                    <a href="login.php">Logout</a>
                </button>
            </div>
        </nav>
    </header>
    
    <div class="container">
        <div class="header">
            <h1>Student Application Form</h1>
            <p>Please fill out all required fields to complete your application</p>
        </div>

        <form id="studentApplicationForm" class="form-container" method="POST" enctype="multipart/form-data">
            <div class="form-section">
                <h2 class="section-title">
                    <i class="fas fa-user-graduate"></i> Personal Information
                </h2>
                
                <div class="photo-upload">
                    <div class="photo-preview" id="photoPreview">
                        <i class="fas fa-user" style="font-size: 3rem; color: #64748b;"></i>
                    </div>
                    <div class="photo-upload-controls">
                        <label for="studentPhoto" class="photo-upload-btn">
                            <i class="fas fa-upload"></i> Upload Photo
                        </label>
                        <input type="file" id="studentPhoto" name="studentPhoto" accept="image/*">
                        <p class="photo-upload-note">JPEG or PNG, max 2MB. White background preferred.</p>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName" class="form-label required">First Name</label>
                        <input type="text" id="firstName" name="firstName" class="form-control" required>
                        <div class="error-message" id="firstNameError">Please enter your first name</div>
                    </div>
                    <div class="form-group">
                        <label for="lastName" class="form-label required">Last Name</label>
                        <input type="text" id="lastName" name="lastName" class="form-control" required>
                        <div class="error-message" id="lastNameError">Please enter your last name</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="middleName" class="form-label">Middle Name</label>
                        <input type="text" id="middleName" name="middleName" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender" class="form-label required">Gender</label>
                        <select id="gender" name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <div class="error-message" id="genderError">Please select your gender</div>
                    </div>
                </div>
                    
                <div class="form-row">
                    <div class="form-group">
                        <label for="Age" class="form-label required">Age</label>
                        <input type="number" id="Age" name="Age" class="form-control" required>
                        <div class="error-message" id="ageError">Please enter your age</div>
                    </div>
                    <div class="form-group">
                        <label for="Height" class="form-label required">Height(cm)</label>
                        <input type="text" id="Height" name="Height" class="form-control" required>
                        <div class="error-message" id="heightError">Please enter your height</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="dob" class="form-label required">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control" required>
                        <div class="error-message" id="dobError">Please enter your date of birth</div>
                    </div>
                    <div class="form-group">
                        <label for="nationality" class="form-label required">Nationality</label>
                        <input type="text" id="nationality" name="nationality" class="form-control" required>
                        <div class="error-message" id="nationalityError">Please enter your nationality</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="idNumber" class="form-label required">Religion</label>
                        <input type="text" id="idNumber" name="idNumber" class="form-control" required>
                        <div class="error-message" id="idNumberError">Please enter your religion</div>
                    </div>
                    <div class="form-group">
                        <label for="bloodType" class="form-label">Civil Status</label>
                        <select id="bloodType" name="bloodType" class="form-control">
                            <option value="">Select Status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="form-section">
                <h2 class="section-title">
                    <i class="fas fa-address-book"></i> Contact Information
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email" class="form-label required">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                        <div class="error-message" id="emailError">Please enter a valid email address</div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label required">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                        <div class="error-message" id="phoneError">Please enter your phone number</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address" class="form-label required">Permanent Address</label>
                    <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                    <div class="error-message" id="addressError">Please enter your address</div>
                </div>

                <h3 style="margin: 1.5rem 0 1rem; color: var(--primary);">Emergency Contact</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="emergencyName" class="form-label required">Full Name</label>
                        <input type="text" id="emergencyName" name="emergencyName" class="form-control" required>
                        <div class="error-message" id="emergencyNameError">Please enter emergency contact name</div>
                    </div>
                    <div class="form-group">
                        <label for="emergencyRelation" class="form-label required">Relationship</label>
                        <input type="text" id="emergencyRelation" name="emergencyRelation" class="form-control" required>
                        <div class="error-message" id="emergencyRelationError">Please specify relationship</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="emergencyPhone" class="form-label required">Phone Number</label>
                        <input type="tel" id="emergencyPhone" name="emergencyPhone" class="form-control" required>
                        <div class="error-message" id="emergencyPhoneError">Please enter emergency phone number</div>
                    </div>
                    <div class="form-group">
                        <label for="emergencyEmail" class="form-label">Email</label>
                        <input type="email" id="emergencyEmail" name="emergencyEmail" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Academic Information Section -->
            <div class="form-section">
                <h2 class="section-title">
                    <i class="fas fa-graduation-cap"></i> Academic Information
                </h2>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="campus" class="form-label required">Preferred Campus</label>
                        <select id="campus" name="campus" class="form-control" required>
                            <option value="">Select Campus</option>
                            <option value="Main Campus">Main Campus</option>
                            <option value="North Campus">North Campus</option>
                            <option value="South Campus">South Campus</option>
                        </select>
                        <div class="error-message" id="campusError">Please select your preferred campus</div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="form-label required">Department</label>
                        <select id="department" name="department" class="form-control" required>
                            <option value="">Select Department</option>
                            <option value="College">College</option>
                            <option value="Senior High">Senior High</option>
                            <option value="Junior High">Junior High</option>
                            <option value="Elementary">Elementary</option>
                            <option value="Kindergarten">Kindergarten</option>   
                        </select>
                        <div class="error-message" id="departmentError">Please select your department</div>
                    </div>
                </div>

                <div class="form-section">
                    <h2 class="section-title">
                        <i class="fas fa-user-shield"></i> Guardian Information
                    </h2>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guardianFirstName" class="form-label required">First Name</label>
                            <input type="text" id="guardianFirstName" name="guardianFirstName" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianMiddleName" class="form-label">Middle Name</label>
                            <input type="text" id="guardianMiddleName" name="guardianMiddleName" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianLastName" class="form-label required">Last Name</label>
                            <input type="text" id="guardianLastName" name="guardianLastName" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guardianRelationship" class="form-label required">Relationship to Child</label>
                            <select id="guardianRelationship" name="guardianRelationship" class="form-control" required>
                                <option value="">Select Relationship</option>
                                <option value="grandparent">Grandparent</option>
                                <option value="aunt/uncle">Aunt/Uncle</option>
                                <option value="sibling">Sibling</option>
                                <option value="family_friend">Family Friend</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianDob" class="form-label required">Date of Birth</label>
                            <input type="date" id="guardianDob" name="guardianDob" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guardianOccupation" class="form-label">Occupation</label>
                            <input type="text" id="guardianOccupation" name="guardianOccupation" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianEmployer" class="form-label">Employer/Business Name</label>
                            <input type="text" id="guardianEmployer" name="guardianEmployer" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guardianEmail" class="form-label">Email Address</label>
                            <input type="email" id="guardianEmail" name="guardianEmail" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="guardianPhone" class="form-label required">Phone Number</label>
                            <input type="tel" id="guardianPhone" name="guardianPhone" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guardianAddress" class="form-label required">Complete Address</label>
                            <textarea id="guardianAddress" name="guardianAddress" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="btn-container">
                    <button type="submit" class="btn"><i class="fas fa-paper-plane"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Popup Container -->
    <div class="popup-overlay" id="submissionPopup">
        <div class="popup-content <?php echo isset($submissionError) ? 'error-popup' : ''; ?>">
            <h2><?php echo isset($submissionError) ? 'Submission Failed' : 'Submission Successful!'; ?></h2>
            <p><?php echo isset($submissionError) ? htmlspecialchars($submissionError) : 'Your application has been submitted successfully. You will receive a confirmation email soon.'; ?></p>
            <div class="popup-buttons">
                <button class="popup-btn popup-btn-primary" onclick="closePopup()">Close</button>
                <button class="popup-btn popup-btn-secondary" onclick="window.location.href='student/index.php'">Go to Dashboard</button>
            </div>
        </div>
    </div>

    <script>
        // Form submission handler
        document.getElementById('studentApplicationForm').addEventListener('submit', function(event) {
            // Basic client-side validation
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    const errorElement = document.getElementById(`${field.id}Error`);
                    if (errorElement) {
                        errorElement.style.display = 'block';
                    }
                } else {
                    const errorElement = document.getElementById(`${field.id}Error`);
                    if (errorElement) {
                        errorElement.style.display = 'none';
                    }
                }
            });

            // Additional validation for specific fields
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value && !emailRegex.test(email.value)) {
                isValid = false;
                document.getElementById('emailError').style.display = 'block';
            }

            const phone = document.getElementById('phone');
            const phoneRegex = /^\+?[\d\s-]{10,}$/;
            if (phone.value && !phoneRegex.test(phone.value)) {
                isValid = false;
                document.getElementById('phoneError').style.display = 'block';
            }

            const emergencyPhone = document.getElementById('emergencyPhone');
            if (emergencyPhone.value && !phoneRegex.test(emergencyPhone.value)) {
                isValid = false;
                document.getElementById('emergencyPhoneError').style.display = 'block';
            }

            const guardianPhone = document.getElementById('guardianPhone');
            if (guardianPhone.value && !phoneRegex.test(guardianPhone.value)) {
                isValid = false;
                document.getElementById('guardianPhoneError').style.display = 'block';
            }

            const age = document.getElementById('Age');
            if (age.value && (age.value < 1 || age.value > 120)) {
                isValid = false;
                document.getElementById('ageError').style.display = 'block';
                document.getElementById('ageError').textContent = 'Please enter a valid age (1-120)';
            }

            const height = document.getElementById('Height');
            if (height.value && !/^\d+(\.\d+)?$/.test(height.value)) {
                isValid = false;
                document.getElementById('heightError').style.display = 'block';
                document.getElementById('heightError').textContent = 'Please enter a valid height (e.g., 170 or 170.5)';
            }

            // Photo validation
            const photo = document.getElementById('studentPhoto');
            if (photo.files.length > 0) {
                const file = photo.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (file.size > maxSize) {
                    isValid = false;
                    alert('Photo size must be less than 2MB');
                }
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

        // Close popup
        function closePopup() {
            document.getElementById('submissionPopup').style.display = 'none';
        }

        // Redirect to dashboard (modify URL as needed)
        function redirectToDashboard() {
            window.location.href = 'dashboard.php'; // Replace with actual dashboard URL
        }

        // Close popup when clicking outside
        document.getElementById('submissionPopup').addEventListener('click', function(event) {
            if (event.target === this) {
                closePopup();
            }
        });

        // Photo preview
        document.getElementById('studentPhoto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Student Photo" style="max-width: 100%; max-height: 100%; border-radius: 8px;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>