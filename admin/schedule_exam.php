<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/log_helper.php");

$message = "";
$messageType = "";

if(isset($_POST['schedule'])){

    $paper_id = $_POST['paper_id'];

    // Convert HTML datetime-local to MySQL DATETIME
    $release_time = str_replace("T"," ",$_POST['release_time']);
    $release_time .= ":00";

    // Expiry time = Release + 5 Hours
    $expiry_time = date(
        "Y-m-d H:i:s",
        strtotime($release_time . " +5 hours")
    );

    $query = "UPDATE final_papers
              SET release_time='$release_time',
                  expiry_time='$expiry_time',
                  status='Locked'
              WHERE paper_id='$paper_id'";

    if(mysqli_query($conn,$query)){

        addLog(
            $conn,
            $_SESSION['user_id'],
            "Scheduled Exam Paper ID ".$paper_id,
            "Success"
        );

        $message = "Exam scheduled successfully! Paper will be available for exactly 5 hours.";
        $messageType = "success";

    }else{

        $message = "Database Error: ".mysqli_error($conn);
        $messageType = "error";

    }
}

// Dropdown papers
$papers = mysqli_query($conn,
"SELECT * FROM final_papers ORDER BY paper_id DESC");

// Table of scheduled papers
$scheduledPapers = mysqli_query($conn,
"SELECT * FROM final_papers ORDER BY paper_id DESC");
?>

<!DOCTYPE html>
<html>
<head>

    <title>Schedule Exam</title>

    <link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->

    <div class="welcome-banner">

        <div>
            <h2>Schedule Examination Release</h2>
            <p>Configure secure release and automatic expiry for question papers.</p>
        </div>

        <div class="role-badge">
            ADMIN
        </div>

    </div>

    <!-- Alert -->

    <?php if($message!=""){ ?>

        <div class="<?php echo ($messageType=="success") ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $message; ?>
        </div>

    <?php } ?>

    <!-- Scheduling Form -->

    <div class="card">

        <h2>Schedule Final Question Paper</h2>

        <form method="POST">

            <label><strong>Select Final Paper</strong></label>

            <select name="paper_id" required>

                <option value="">Choose Final Paper</option>

                <?php while($paper=mysqli_fetch_assoc($papers)){ ?>

                    <option value="<?php echo $paper['paper_id']; ?>">

                        <?php echo $paper['exam_name']; ?> -
                        <?php echo $paper['exam_slot']; ?>

                    </option>

                <?php } ?>

            </select>

            <br><br>

            <label><strong>Release Date & Time</strong></label>

            <input
                type="datetime-local"
                name="release_time"
                required
            >

            <br><br>

            <button type="submit"
                    name="schedule"
                    class="generate-btn">

                Schedule Examination

            </button>

        </form>

    </div>

    <br>

    <!-- Security Information -->

    <div class="download-card">

        <h3>Release Policy</h3>

        <p>✔ Question paper remains encrypted until release time.</p>

        <p>✔ Download access opens automatically at the scheduled time.</p>

        <p>✔ Paper expires automatically after <strong>5 hours</strong>.</p>

        <p>✔ OTP authentication is required before download.</p>

        <p>✔ Every scheduling event is stored in the audit log.</p>

    </div>

    <br>

    <!-- Scheduled Exams Table -->

    <h2>Scheduled Examination Papers</h2>

    <table>

        <tr>

            <th>Exam</th>
            <th>Slot</th>
            <th>Release Time</th>
            <th>Expiry Time</th>
            <th>Status</th>

        </tr>

        <?php while($row=mysqli_fetch_assoc($scheduledPapers)){ ?>

        <tr>

            <td><?php echo $row['exam_name']; ?></td>

            <td><?php echo $row['exam_slot']; ?></td>

            <td>

                <?php
                if($row['release_time']){
                    echo date("d M Y h:i A",
                    strtotime($row['release_time']));
                }else{
                    echo "-";
                }
                ?>

            </td>

            <td>

                <?php
                if($row['expiry_time']){
                    echo date("d M Y h:i A",
                    strtotime($row['expiry_time']));
                }else{
                    echo "-";
                }
                ?>

            </td>

            <td>

                <?php

                if($row['status']=="Locked"){
                    echo "<span class='badge-locked'>Locked</span>";
                }
                elseif($row['status']=="Released"){
                    echo "<span class='badge-released'>Released</span>";
                }
                elseif($row['status']=="Expired"){
                    echo "<span class='badge-expired'>Expired</span>";
                }
                else{
                    echo "<span class='badge-pending'>Not Scheduled</span>";
                }

                ?>

            </td>

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