🖥️ Portfolio Template

A clean, modern, and fully customizable personal portfolio website.  
Perfect for students, developers, and creatives who want a dynamic portfolio with an admin panel.

## 📚 Table of Contents
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation & Setup](#installation--setup)
- [Database Setup (schema.example.md)](#database-setup-schemaexamplemd)
- [Admin Panel](#admin-panel)
- [Developer](#developer)

## ✨ Features
- Fully dynamic content pulled from MySQL database  
- Unlimited projects, skills, education, certifications, and social links  
- Working contact form with PHP backend (email configuration needed)  
- Beautiful admin dashboard to manage everything  
- Responsive & minimalist design  
- Easy to customize colors, fonts, and layout  

## 🧰 Tech Stack

| Category        | Technology                     |
|-----------------|--------------------------------|
| Frontend        | HTML, CSS, JavaScript, Bootstrap |
| Backend         | PHP 8+                         |
| Database        | MySQL / MariaDB                |
| Local Server    | XAMPP, Laragon, WAMP, MAMP     |
| Version Control | Git & GitHub                   |

## ⚙️ Installation & Setup

1. **Clone the repository**  
   ```bash
   git clone https://github.com/stooopidkenly/Web-Systems-2.git

Enter the folderBashcd Web-Systems-2
Copy the entire folder into your local server directory
(e.g., htdocs in XAMPP, www in Laragon/WAMP)
Start Apache & MySQL in your local server
Import the database → see Database Setup below
Configure database connection in (dbConnection.php);
Open sendEmail.php and update your receiving email + SMTP (if needed) (configure if needed)
Visit in browser
→ http://localhost/Web-Systems-2

Database Setup (schema.example.md)
Inside the repo, open schema.example.md — it contains the complete MySQL schema + dummy INSERT queries.
Steps:

Create a new database (e.g., portfolio_db)
Copy everything from schema.example.md
Paste and run it in phpMyAdmin (or any MySQL client)

This will automatically:

Create all required tables (about, education, projects, skills, social_links, certifications, etc.)
Insert beautiful dummy data so your portfolio looks complete instantly

You can then edit/delete/add rows directly in phpMyAdmin or via the admin panel.
Admin Panel
Access: http://localhost/Web-Systems-2/admin/login.php
Default credentials (change immediately!):

For credentials of admin, insert this query;
Username: admin
Password: admin123

From the admin panel you can:

Update your name, title, about section
Add/edit/delete projects, skills, education, certifications
Manage social links
View contact form messages

👥 Developer <br>
stooopidkenly – Creator & maintainer

Feel free to fork, star, improve, and deploy your own version! 🚀

Made with ❤️ for the dev community
