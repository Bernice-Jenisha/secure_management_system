# Secure Examination Management Portal

## Project Title

**Secure Examination Management Portal Using Blockchain and OTP Authentication**

---

## Project Description

The Secure Examination Management Portal is a web-based application developed to securely manage competitive examination question papers. The system prevents unauthorized access, modification, and leakage of question papers by implementing role-based access control, encrypted storage, blockchain-based integrity verification, OTP authentication, audit logging, and time-controlled paper release.

The project supports multiple competitive examinations such as **JEE, NEET, and GATE**, along with multiple examination slots (Morning, Afternoon, Evening).

---

## Technologies / Tools Used

| Technology / Tool  | Purpose                                    |
| ------------------ | ------------------------------------------ |
| PHP                | Backend development                        |
| MySQL              | Database management                        |
| HTML5              | Web page structure                         |
| CSS3               | User interface styling                     |
| JavaScript         | Countdown timer and OTP interactions       |
| Apache             | Web server                                 |
| XAMPP              | Local development environment              |
| phpMyAdmin         | Database administration                    |
| Git                | Version control                            |
| GitHub             | Source code repository                     |
| AWS EC2 (Ubuntu)   | Cloud deployment                           |
| SHA-256            | Hash generation for integrity verification |
| Blockchain Concept | Tamper detection using linked hashes       |

---

## Features

* Role-Based Login (Admin, Question Setter, Exam Center)
* Upload encrypted question paper sections.
* Multiple examination slots.
* Admin approval workflow.
* Automatic final question paper generation.
* Blockchain ledger verification.
* OTP authentication before paper download.
* Time-locked paper release (5-hour access window).
* Audit log monitoring.

---

## Steps to Install and Run the Project

### Local Installation (XAMPP)

1. Install XAMPP.
2. Copy the project folder into:
   `C:\xampp\htdocs\secure_management_system`
3. Start Apache and MySQL.
4. Import `secure_exam_db.sql` into phpMyAdmin.
5. Update `includes/db.php` if required.
6. Open:
   `http://localhost/secure_management_system/`

### AWS Deployment

1. Launch an Ubuntu EC2 instance.
2. Install Apache, PHP, and MySQL.
3. Clone the GitHub repository into `/var/www/html/`.
4. Import `secure_exam_db.sql`.
5. Configure `includes/db.php`.
6. Access the project using the EC2 Public IPv4 address.

---

## Project Structure / Modules

| Module               | Purpose                                                                      |
| -------------------- | ---------------------------------------------------------------------------- |
| `admin/`             | Admin dashboard, approvals, scheduling, blockchain verification, audit logs. |
| `setter/`            | Upload question paper sections and view upload status.                       |
| `center/`            | OTP verification and secure question paper download.                         |
| `blockchain/`        | Blockchain block creation and chain verification.                            |
| `encryption/`        | Encryption and decryption of question paper files.                           |
| `includes/`          | Database connection, authentication, sidebar, logging helpers.               |
| `css/`               | Stylesheets for login, dashboard, and homepage.                              |
| `js/`                | Countdown timer for release and expiry time.                                 |
| `storage/encrypted/` | Stores encrypted question paper files and generated papers.                  |

---

## Sample Input

**Admin**

* Exam: JEE
* Slot: Morning

**Question Setter**

* Upload Part A (`partA.pdf`)
* Upload Part B (`partB.pdf`)
* Upload Part C (`partC.pdf`)

**Exam Center**

* Generate OTP.
* Enter OTP for verification.
* Download paper during release window.

---

## Sample Output

The application produces:

* Homepage with three login portals.
* Admin Dashboard with statistics.
* Question Setter upload page.
* Blockchain verification showing **Verified**.
* OTP verification page.
* Secure download portal with countdown timer.
* Audit log records of all user activities.

(Screenshots are available in the `sample_output` folder.)

---

## Login Credentials

| Role            | Email                                         | Password  |
| --------------- | --------------------------------------------- | --------- |
| Administrator   | [admin@cit.edu.in](mailto:admin@cit.edu.in)   | admin123  |
| Question Setter | [alice@cit.edu.in](mailto:alice@cit.edu.in)   | setter123 |
| Exam Center     | [center@cit.edu.in](mailto:center@cit.edu.in) | center123 |

---

## Security Mechanisms Implemented

* Role-Based Access Control (RBAC)
* SHA-256 Hash Generation
* Blockchain-Based Integrity Verification
* OTP Authentication
* Time-Locked Question Paper Release
* Audit Logging
* Encrypted File Storage

---

## Author

**Bernice Jenisha K**

B.E. Computer Science and Engineering

Coimbatore Institute of Technology (CIT)

Micro Project – 2026
