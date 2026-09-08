<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/log_helper.php");

// OTP Protection
if (!isset($_SESSION['otp_verified']) || $_SESSION['otp_verified'] !== true) {
    header("Location: otp_verify.php");
    exit();
}

// Get latest scheduled paper
$result = mysqli_query($conn,
"SELECT * FROM final_papers ORDER BY paper_id DESC LIMIT 1");

$paper = mysqli_fetch_assoc($result);

$currentTime = time();
$status = "";
$download = false;

// Determine paper status
if($paper){

    $release = strtotime($paper['release_time']);
    $expiry = strtotime($paper['expiry_time']);

    if($currentTime < $release){

        $status = "locked";

    }
    elseif($currentTime >= $release && $currentTime <= $expiry){

        $status = "released";
        $download = true;

    }
    else{

        $status = "expired";

    }

}

// Download only when button is clicked
if(isset($_POST['download']) && $download){

    addLog(
        $conn,
        $_SESSION['user_id'],
        "Downloaded Question Paper",
        "Success"
    );

    $file = "../storage/encrypted/".$paper['final_file'];

    if(file_exists($file)){

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=".basename($file));
        header("Content-Length: ".filesize($file));

        readfile($file);
        exit();

    }else{

        $message = "Question paper file not found.";

    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Download Question Paper</title>

    <link rel="stylesheet" href="../css/dashboard.css">

    <script src="../js/timer.js"></script>

</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->

    <div class="welcome-banner">

        <div>
            <h2>Question Paper Release Portal</h2>
            <p>Secure Exam Center Access</p>
        </div>

        <div class="role-badge">
            EXAM CENTER
        </div>

    </div>

    <?php if(isset($message)){ ?>

        <div class="alert-error">
            <?php echo $message; ?>
        </div>

    <?php } ?>

    <!-- Main Card -->

    <div class="card">

    <?php if($paper){ ?>

        <h2><?php echo $paper['exam_name']; ?> Examination</h2>

        <p><strong>Exam Slot:</strong> <?php echo $paper['exam_slot']; ?></p>

        <br>

        <p>

        <strong>Status :</strong>

        <?php

        if($status=="locked"){
            echo "<span class='badge-locked'>Paper Locked</span>";
        }
        elseif($status=="released"){
            echo "<span class='badge-released'>Paper Available</span>";
        }
        else{
            echo "<span class='badge-expired'>Paper Expired</span>";
        }

        ?>

        </p>

        <br>

        <!-- Release & Expiry -->

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

        <br>

        <!-- LOCKED -->

        <?php if($status=="locked"){ ?>

            <div class="timer-box">

                <h2 class="locked">🔒 Paper Locked</h2>

                <p>
                    The question paper will be available automatically when the examination begins.
                </p>

                <div id="countdown" class="timer"></div>

            </div>

            <script>
                startCountdown(
                    "<?= $paper['release_time']; ?>",
                    "countdown",
                    "Paper Released. Refreshing..."
                );
            </script>

        <?php } ?>

        <!-- RELEASED -->

        <?php if($status=="released"){ ?>

            <div class="timer-box">

                <h2 class="released">✅ Paper Available</h2>

                <p>
                    Remaining time before the paper expires.
                </p>

                <div id="expiryTimer" class="timer"></div>

            </div>

            <script>
                startCountdown(
                    "<?= $paper['expiry_time']; ?>",
                    "expiryTimer",
                    "Exam Window Closed. Refreshing..."
                );
            </script>

            <br>

            <div class="download-card">

                <h3>Secure Download Enabled</h3>

                <p>
                    OTP Authentication Completed Successfully.
                </p>

                <p>
                    Click the button below to securely download the encrypted final question paper.
                </p>

                <form method="POST">

                    <button type="submit"
                            name="download"
                            class="download-btn">

                        Download Final Question Paper

                    </button>

                </form>

            </div>

        <?php } ?>

        <!-- EXPIRED -->

        <?php if($status=="expired"){ ?>

            <div class="timer-box">

                <h2 class="expired">⛔ Paper Expired</h2>

                <p>
                    The examination download window has closed.
                </p>

            </div>

        <?php } ?>

        <br>

        <!-- Security Information -->

        <div class="download-card">

            <h3>Security Verification</h3>

            <p>✔ OTP Authentication Successful</p>

            <p>✔ AES-256 Encrypted Question Paper</p>

            <p>✔ Blockchain Integrity Verified</p>

            <p>✔ Controlled Time-Based Paper Release Enabled</p>

        </div>

    <?php } else { ?>

        <div class="alert-error">

            <h3>No Examination Scheduled</h3>

            <p>
                The administrator has not generated or scheduled a question paper yet.
            </p>

        </div>

    <?php } ?>

    </div>

    <hr style="margin-top:40px;">

    <div class="footer-text">

        Secure Examination Management Portal • Coimbatore Institute of Technology • 2026

    </div>

</div>

</body>

</html>