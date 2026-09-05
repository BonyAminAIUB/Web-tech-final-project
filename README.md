# 🩸 BloodConnectBD

**BloodConnectBD** is a web-based blood donation and management platform designed to connect blood donors with people who need blood. The main goal of this project is to make the blood donation process faster, easier, and more organized by providing a centralized platform for managing donors, blood requests, and donation information.

This project was developed as a **Web Technologies Final Project** at **American International University-Bangladesh (AIUB)**.

---

## 📌 Project Overview

Finding a suitable blood donor during an emergency can be difficult and time-consuming. BloodConnectBD provides a digital platform where users can register as donors, manage their profiles, view blood requests, and help people in need of blood.

The system also provides administrative functionalities for managing users, blood requests, and donation-related information.

### 🎯 Main Objectives

* Connect blood donors with people who need blood.
* Make blood requests easier to manage.
* Maintain donor and donation records.
* Provide a simple and user-friendly interface.
* Reduce the time required to find suitable blood donors.
* Provide administrators with tools to manage the platform.

---

## ✨ Key Features

### 👤 User Management

* User registration and login
* User authentication
* User profile management
* Secure session-based access
* Role-based access for different users

### 🩸 Donor Management

* Donor registration
* Donor information management
* Blood group information
* Donor profile management
* Donation history management

### 🚨 Blood Request Management

* Create blood requests
* View available blood requests
* Manage blood request information
* Connect donors with blood seekers
* Track donation-related information

### 🛠️ Admin Panel

* Admin authentication
* Manage registered users
* Manage donor information
* Manage blood requests
* Manage donation records
* Monitor overall system activities

### 🗄️ Database Management

The project uses a relational database to store:

* User information
* Donor information
* Blood requests
* Donation records
* Other system-related data

The database structure and SQL file are included in the `database` directory.

---

## 🏗️ Project Architecture

BloodConnectBD follows an **MVC-style architecture** to keep the application organized and maintainable.

```text
BloodConnectBD
│
├── app/
│   ├── controllers/
│   │   ├── AdminController.php
│   │   ├── AuthController.php
│   │   └── DonorController.php
│   │
│   ├── models/
│   │   ├── BloodRequest.php
│   │   ├── Donation.php
│   │   └── User.php
│   │
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── donor/
│       ├── home/
│       └── user/
│
├── config/
│   └── database.php
│
├── database/
│   └── bloodconnect.sql
│
└── public/
    ├── css/
    ├── js/
    └── index.php
```

---

## 🧩 Architecture Components

### Controller

Controllers handle application logic and user requests.

Examples:

* `AdminController.php`
* `AuthController.php`
* `DonorController.php`

### Model

Models handle database-related operations and represent the main entities of the system.

Examples:

* `User.php`
* `BloodRequest.php`
* `Donation.php`

### View

Views contain the user interface of the application and are separated according to different user roles and sections.

### Configuration

The `config` directory contains the database configuration required to connect the application with MySQL.

### Database

The `database` directory contains the SQL database file required to create the BloodConnectBD database.

### Public

The `public` directory acts as the application's public entry point and contains frontend assets such as CSS and JavaScript files.

---

## 🛠️ Technologies Used

| Technology           | Purpose                                   |
| -------------------- | ----------------------------------------- |
| **PHP**              | Backend development and server-side logic |
| **MySQL**            | Database management                       |
| **HTML5**            | Web page structure                        |
| **CSS3**             | Website styling                           |
| **JavaScript**       | Client-side functionality                 |
| **MVC Architecture** | Application organization                  |
| **XAMPP**            | Local development environment             |
| **Git & GitHub**     | Version control and project hosting       |

---

## ⚙️ Requirements

Before running the project, make sure the following software is installed:

* **XAMPP**
* **PHP**
* **MySQL**
* **Apache**
* A modern web browser
* **Git** (optional, for cloning the repository)

---

## 🚀 Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/BonyAminAIUB/Web-tech-final-project.git
```

### 2. Move the Project

Copy the project folder into the XAMPP `htdocs` directory.

For example:

```text
C:\xampp\htdocs\Web-tech-final-project
```

### 3. Start XAMPP

Open XAMPP Control Panel and start:

```text
Apache
MySQL
```

### 4. Create the Database

Open:

```text
http://localhost/phpmyadmin
```

Create a database for the project.

Then import:

```text
database/bloodconnect.sql
```

into the newly created database.

### 5. Configure Database Connection

Open:

```text
config/database.php
```

Configure the database connection according to your local MySQL settings.

Example:

```php
$host = "localhost";
$username = "root";
$password = "";
$database = "bloodconnect";
```

> Make sure the database name matches the database you created in phpMyAdmin.

### 6. Run the Project

Open your browser and visit:

```text
http://localhost/Web-tech-final-project/public/
```

The BloodConnectBD application should now be available.

---

## 🔄 Basic System Flow

```text
             ┌─────────────────┐
             │      User       │
             └────────┬────────┘
                      │
                      ▼
             ┌─────────────────┐
             │ Registration /  │
             │     Login       │
             └────────┬────────┘
                      │
             ┌────────┴────────┐
             │                 │
             ▼                 ▼
      ┌─────────────┐   ┌──────────────┐
      │    Donor    │   │ Blood Seeker │
      └──────┬──────┘   └───────┬──────┘
             │                  │
             │                  ▼
             │          Create Blood Request
             │                  │
             └─────────┬────────┘
                       ▼
              ┌─────────────────┐
              │ Blood Request   │
              │    System       │
              └────────┬────────┘
                       │
                       ▼
              ┌─────────────────┐
              │    Donation     │
              │    Process      │
              └─────────────────┘
```

---

## 🔐 Security Considerations

The application uses authentication and controlled access to protect different sections of the system.

Important security practices for deployment include:

* Password hashing
* Session management
* Input validation
* SQL injection prevention
* Access control
* Secure database configuration
* Protection of sensitive user information

---

## 📁 Repository Structure

```text
Web-tech-final-project/
│
├── app/
│   ├── controllers/
│   ├── models/
│   └── views/
│
├── config/
│   └── database.php
│
├── database/
│   └── bloodconnect.sql
│
└── public/
    ├── css/
    ├── js/
    └── index.php
```

---

## 🎓 Academic Information

**Project Name:** BloodConnectBD
**Course:** Web Technologies
**Project Type:** Final Project
**Institution:** American International University-Bangladesh (AIUB)

---

## 👨‍💻 Developer

**Md Bony Amin**

GitHub:
https://github.com/BonyAminAIUB

---

## 📄 License

This project was developed for academic and educational purposes.

---

## ❤️ Purpose

> **"Donate Blood, Save Lives."**

BloodConnectBD aims to use web technology to make blood donation more accessible, organized, and efficient for everyone.
