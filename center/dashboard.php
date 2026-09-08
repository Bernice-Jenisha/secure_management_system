<?php
include("../includes/auth.php");
include("../includes/db.php");

// Reset OTP every time dashboard opens
unset($_SESSION['otp_verified']);

$result = mysqli_query($conn,
"SELECT * FROM final_papers ORDER BY paper_id DESC LIMIT 1");

$paper = mysqli_fetch_assoc($result);

$status = "No Exam Scheduled";

if($paper){

    $current = time();
    $release = strtotime($paper['release_time']);
    $expiry = strtotime($paper['expiry_time']);

    if($current < $release){
        $status = "Paper Locked";
    }
    elseif($current >= $release && $current <= $expiry){
        $status = "Paper Available";
    }
    else{
        $status = "Paper Expired";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Center Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->

    <div class="welcome-banner">

        <div>
            <h2>Welcome, <?php echo $_SESSION['name']; ?> 👋</h2>
            <p>Secure Exam Center Portal</p>
        </div>

        <div class="role-badge">
            EXAM CENTER
        </div>

    </div>

    <!-- Exam Information -->

    <?php if($paper){ ?>

    <h2>Today's Examination</h2>

    <div class="cards">

        <div class="card">
            <h3>Exam Name</h3>
            <p style="font-size:22px;"><?php echo $paper['exam_name']; ?></p>
        </div>

        <div class="card">
            <h3>Exam Slot</h3>
            <p style="font-size:22px;"><?php echo $paper['exam_slot']; ?></p>
        </div>

        <div class="card">
            <h3>Status</h3>
            <p style="font-size:20px;"><?php echo $status; ?></p>
        </div>

    </div>

    <div class="cards">

        <div class="card">
            <h3>Release Time</h3>
            <p style="font-size:18px;">
                <?php echo date("d M Y",strtotime($paper['release_time'])); ?><br>
                <?php echo date("h:i A",strtotime($paper['release_time'])); ?>
            </p>
        </div>

        <div class="card">
            <h3>Expiry Time</h3>
            <p style="font-size:18px;">
                <?php echo date("d M Y",strtotime($paper['expiry_time'])); ?><br>
                <?php echo date("h:i A",strtotime($paper['expiry_time'])); ?>
            </p>
        </div>

    </div>

    <?php } ?>

    <!-- Quick Actions -->

    <h2 style="margin-top:35px;">Quick Actions</h2>

    <div class="quick-actions">

        <div class="action-card">
            <h3>OTP Authentication</h3>

            <p>
                Verify your identity before accessing the question paper.
            </p>

            <a href="otp_verify.php">
                <button class="action-btn">Verify OTP</button>
            </a>
        </div>

        <div class="action-card">
            <h3>Download Question Paper</h3>

            <p>
                Download only after successful OTP verification.
            </p>

            <a href="download_paper.php">
                <button class="action-btn">Open Portal</button>
            </a>
        </div>

    </div>

    <!-- Security Features -->

    <h2 style="margin-top:35px;">Security Status</h2>

    <div class="quick-actions">

        <div class="action-card">
            <h3>OTP Protection</h3>
            <p>Multi-factor authentication enabled.</p>
        </div>

        <div class="action-card">
            <h3>Blockchain Integrity</h3>
            <p>Question paper integrity verified using blockchain hashes.</p>
        </div>

        <div class="action-card">
            <h3>AES Encryption</h3>
            <p>Question paper remains encrypted until scheduled release.</p>
        </div>

    </div>

    <hr style="margin-top:40px;">

    <div class="footer-text">
        Secure Examination Management Portal • Coimbatore Institute of Technology • 2026
    </div>

</div>

</body>
</html>