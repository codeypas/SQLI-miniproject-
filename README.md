# SQL Injection & Brute Force Attack Demonstration

## 📌 Overview
This project demonstrates **SQL Injection (SQLI) vulnerabilities** and **brute-force attack techniques** in a PHP-based login system. It is created for **educational purposes** to help students understand web security flaws and how to prevent them.

---

## 🚀 Technologies Used

- **Frontend:** HTML, CSS, Bootstrap  
- **Backend:** PHP, MySQL  
- **Security Testing:** Hydra (for brute-force attack)  
- **Email Handling:** PHPMailer  
- **Local Server:** MAMP (for macOS/Linux testing)  
- **Operating System:** Linux (for penetration testing)  

---

## 📂 Project Structure

```
/SQLI-miniproject
│── /assets/               # CSS & JS files
│── /database/             # Database scripts
│── /includes/             # Connection & helper files
│── /pages/                # Login, Register, Home, etc.
│── index.php              # Main entry point
│── connection.php         # Database connection
│── README.md              # Project documentation
```

---

## ⚙️ Setup Instructions

### 1️⃣ Clone the Repository  
```bash
git clone https://github.com/codeypas/SQLI-miniproject-.git
cd SQLI-miniproject-
```

### 2️⃣ Configure MAMP for Local Testing  
- Install [MAMP](https://www.mamp.info/) for macOS/Linux.  
- Start **Apache & MySQL** services.

### 3️⃣ Set Up the Database  
- Open **phpMyAdmin** and create a new database:  
  ```sql
  CREATE DATABASE testdb;
  ```
- Import the provided `database.sql` file:  
  ```bash
  mysql -u root -p testdb < database.sql
  ```
- Update **connection.php** with database credentials:  
  ```php
  $conn = new mysqli("localhost", "root", "", "testdb");
  ```

### 4️⃣ Install PHPMailer  
```bash
composer require phpmailer/phpmailer
```

---

## 🛡️ Brute-Force Attack Demonstration using Hydra  

### 1️⃣ Install Hydra on Linux  
```bash
sudo apt update && sudo apt install hydra -y
```

### 2️⃣ Execute Brute-Force Attack  
```bash
hydra -l admin -P password_list.txt 127.0.0.1 http-post-form "/login.php:email=^USER^&pswd=^PASS^:Invalid username or password"
```

### 🔍 Explanation:  
- `-l admin` → Attempts brute-force on "admin"  
- `-P password_list.txt` → Uses a dictionary attack  
- `127.0.0.1` → Targets the localhost server  
- `http-post-form` → Specifies form submission  
- `/login.php` → The vulnerable login script  
- `"Invalid username or password"` → Identifies failed attempts  

---

## 🔐 Security Fixes & Prevention

✅ **Use password hashing** (`password_hash()` and `password_verify()`).  
✅ **Implement rate limiting** (restrict login attempts per IP).  
✅ **Enable CAPTCHA** to prevent automated brute-force attacks.  
✅ **Enforce multi-factor authentication (MFA).**  

---

## ⚠️ Disclaimer

> **This project is for educational purposes only.**  
> Do **NOT** use it for unethical hacking or unauthorized penetration testing. Always test vulnerabilities in a legal environment.

---

## 👨‍💻 Author  

**Bijay Adhikari**  
📌 [GitHub Profile](https://github.com/codeypas)  
📧 Contact: your.email@example.com  

---
