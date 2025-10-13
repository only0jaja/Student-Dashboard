<?php

// database connection
include 'db.php';

// User session
/*session_start();
if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit;
}
$student_id = $_SESSION['student_id'];
*/

// Fetch user data
include 'db_query.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- ======================= Google Fonts  ======================= -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <!-- ======================= Font Awesome Icons ======================= -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- ======================= Global CSS ======================= -->
  <link rel="stylesheet" href="dashboard_2.css">
  <!-- ======================= Scroll Animation ======================= -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> 

  <title>Student Dashboard</title>
</head>

<body>

  <!-- ======================= Header Section ======================= -->
<?php
      echo '
        <header class="main_header"> 
          <div class="header">
            <div class="l-section">
              <a href="index.php" class="profile-initial-circle">
                <img src="' . htmlspecialchars($profile_pic) . '" alt="Profile Picture" style="width:40px; height:40px; border-radius:50%;">

                <!-- For Session
                <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" style="width:40px; height:40px; border-radius:50%;">
                -->
              </a>
              <div class="student-name">
                <a class="student_name">' . htmlspecialchars($student_name) . '</a>
                <a class="student_id">' . htmlspecialchars($student_id) . '</a>


                <!-- For Session
                <a class="student_name"><?php echo htmlspecialchars($student_name); ?></a>
                <a class="student_id"><?php echo htmlspecialchars($student_id); ?></a>
                -->
                
              </div>
            </div>
            <div class="r-section">
              <nav class="navbar">
                <div class="account-dropdown">
                  <div class="language"><i class="fa-solid fa-globe"></i></div>

                  <div class="language-dropdown-content">
                    <a href="">Spanish</a>
                    <a href="">English</a>
                    <a href="">Filipino</a>
                  </div>
                </div>
                <div class="account-dropdown">
                  <div class="settings"><i class="fa-solid fa-gear"></i></div>

                  <div class="account-dropdown-content">
                    <a href="accountpage.php">My Profile</a>
                    <a href="#">Settings</a>
                    <a href="logout.php">Logout</a>
                  </div>
                </div>
                <button class="menu-btn" onclick="toggleSidebar()">☰</button>
              </nav>
            </div>
          </div>
        </header>';
?>

  

  <!-- === Dashboard Section === -->
  <section class="dashboard">
    <!-- === Sidebar / Navigation === -->
    <aside class="sidebar">
        <!-- Categories -->
        <section class="filter-section">
          <nav class="side-menu">
            <a href="index.html"><i class="fa-solid fa-gauge"></i> Dashboard</a>
            <a href="library.html"><i class="fa-solid fa-book"></i> Library</a>
            <a href="payment.html"><i class="fa-solid fa-credit-card"></i> Payment</a>
            <a href="application.html"><i class="fa-solid fa-file-lines"></i> Application</a>
            <a href="rewards.html"><i class="fa-solid fa-gift"></i> Rewards</a>
            <a href="qr.html"><i class="fa-solid fa-qrcode"></i> QR</a>
          </nav>
        </section>
    </aside>


    <!-- === Main Content === -->
    <div class="main">

      <!-- === Schedule Table === -->
      <div class="main-content" data-aos="zoom-in" data-aos-delay="150">
        <div class="top-section">
          <div class="schedule-card" data-aos="zoom-in" data-aos-delay="100">
            <div class="schedule-header">
              <span>Schedule</span>
              <span class="view-all">View all ➔</span>
            </div>

            <div class="schedule-table-container">
              <table class="schedule-table">
                <thead>
                  <tr>
                    <th>Course</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Room</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
                    $sql = "SELECT * FROM courses ORDER BY id ASC";
                    $courses_result = $conn->query($sql);

                    if ($courses_result->num_rows > 0) {
                        while($row = $courses_result->fetch_assoc()){
                          // Handle empty fields with TBD
                          $day = !empty($row['day']) ? htmlspecialchars($row['day']) : 'TBD';
                          $course_time = !empty($row['course_time']) ? date("h:i A", strtotime($row['course_time'])) : 'TBD';
                          $room = !empty($row['room']) ? htmlspecialchars($row['room']) : 'TBD';
                          
                          echo "<tr>";
                          echo "<td>".htmlspecialchars($row['course_name'])."</td>";
                          echo "<td>$day</td>";
                          echo "<td>$course_time</td>";
                          echo "<td>$room</td>";
                          echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No courses found</td></tr>";
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
                    

        <!-- === Library Widgets === -->
        <div class="library-widgets">

          <!-- Borrowed Books -->
          <div class="widget borrowed" data-aos="zoom-in" data-aos-delay="150">
            <div class="header-box">BORROWED BOOKS</div>
            <div class="content borrowed-column scrollable">
              <?php
              $sql_books = "SELECT * FROM borrowed_books ORDER BY borrowed_date DESC";
              $books_result = $conn->query($sql_books);

              if($books_result->num_rows > 0){
                  while($book = $books_result->fetch_assoc()){
                      $status_class = ($book['status'] == 'Submitted') ? 'submitted' : 'not-submitted';

                      echo "<div class='book-card'>";
                      echo "<div class='book-info'>";
                      echo "<div class='book-title'>".htmlspecialchars($book['book_title'])."</div>";
                      echo "<div class='book-status $status_class'>".$book['status']."</div>";
                      echo "</div>";
                      echo "<div class='book-dates'>";
                      echo "<span>Borrowed: ".date("M d, Y", strtotime($book['borrowed_date']))."</span>";
                      echo "<span>Return: ".date("M d, Y", strtotime($book['return_date']))."</span>";
                      echo "</div>";
                      echo "</div>";
                  }
              } else {
                  echo "<p>No borrowed books.</p>";
              }
              ?>
            </div>
          </div>

          <!--=== Library Points ===-->
          <?php
            // Get total points
            $sql_points = "SELECT SUM(points) AS total_points FROM library_points";
            $points_result = $conn->query($sql_points);

            $total_points = 0;
            if($points_result->num_rows > 0){
                $row = $points_result->fetch_assoc();
                $total_points = $row['total_points'] ? $row['total_points'] : 0;
            }

            // Get new points
            $sql_transactions = "SELECT * FROM library_points ORDER BY created_at DESC LIMIT 10";
            $transactions = $conn->query($sql_transactions);
          ?>
          <div class="widget points" data-aos="zoom-in" data-aos-delay="100">
            <div class="header-box">LIBRARY POINTS</div>
            <div class="content">
              <!--  Display Points-->
              <div class="points-circle">
                <div class="points-number"><?php echo $total_points; ?></div>
                <div class="points-label">PTS</div>
              </div>
              <!--  Points History-->
              <div class="points-info">
                <?php if ($transactions->num_rows > 0): ?>
                  <?php while($row = $transactions->fetch_assoc()): ?>
                    <div class="points-card">
                      <div class="points-num">
                        <div class="points-add">
                          <?php echo ($row['points'] > 0 ? '+' : '') . $row['points']; ?>
                        </div>
                      </div>
                      <div class="points-dates">
                        <span><?php echo date("M d, Y", strtotime($row['created_at'])); ?></span>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php else: ?>
                  <p>No points history yet.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>

        </div> <!-- end library-widgets -->

      </div> <!-- end schedule -->

    </div> <!-- end main -->

  </section> <!-- end dashboard -->

  <!--=== JAVA SCRIPT ===-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
    });

    document.querySelectorAll('.widget').forEach(el => {
      el.classList.add('aos-animate');
    });

    // Sidebar toggle
    function toggleSidebar() {
      document.querySelector(".sidebar").classList.toggle("show");
    }

    // Close dropdowns
    function closeAllDropdowns() {
      document.querySelectorAll(".account-dropdown-content, .language-dropdown-content").forEach(el => {
        el.classList.remove("show");
      });
    }

    document.addEventListener("DOMContentLoaded", () => {
      const dropdowns = document.querySelectorAll(".account-dropdown");

      dropdowns.forEach(dropdown => {
        const content = dropdown.querySelector(".account-dropdown-content, .language-dropdown-content");

        dropdown.addEventListener("click", (e) => {
          e.stopPropagation(); 
          closeAllDropdowns(); 
          content.classList.toggle("show");
        });
      });

      // Close all 
      document.addEventListener("click", () => {
        closeAllDropdowns();
      });
    });


  </script>

</body>
</html>
