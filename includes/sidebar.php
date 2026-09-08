<?php
$role = $_SESSION['role'];
?>

<div class="sidebar">

    <h2>Secure Exam Portal</h2>

    

    <?php if($role=="admin"){ ?>

        <a href="dashboard.php">Dashboard</a>
        <a href="approve_sections.php">Approve Sections</a>
        <a href="generate_paper.php">Generate Paper</a>
        <a href="schedule_exam.php">Schedule Exam</a>
        <a href="blockchain_status.php">Blockchain Ledger</a>
        <a href="audit_logs.php">Audit Logs</a>

    <?php } ?>

    <?php if($role=="setter"){ ?>

        <a href="dashboard.php">Dashboard</a>
        <a href="upload_section.php">Upload Section</a>
        <a href="my_uploads.php">My Uploads</a>

    <?php } ?>

    <?php if($role=="center"){ ?>

        <a href="dashboard.php">Dashboard</a>
        <a href="download_paper.php">Download Paper</a>

    <?php } ?>

    <hr style="margin:20px 0;">

    <a href="../logout.php">Logout</a>

</div>