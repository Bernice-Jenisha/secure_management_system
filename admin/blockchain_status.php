<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/log_helper.php");

$message = "";
$messageType = "";

// Verify blockchain
if(isset($_POST['verify'])){

    $blocks = mysqli_query($conn,
    "SELECT * FROM blockchain ORDER BY block_id ASC");

    $previousHash = "GENESIS";
    $tampered = false;

    while($row=mysqli_fetch_assoc($blocks)){

        if($row['previous_hash'] != $previousHash){

            $tampered = true;
            break;

        }

        $previousHash = $row['current_hash'];
    }

    if($tampered){

        addLog(
            $conn,
            $_SESSION['user_id'],
            "Blockchain Verification",
            "Tampering Detected"
        );

        $message = "Blockchain Integrity Failed! Tampering Detected.";
        $messageType = "error";

    }else{

        addLog(
            $conn,
            $_SESSION['user_id'],
            "Blockchain Verification",
            "Success"
        );

        $message = "Blockchain Integrity Verified Successfully.";
        $messageType = "success";
    }
}

// Statistics
$totalBlocks = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM blockchain"));

$ledger = mysqli_query($conn,
"SELECT * FROM blockchain ORDER BY block_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blockchain Ledger</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->

    <div class="welcome-banner">

        <div>
            <h2>Blockchain Security Ledger</h2>
            <p>Verify the integrity of uploaded encrypted question paper records.</p>
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

    <!-- Statistics -->

    <div class="cards">

        <div class="card">
            <h3>Total Blockchain Blocks</h3>
            <p><?php echo $totalBlocks; ?></p>
        </div>

        <div class="card">
            <h3>Integrity Status</h3>

            <?php if($messageType=="error"){ ?>

                <span class="badge-expired">Tampered</span>

            <?php } else { ?>

                <span class="badge-approved">Verified</span>

            <?php } ?>

        </div>

    </div>

    <!-- Verify Button -->

    <div class="card">

        <h2>Verify Blockchain Integrity</h2>

        <p>
            This verifies every block using the Previous Hash and Current Hash chain.
        </p>

        <br>

        <form method="POST">

            <button class="generate-btn" name="verify">
                Verify Blockchain Ledger
            </button>

        </form>

    </div>

    <br>

    <!-- Ledger Table -->

    <h2>Blockchain Ledger Records</h2>

    <table>

        <tr>

            <th>Block ID</th>

            <th>Section</th>

            <th>Previous Hash</th>

            <th>Current Hash</th>

            <th>Status</th>

        </tr>

        <?php while($row=mysqli_fetch_assoc($ledger)){ ?>

        <tr>

            <td><?php echo $row['block_id']; ?></td>

            <td><?php echo $row['section_name']; ?></td>

            <td style="font-size:12px;">
                <?php echo substr($row['previous_hash'],0,20)."....."; ?>
            </td>

            <td style="font-size:12px;">
                <?php echo substr($row['current_hash'],0,20)."....."; ?>
            </td>

            <td>

                <?php

                if($messageType=="error"){
                    echo "<span class='badge-expired'>Tampered</span>";
                }else{
                    echo "<span class='badge-approved'>Verified</span>";
                }

                ?>

            </td>

        </tr>

        <?php } ?>

    </table>

    <br>

    <!-- Information Card -->

    <div class="download-card">

        <h3>Blockchain Security Process</h3>

        <p>✔ Every uploaded question section creates one blockchain block.</p>

        <p>✔ Each block stores SHA-256 hash of the encrypted file.</p>

        <p>✔ Every block stores the Previous Hash.</p>

        <p>✔ Any modification breaks the blockchain chain.</p>

        <p>✔ Tampering is immediately detected during verification.</p>

    </div>

    <hr style="margin-top:40px;">

    <div class="footer-text">
        Secure Examination Management Portal • Coimbatore Institute of Technology • 2026
    </div>

</div>

</body>
</html>