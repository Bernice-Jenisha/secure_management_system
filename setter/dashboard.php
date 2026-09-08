<?php
include("../includes/auth.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

$totalUploads = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM question_sections WHERE setter_id='$user_id'"));

$approvedUploads = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM question_sections
 WHERE setter_id='$user_id'
 AND status='Approved'"));

$pendingUploads = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM question_sections
 WHERE setter_id='$user_id'
 AND status='Pending'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Question Setter Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->

    <div class="welcome-banner">

        <div>
            <h2>Welcome, <?php echo $_SESSION['name']; ?> 👋</h2>
            <p>Question Setter Workspace</p>
        </div>

        <div class="role-badge">
            SETTER
        </div>

    </div>

    <!-- Statistics -->

    <div class="cards">

        <div class="card">
            <h3>Total Uploads</h3>
            <p><?php echo $totalUploads; ?></p>
        </div>

        <div class="card">
            <h3>Approved</h3>
            <p><?php echo $approvedUploads; ?></p>
        </div>

        <div class="card">
            <h3>Pending</h3>
            <p><?php echo $pendingUploads; ?></p>
        </div>

    </div>

    <!-- Quick Actions -->

    <h2 style="margin-top:35px;">Quick Actions</h2>

    <div class="quick-actions">

        <div class="action-card">
            <h3>Upload Question Section</h3>
            <p>Upload encrypted Part A, Part B or Part C.</p>

            <a href="upload_section.php">
                <button class="action-btn">Upload</button>
            </a>
        </div>

        <div class="action-card">
            <h3>My Upload History</h3>
            <p>View all uploaded question sections.</p>

            <a href="my_uploads.php">
                <button class="action-btn">View Uploads</button>
            </a>
        </div>

    </div>

    <!-- Recent Uploads -->

    <h2 style="margin-top:35px;">Recent Uploads</h2>

    <table>

        <tr>
            <th>Exam</th>
            <th>Slot</th>
            <th>Section</th>
            <th>Status</th>
            <th>Uploaded On</th>
        </tr>

        <?php

        $uploads = mysqli_query($conn,
        "SELECT * FROM question_sections
         WHERE setter_id='$user_id'
         ORDER BY upload_time DESC
         LIMIT 5");

        while($row=mysqli_fetch_assoc($uploads)){

        ?>

        <tr>

            <td><?php echo $row['exam_name']; ?></td>

            <td><?php echo $row['exam_slot']; ?></td>

            <td><?php echo $row['section_name']; ?></td>

            <td>

                <?php
                if($row['status']=="Approved"){
                    echo "<span class='status-success'>Approved</span>";
                }else{
                    echo "<span class='status-pending'>Pending</span>";
                }
                ?>

            </td>

            <td><?php echo date("d M Y h:i A",strtotime($row['upload_time'])); ?></td>

        </tr>

        <?php } ?>

    </table>

    <hr style="margin-top:40px;">

    <div class="footer-text">
        Secure Examination Management Portal • Coimbatore Institute of Technology • 2026
    </div>

</div>

</body>
</html>