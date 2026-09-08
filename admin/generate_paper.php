<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/log_helper.php");

$message = "";
$messageType = "";

if(isset($_POST['generate'])){

    $exam_name = $_POST['exam_name'];
    $exam_slot = $_POST['exam_slot'];

    $query = "SELECT * FROM question_sections
              WHERE exam_name='$exam_name'
              AND exam_slot='$exam_slot'
              AND status='Approved'
              ORDER BY section_name ASC";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 3){

        $content = "******** FINAL QUESTION PAPER ********\n\n";
        $content .= "Exam : $exam_name\n";
        $content .= "Slot : $exam_slot\n\n";

        while($row = mysqli_fetch_assoc($result)){

            $content .= "=====================================\n";
            $content .= strtoupper($row['section_name'])."\n";
            $content .= "=====================================\n";
            $content .= "Encrypted File : ".$row['encrypted_file']."\n";
            $content .= "SHA256 Hash : ".$row['hash_value']."\n\n";
        }

        $filename = strtolower($exam_name)."_".strtolower($exam_slot)."_final.txt";
        $filepath = "../storage/encrypted/".$filename;

        file_put_contents($filepath, $content);

        mysqli_query($conn,
        "INSERT INTO final_papers(exam_name,exam_slot,final_file)
         VALUES('$exam_name','$exam_slot','$filename')");

        // Audit Log (Success only)
        addLog(
            $conn,
            $_SESSION['user_id'],
            "Generated Final Paper - ".$exam_name." ".$exam_slot,
            "Success"
        );

        $message = "Final Question Paper Generated Successfully!";
        $messageType = "success";

    }else{

        $message = "Three approved sections (Part A, Part B and Part C) are required before generating the final paper.";
        $messageType = "error";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generate Final Question Paper</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->

    <div class="welcome-banner">

        <div>
            <h2>Generate Final Question Paper</h2>
            <p>Merge approved encrypted sections into one secure examination paper.</p>
        </div>

        <div class="role-badge">
            ADMIN
        </div>

    </div>

    <!-- Success / Error Message -->

    <?php if($message!=""){ ?>

        <div class="<?php echo ($messageType=="success") ? 'alert-success' : 'alert-error'; ?>">
            <?php echo $message; ?>
        </div>

    <?php } ?>

    <!-- Generate Paper Form -->

    <div class="card">

        <h2>Generate Paper</h2>

        <form method="POST">

            <label><strong>Select Examination</strong></label>

            <select name="exam_name" required>
                <option value="">Choose Examination</option>
                <option value="JEE">JEE</option>
                <option value="NEET">NEET</option>
                <option value="GATE">GATE</option>
            </select>

            <br><br>

            <label><strong>Select Exam Slot</strong></label>

            <select name="exam_slot" required>
                <option value="">Choose Slot</option>
                <option value="Morning">Morning</option>
                <option value="Afternoon">Afternoon</option>
                <option value="Evening">Evening</option>
            </select>

            <br><br>

            <button type="submit" name="generate" class="generate-btn">
                Generate Final Question Paper
            </button>

        </form>

    </div>

    <br>

    <!-- Information Card -->

    <div class="download-card">

        <h3>Generation Process</h3>

        <p>✔ Verifies that Part A, Part B and Part C are approved.</p>

        <p>✔ Combines all approved encrypted sections.</p>

        <p>✔ Preserves SHA-256 hash values for blockchain verification.</p>

        <p>✔ Stores the generated paper in secure encrypted storage.</p>

        <p>✔ Records the generation event in the audit log.</p>

    </div>

    <hr style="margin-top:40px;">

    <div class="footer-text">
        Secure Examination Management Portal • Coimbatore Institute of Technology • 2026
    </div>

</div>

</body>
</html>