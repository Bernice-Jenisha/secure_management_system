<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/log_helper.php");

// Approve Section
if(isset($_GET['approve'])){

    $id = $_GET['approve'];

    mysqli_query($conn,
    "UPDATE question_sections
    SET status='Approved'
    WHERE section_id='$id'");

    // Audit Log
    addLog(
        $conn,
        $_SESSION['user_id'],
        "Approved Question Section ID ".$id,
        "Success"
    );

    $success = "Question section approved successfully.";
}

// Fetch uploaded sections
$result = mysqli_query($conn,
"SELECT question_sections.*, users.name
FROM question_sections
JOIN users ON question_sections.setter_id = users.user_id
ORDER BY upload_time DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approve Question Sections</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <!-- Welcome Banner -->
    <div class="welcome-banner">

        <div>
            <h2>Approve Question Sections</h2>
            <p>Review and approve encrypted question paper sections uploaded by setters.</p>
        </div>

        <div class="role-badge">
            ADMIN
        </div>

    </div>

    <!-- Success Message -->
    <?php if(isset($success)){ ?>
        <div class="alert-success">
            <?php echo $success; ?>
        </div>
    <?php } ?>

    <h2>Uploaded Question Sections</h2>

    <table>

        <tr>
            <th>Setter</th>
            <th>Exam</th>
            <th>Slot</th>
            <th>Section</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row=mysqli_fetch_assoc($result)){ ?>

        <tr>

            <td><?php echo $row['name']; ?></td>

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

            <td>

                <?php if($row['status']=="Pending"){ ?>

                    <a href="?approve=<?php echo $row['section_id']; ?>">

                        <button class="approve-btn">
                            Approve
                        </button>

                    </a>

                <?php }else{ ?>

                    <button class="approved-btn" disabled>
                        Approved
                    </button>

                <?php } ?>

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