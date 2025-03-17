# SQL Injection & Brute Force Attack Demonstration 

A demonstration project showcasing SQL Injection vulnerabilities in PHP-based login systems and their prevention using secure coding practices.  

## 📌 Project Overview  

This project is designed for educational purposes as mini project of Cybersecurity course to demonstrate SQL injection vulnerabilities, brute-force attacks, and mitigation techniques using PHP, MySQL, PHPMailer, and security tools like Hydra.  

## 🚀 Features  

✅ Secure **User Authentication** (Login & Registration)  
✅ **SQL Injection Protection** using prepared statements  
✅ **Brute-force prevention** techniques  
✅ **Email verification** with **PHPMailer**  
✅ **Account Lockout Mechanism** for failed attempts  
✅ **Two-Factor Authentication (2FA)** implementation  
✅ **Security Headers** for better protection 

## 📂 Project Structure  

```
SQLI-MiniProject/
│── PHPMailer/            # PHPMailer for email verification  
│── SQLI/                 # Main project folder  
│   ├── about.php         # About page  
│   ├── change-profile.php # Profile update  
│   ├── connection.php    # Database connection  
│   ├── contact.php       # Contact page  
│   ├── home.php          # Home page  
│   ├── index.php         # Login page  
│   ├── logout.php        # Logout function  
│   ├── profile.php       # User profile  
│   ├── register.php      # Registration page  
│   ├── view_profile.php  # View user profile  
│   ├── php_security.sql  # MySQL Database script  
│── uploads/              # Folder for file uploads  
│── .gitignore            # Git ignore file  
│── README.md             # Project documentation  
```

## 🔧 Installation  

### 1️⃣ Prerequisites  
- PHP (>=7.4)  
- MySQL  
- Apache  
- MAMP or XAMPP  
- Linux environment (for testing with Hydra)  

### 2️⃣ Setup Instructions  

```sh
# Clone the repository
git clone https://github.com/codeypas/SQLI-miniproject-

# Navigate to the project directory
cd SQLI-MiniProject/SQLI

# Set up database (MySQL)
mysql -u root -p < php_security.sql

# Start your local server
php -S localhost:8000
```

## 🔑 Security Vulnerabilities Demonstrated  

### 🛑 SQL Injection (SQLi)  
- The login form was initially vulnerable to SQL injection due to improper input handling.  
- A prepared statement (`mysqli_prepare`) is now used to prevent injection attacks.  

### 🛑 Brute-Force Attacks  
- Hydra is used to perform brute-force login attempts on the system.  
- Rate-limiting and CAPTCHA can be added to prevent such attacks.  

### 🛑 Plaintext Password Storage  
- Initially, passwords were stored in plaintext, making them vulnerable.  
- Now, `password_hash()` is used for hashing passwords securely.  

## 🔍 Demonstration of Hydra Brute Force Attack  

```sh
hydra -l admin -P password_list.txt 127.0.0.1 http-post-form "/index.php:username=^USER^&password=^PASS^:Invalid username or password"
```



## ⚠️ Disclaimer

> **This project is for educational purposes only.**  
> Do **NOT** use it for unethical hacking or unauthorized penetration testing. Always test vulnerabilities in a legal environment.


## 👨‍💻 Author  

**Bijay Adhikari**  
📌 [GitHub Profile](https://github.com/codeypas)  
📧 Contact: bjbestintheworld@gmail.com  
