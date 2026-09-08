<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/log_helper.php");

$user_id = $_SESSION['user_id'];
$message = "";
$messageType = "";

/* ---------- Generate OTP ---------- */

if(isset($_POST['generate'])){

    $otp = rand(100000,999999);

    mysqli_query($conn,"DELETE FROM otp_verification WHERE user_id='$user_id'");

    mysqli_query($conn,
    "INSERT INTO otp_verification(user_id,otp_code,verified)
     VALUES('$user_id','$otp','No')");

    $message = "OTP Generated Successfully. Demo OTP: ".$otp;
    $messageType = "success";
}

/* ---------- Verify OTP ---------- */

if(isset($_POST['verify'])){

    $enteredOTP = $_POST['otp'];

    $result = mysqli_query($conn,
    "SELECT * FROM otp_verification
     WHERE user_id='$user_id'
     ORDER BY otp_id DESC LIMIT 1");

    $row = mysqli_fetch_assoc($result);

    if(!$row){

        $message = "Generate an OTP first.";
        $messageType = "error";

    }
    elseif($row['verified']=="Yes"){

        $message = "This OTP has already been used. Generate a new OTP.";
        $messageType = "error";

    }
    elseif($enteredOTP == $row['otp_code']){

        mysqli_query($conn,
        "UPDATE otp_verification
         SET verified='Yes'
         WHERE otp_id=".$row['otp_id']);

        addLog($conn,$user_id,"OTP Verification","Success");

        $_SESSION['otp_verified'] = true;

        header("Location: download_paper.php");
        exit();

    }else{

        addLog($conn,$user_id,"OTP Verification","Failed");

        $message = "Invalid OTP. Please try again.";
        $messageType = "error";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OTP Verification</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <div class="welcome-banner">

        <div>
            <h2>OTP Authentication</h2>
            <p>Verify your identity before accessing the examination paper.</p>
        </div>

        <div class="role-badge">
            EXAM CENTER
        </div>

    </div>

    <?php if($message!=""){ ?>

        <div class="<?php echo ($messageType=="success") ? 'alert-success':'alert-error'; ?>">
            <?php echo $message; ?>
        </div>

    <?php } ?>

    <div class="card">

        <h2>Step 1 : Generate OTP</h2>

        <form method="POST">

            <button type="submit"
                    name="generate"
                    class="generate-btn">

                Generate OTP

            </button>

        </form>

    </div>

    <br>

    <div class="card">

        <h2>Step 2 : Verify OTP</h2>

        <form method="POST">

            <label><strong>Enter 6-Digit OTP</strong></label>

            <input type="text"
                   name="otp"
                   maxlength="6"
                   placeholder="Enter OTP"
                   required>

            <br><br>

            <button type="submit"
                    name="verify"
                    class="download-btn">

                Verify OTP

            </button>

        </form>

    </div>

    <br>

    <div class="download-card">

        <h3>Security Policy</h3>

        <p>✔ OTP is generated for authenticated Exam Centers only.</p>

        <p>✔ OTP can be used only once.</p>

        <p>✔ Successful verification enables secure paper download.</p>

        <p>✔ Failed OTP attempts are recorded in the audit log.</p>

    </div>

    <hr style="margin-top:40px;">

    <div class="footer-text">
        Secure Examination Management Portal • Coimbatore Institute of Technology • 2026
    </div>

</div>

</body>
</html>