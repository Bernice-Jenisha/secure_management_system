<?php
session_start();

include("includes/db.php");
include("includes/log_helper.php");

// Role selected from homepage
$selectedRole = isset($_GET['role']) ? $_GET['role'] : "";

$error = "";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $role = $_POST['role'];

    $query = "SELECT * FROM users
              WHERE email='$email'
              AND password='$password'
              AND role='$role'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        addLog($conn,$row['user_id'],"User Login","Success");

        if($role=="admin"){
            header("Location: admin/dashboard.php");
        }
        elseif($role=="setter"){
            header("Location: setter/dashboard.php");
        }
        else{
            header("Location: center/dashboard.php");
        }

        exit();

    }else{

        $error = "Invalid credentials for selected role.";

    }

}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="login-page">

    <div class="login-box">

        <h2>
            <?php
            if($selectedRole=="admin") echo "Administrator Login";
            elseif($selectedRole=="setter") echo "Question Setter Login";
            elseif($selectedRole=="center") echo "Exam Center Login";
            else echo "Secure Exam Login";
            ?>
        </h2>

        <p style="color:#64748B;">
            Secure Examination Management Portal
        </p>

        <?php if($error!=""){ ?>
            <div class="alert-error">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <input type="hidden"
                   name="role"
                   value="<?php echo $selectedRole; ?>">

            <label>Email Address</label>

            <input type="email"
                   name="email"
                   placeholder="Enter Email"
                   required>

            <label>Password</label>

            <input type="password"
                   name="password"
                   placeholder="Enter Password"
                   required>

            <button type="submit"
                    name="login"
                    class="generate-btn">

                Login Securely

            </button>

        </form>

        <br>

        <a href="index.php">⬅ Back to Homepage</a>

    </div>

</div>

</body>
</html>