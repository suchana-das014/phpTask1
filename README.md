## PHP + Tailwind Modal Form

A simple web form built with HTML, CSS, JavaScript, PHP, and Tailwind CSS. Users can submit data, view it in a styled table, and manage entries with edit and delete options.
---

## ✨ Features

Submit data through a user-friendly form

View stored entries in a responsive table

Edit or delete entries directly from the interface

Fully responsive design using Tailwind CSS

Interactive buttons and validations via JavaScript

Data storage handled with PHP + MySQL
---

## ⚙️ Requirements

MySQL database

Web server (Apache, XAMPP)

Tailwind CSS (via CDN)
---

## 🚀 Setup Instructions

Clone the repository:

git clone [<your-repo-url>](https://github.com/suchana-das014/phpTask1)


## Create the database:

Use phpMyAdmin or MySQL CLI to create a database 

Create a table to store form submissions
---

Configure PHP connection:
Update your PHP file with database credentials:

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'form_db';

---
## Deploy files:
Place all files (index.html, style.css, script.js, database.php) in your server’s public directory

## Run the app:
Open index.html in your browser to start submitting and managing data
---
 ## 📂 File Structure
project/
├── index.html       # Form and table UI
├── style.css        # Tailwind CSS + custom styles
├── script.js        # JS for form interactivity
└── database.php     # PHP backend for storing and managing data
