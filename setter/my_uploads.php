<?php
include("../includes/auth.php");
include("../includes/db.php");

$user = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT * FROM question_sections WHERE setter_id='$user'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Uploads</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <div class="welcome-banner">

        <div>
            <h2>My Upload History</h2>
            <p>Encrypted Question Sections Uploaded</p>
        </div>

        <div class="role-badge">
            SETTER
        </div>

    </div>

    <table>

        <tr>
            <th>Exam</th>
            <th>Slot</th>
            <th>Section</th>
            <th>Encrypted File</th>
            <th>Status</th>
            <th>Uploaded On</th>
        </tr>

        <?php while($row=mysqli_fetch_assoc($result)){ ?>

        <tr>

            <td><?= $row['exam_name']; ?></td>

            <td><?= $row['exam_slot']; ?></td>

            <td><?= $row['section_name']; ?></td>

            <td><?= $row['encrypted_file']; ?></td>

            <td>
                <?php
                if($row['status']=="Approved"){
                    echo "<span class='status-success'>Approved</span>";
                }else{
                    echo "<span class='status-pending'>Pending</span>";
                }
                ?>
            </td>

            <td><?= date("d M Y h:i A",strtotime($row['upload_time'])); ?></td>

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