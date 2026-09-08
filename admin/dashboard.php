<?php
include("../includes/auth.php");
include("../includes/db.php");

$totalSections = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM question_sections"));
$approvedSections = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM question_sections WHERE status='Approved'"));
$totalPapers = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM final_papers"));
$totalBlocks = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM blockchain"));
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <div class="welcome-banner">

    <div>
        <h2>Welcome, <?php echo $_SESSION['name']; ?> 👋</h2>
        <p>Administrator Control Panel</p>
    </div>

    <div class="role-badge">
        ADMIN
    </div>

</div>

    <!-- Dashboard Cards -->

    <div class="cards">

        <div class="card">
            <h3>Total Sections</h3>
            <p><?php echo $totalSections; ?></p>
        </div>

        <div class="card">
            <h3>Approved Sections</h3>
            <p><?php echo $approvedSections; ?></p>
        </div>

        <div class="card">
            <h3>Final Papers</h3>
            <p><?php echo $totalPapers; ?></p>
        </div>

        <div class="card">
            <h3>Blockchain Blocks</h3>
            <p><?php echo $totalBlocks; ?></p>
        </div>

    </div>
    
    <h2 style="margin-top:35px;">Recent Uploaded Sections</h2>

    <table>

        <tr>
            <th>Exam</th>
            <th>Slot</th>
            <th>Section</th>
            <th>Status</th>
        </tr>

        <?php

        $result = mysqli_query($conn,
        "SELECT * FROM question_sections ORDER BY upload_time DESC LIMIT 5");

        while($row = mysqli_fetch_assoc($result)){

        ?>

        <tr>

            <td><?php echo $row['exam_name']; ?></td>

            <td><?php echo $row['exam_slot']; ?></td>

            <td><?php echo $row['section_name']; ?></td>

<td>
<?php
if($row['status']=="Approved"){
    echo "<span class='badge-approved'>Approved</span>";
}else{
    echo "<span class='badge-pending'>Pending</span>";
}
?>
</td>
        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>