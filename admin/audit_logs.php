<?php
include("../includes/auth.php");
include("../includes/db.php");

$query = "SELECT audit_logs.*, users.name, users.role
          FROM audit_logs
          JOIN users ON audit_logs.user_id = users.user_id
          ORDER BY log_time DESC";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Security Audit Logs</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>

<?php include("../includes/sidebar.php"); ?>

<div class="main">

    <div class="header">
        <div>
            <h2>Security Audit Logs</h2>
            <p>Real-time monitoring of system activities.</p>
        </div>

        <div>
            <?php echo date("d M Y | h:i A"); ?>
        </div>
    </div>

    <br>

    <table>

        <tr>
            <th>User</th>
            <th>Role</th>
            <th>Action</th>
            <th>Status</th>
            <th>IP Address</th>
            <th>Time</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <tr>

            <td><?php echo $row['name']; ?></td>

            <td><?php echo ucfirst($row['role']); ?></td>

            <td><?php echo $row['action']; ?></td>

            <td>
                <?php
                if($row['status']=="Success"){
                    echo "<span class='status-success'>Success</span>";
                }else{
                    echo "<span class='status-failed'>".$row['status']."</span>";
                }
                ?>
            </td>

            <td><?php echo $row['ip_address']; ?></td>

            <td><?php echo date("d M Y h:i A", strtotime($row['log_time'])); ?></td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>
</html>