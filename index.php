<!DOCTYPE html>
<html>
<head>
    <title>Secure Examination Management Portal</title>
    <link rel="stylesheet" href="css/home.css">
</head>

<body>

<!-- HEADER -->

<div class="hero">

    <h3>COIMBATORE INSTITUTE OF TECHNOLOGY</h3>

    <h1>Secure Examination Management Portal</h1>

    <p>
        Blockchain-Based Secure Question Paper Management System
    </p>

</div>

<!-- SECURITY FEATURES -->

<div class="features">

    <div class="feature-card">
        <div class="icon">⛓️</div>
        <h3>Blockchain Security</h3>
        <p>Immutable blockchain ledger protects question paper integrity.</p>
    </div>

    <div class="feature-card">
        <div class="icon">🔐</div>
        <h3>AES-256 Encryption</h3>
        <p>Every uploaded question paper section is encrypted securely.</p>
    </div>

    <div class="feature-card">
        <div class="icon">📱</div>
        <h3>OTP Authentication</h3>
        <p>Exam Centers verify OTP before downloading the paper.</p>
    </div>

    <div class="feature-card">
        <div class="icon">⏳</div>
        <h3>Time Locked Release</h3>
        <p>Question papers are accessible only during the scheduled exam window.</p>
    </div>

</div>

<!-- LOGIN PORTALS -->

<div class="login-section">

    <h2>Select Login Portal</h2>

    <div class="login-cards">

        <div class="login-card">

            <div class="icon">👨‍💼</div>

            <h3>Administrator</h3>

            <p>
                Generate final papers, approve uploads, verify blockchain and monitor audit logs.
            </p>

            <a href="login.php?role=admin">
                <button class="login-btn">Admin Login</button>
            </a>

        </div>

        <div class="login-card">

            <div class="icon">👩‍🏫</div>

            <h3>Question Setter</h3>

            <p>
                Upload encrypted Part A, Part B and Part C question paper sections.
            </p>

            <a href="login.php?role=setter">
                <button class="login-btn">Setter Login</button>
            </a>

        </div>

        <div class="login-card">

            <div class="icon">🏫</div>

            <h3>Exam Center</h3>

            <p>
                Authenticate using OTP and download the final encrypted question paper.
            </p>

            <a href="login.php?role=center">
                <button class="login-btn">Exam Center Login</button>
            </a>

        </div>

    </div>

</div>

<!-- FOOTER -->

<div class="footer">

    <h3>Department of Computer Science and Engineering</h3>

    <p>Coimbatore Institute of Technology</p>

    <p>Mini Project • 2026</p>

</div>

</body>
</html>