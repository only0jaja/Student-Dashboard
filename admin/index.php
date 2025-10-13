<?php
// database connection
include '../db.php';
// Fetch statistics
include 'admin_query.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="wrapper">
    <aside class="sidebar">
    <h2>Admin</h2>
        <div class="menu-item active" data-tab="dashboard">Home</div>
        <div class="menu-item" data-tab="students">Students</div>
        <div class="menu-item" data-tab="applications">Applicants</div>
        <div class="menu-item" data-tab="payments">Payments</div>
    </aside>

    <div class="content">
        <!-- Dashboard -->
        <div id="dashboard" class="tab active">
            <div class="section-title">Dashboard</div>

            <!-- Stats Cards -->
            <div class="cards">
            <div class="card"><h3>Total Students</h3><p><?php echo $totalStudents; ?></p></div>
            <div class="card"><h3>Total Applicants</h3><p><?php echo $totalApplicants; ?></p></div>
            <div class="card"><h3>Total Users</h3><p><?php echo $totalUsers; ?></p></div>
            </div>

            <!-- Dashboard Flex -->
            <div class="dashboard-flex">
                <!-- Left side -->
                <div class="notifications">

                <!-- Notifications -->
                <div class="section-title">🔔 Notifications</div>
                <div class="card-container">
                    <?php while ($row = $notifications->fetch_assoc()): ?>
                    <div class="card-notification">
                        <h3>🔔 <?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['message']); ?></p>
                        <small><?php echo date("M d, Y h:i A", strtotime($row['created_at'])); ?></small>
                    </div>
                    <?php endwhile; ?>
                </div>
                </div>

                <!-- Right side -->
                <div class="card-action quick-actions">
                <h3>Quick Actions</h3>
                <button class="btn btn-yellow">Approve Applications</button>
                <button class="btn btn-cyan">Manage Payments</button>
                </div>
            </div>
        </div>

        <!-- Students -->
        <div id="students" class="tab">
            <div class="section-title">Students</div>
            <div class="card-table">
                <table border="1" cellspacing="0" cellpadding="8" width="100%">
                    <thead style="background:#0157AE; color:white;">
                        <tr>
                            <th>StudentID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Section</th>
                            <th>Year Level</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $students = $conn->query("SELECT * FROM students ORDER BY year_level ASC");
                        if ($students->num_rows > 0):
                            while ($stud = $students->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($stud['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($stud['name']); ?></td>
                            <td><?php echo htmlspecialchars($stud['course']); ?></td>
                            <td><?php echo htmlspecialchars($stud['section']); ?></td>
                            <td><?php echo htmlspecialchars($stud['year_level']); ?></td>
                            <td>
                                <?php
                                $status = $stud['status'];
                                if ($status == "Active") echo "<span style='color:blue;font-weight:600;'>Active</span>";
                                elseif ($status == "Inactive") echo "<span style='color:orange;font-weight:600;'>Inactive</span>";
                                elseif ($status == "Finished") echo "<span style='color:green;font-weight:600;'>Finished</span>";
                                else echo "<span style='color:red;font-weight:600;'>Dropped</span>";
                                ?>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">No students found.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Applications -->
        <div id="applications" class="tab">
            <div class="section-title">Applications</div>

            <div class="card-table">
                <table border="1" cellspacing="0" cellpadding="8" width="100%">
                <thead style="background:#0157AE; color:white;">
                    <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Status</th>
                    <th>Date Applied</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $applicants = $conn->query("SELECT * FROM applications_2 ORDER BY created_at DESC");
                    if ($applicants->num_rows > 0):
                        while ($app = $applicants->fetch_assoc()):
                    ?>
                    <tr>
                    <td><?php echo $app['applicant_id']; ?></td>
                    <td><?php echo htmlspecialchars($app['name']); ?></td>
                    <td><?php echo htmlspecialchars($app['email']); ?></td>
                    <td><?php echo htmlspecialchars($app['course']); ?></td>
                    <td>
                        <?php
                        $status = $app['status'];
                        if ($status == "New") echo "<span style='color:blue;font-weight:600;'>New</span>";
                        elseif ($status == "Pending") echo "<span style='color:orange;font-weight:600;'>Pending</span>";
                        elseif ($status == "Approved") echo "<span style='color:green;font-weight:600;'>Approved</span>";
                        else echo "<span style='color:red;font-weight:600;'>Rejected</span>";
                        ?>
                    </td>
                    <td><?php echo date("M d, Y h:i A", strtotime($app['created_at'])); ?></td>
                    </tr>
                    <?php endwhile; else: ?>
                    <tr>
                    <td colspan="6" style="text-align:center;">No applications found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
        </div>

        <!-- Classes -->
        <div id="classes" class="tab">
        <div class="section-title">Classes</div>
        <p>Class management will be shown here.</p>
        </div>

        <!-- Payments -->
        <div id="payments" class="tab">
        <div class="section-title">Payments</div>
        <p>Payment records will be shown here.</p>
        </div>

    </div>
  </section>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const menuItems = document.querySelectorAll('.menu-item');
    const tabs = document.querySelectorAll('.tab');

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
        menuItems.forEach(i => i.classList.remove('active'));
        tabs.forEach(tab => tab.classList.remove('active'));

        item.classList.add('active');
        const tabId = item.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
        });
    });
    });
</script>


</body>
</html>
