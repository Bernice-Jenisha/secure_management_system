# Secure Examination Management Portal

A secure cloud-based examination question paper management system developed using **PHP, MySQL, Apache, and Blockchain concepts**. The project ensures secure creation, approval, storage, scheduling, and controlled release of competitive examination question papers such as **JEE, NEET, and GATE**.

This project was developed as a **Mini Project** for **Coimbatore Institute of Technology (CIT)**.

---

## Project Overview

The Secure Examination Management Portal provides a role-based system for managing confidential examination question papers. Different question setters upload separate sections of a paper, administrators verify and assemble the final paper, and exam centers receive access only during the scheduled examination window through OTP authentication.

The system also records every important activity in audit logs and maintains blockchain hashes to detect tampering.

---

## Key Features

* Role-based login system (Admin, Question Setter, Exam Center).
* Upload encrypted question paper sections.
* Multiple exam support (JEE, NEET, GATE).
* Multiple exam slots (Morning, Afternoon, Evening).
* Admin approval workflow for uploaded sections.
* Automatic generation of the final question paper after approval.
* Blockchain ledger for integrity verification.
* SHA-256 hash generation for encrypted files.
* OTP authentication before downloading question papers.
* Time-locked paper release with automatic 5-hour expiry.
* Audit logs for monitoring user activities.

---

## Technologies Used

| Technology           | Purpose                  |
| -------------------- | ------------------------ |
| PHP                  | Backend Development      |
| MySQL                | Database                 |
| HTML5                | Structure                |
| CSS3                 | User Interface           |
| JavaScript           | Countdown Timer & OTP UI |
| Apache               | Web Server               |
| Blockchain (SHA-256) | Tamper Detection         |
| AWS EC2 (Ubuntu)     | Cloud Hosting            |

---

## User Roles

### Administrator

* Login to Admin Dashboard.
* Approve uploaded question sections.
* Generate final question paper.
* Schedule examination release.
* Verify blockchain ledger.
* View audit logs.

### Question Setter

* Login to Setter Dashboard.
* Upload encrypted question paper sections.
* View uploaded sections and approval status.

### Exam Center

* Login to Exam Center Dashboard.
* Generate and verify OTP.
* Download question paper during release window only.

---

## Project Workflow

1. Question Setter uploads **Part A**, **Part B**, and **Part C**.
2. Files are encrypted and their SHA-256 hashes are stored.
3. Admin approves uploaded sections.
4. Admin generates the final question paper.
5. Admin schedules release time.
6. Exam Center verifies OTP.
7. Question paper becomes available only within the scheduled time window.
8. Blockchain verification detects tampering.
9. Audit logs record every activity.

---

## Project Structure

```text
secure_management_system/
│
├── admin/
├── setter/
├── center/
├── blockchain/
├── encryption/
├── includes/
├── css/
├── js/
├── storage/
│   └── encrypted/
├── index.php
├── login.php
├── logout.php
└── README.md
```

---

## Database Setup

1. Create a MySQL database named `secure_exam_db`.
2. Import the provided SQL file into MySQL.
3. Update database credentials in:

```php
includes/db.php
```

Example:

```php
$conn = mysqli_connect(
    "localhost",
    "examuser",
    "Exam@123",
    "secure_exam_db"
);
```

---

## Installation (Local - XAMPP)

1. Install XAMPP.
2. Copy the project into:

```text
C:\xampp\htdocs\secure_management_system
```

3. Start Apache and MySQL.
4. Import the SQL database using phpMyAdmin.
5. Open:

```text
http://localhost/secure_management_system/
```

---

## AWS Deployment

The project is deployed on an **AWS EC2 Ubuntu Server** using:

* Apache Web Server
* PHP
* MySQL
* GitHub Repository

Project URL format:

```text
http://<EC2-Public-IP>/secure_management_system/
```

---

## Login Credentials

### Administrator

* **Email:** [admin@cit.edu.in](mailto:admin@cit.edu.in)
* **Password:** admin123

### Question Setter

* **Email:** [alice@cit.edu.in](mailto:alice@cit.edu.in)
* **Password:** setter123

### Exam Center

* **Email:** [center@cit.edu.in](mailto:center@cit.edu.in)
* **Password:** center123

---

## Security Features

* AES encrypted question paper storage.
* SHA-256 hash generation for each uploaded section.
* Blockchain-based integrity verification.
* OTP-based secure paper download.
* Automatic paper expiry after 5 hours.
* Audit logging for every critical operation.

---

## Future Enhancements

* Multi-factor authentication.
* Email/SMS OTP delivery.
* Cloud storage for encrypted papers.
* Digital signatures for question setters.
* AI-based anomaly detection for suspicious activities.

---

## Author

**Bernice Jenisha K**

B.E. Computer Science and Engineering

Coimbatore Institute of Technology (CIT)

Mini Project – 2026

---

## License

This project is developed for academic and educational purposes.
