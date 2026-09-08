<!DOCTYPE html>
<html>
<head>
    <title>Upload Question Section</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <div class="welcome-banner">

        <div>
            <h2>Upload Question Section</h2>
            <p>Upload encrypted question paper sections securely.</p>
        </div>

        <div class="role-badge">
            SETTER
        </div>

    </div>

    <div class="card">

        <?php
        if(isset($message)){
            echo "<p style='color:green;font-weight:bold;'>$message</p>";
        }
        ?>

        <form method="POST" enctype="multipart/form-data">

            <label><strong>Exam Name</strong></label><br><br>

            <select name="exam_name" required>
                <option value="">Select Exam</option>
                <option>JEE</option>
                <option>NEET</option>
                <option>GATE</option>
            </select>

            <br><br>

            <label><strong>Exam Slot</strong></label><br><br>

            <select name="exam_slot" required>
                <option>Morning</option>
                <option>Afternoon</option>
                <option>Evening</option>
            </select>

            <br><br>

            <label><strong>Question Section</strong></label><br><br>

            <select name="section_name" required>
                <option>Part A</option>
                <option>Part B</option>
                <option>Part C</option>
            </select>

            <br><br>

            <label><strong>Select PDF File</strong></label><br><br>

            <input type="file" name="paper" accept=".pdf" required>

            <br><br>

            <button type="submit" name="upload">
                Encrypt & Upload
            </button>

        </form>

    </div>

</div>

</body>
</html>