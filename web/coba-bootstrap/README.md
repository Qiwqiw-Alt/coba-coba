# PHP Bootstrap To-Do List Application

A simple, responsive To-Do List web application built using **PHP (Object-Oriented Programming)**, **MySQL**, and styled with **Bootstrap 5** (utilizing a sleek dark theme).

## Features

- **Task Management (CRUD)**: Create, Read, Update, and Delete tasks.
- **Detailed Task View**: Inspect task descriptions and completion statuses.
- **Bulk Delete**: Delete all tasks at once with a safety confirmation modal.
- **Interactive Modals**: Confirmation prompts using Bootstrap Modals for deletions.
- **Sleek UI/UX**: Responsive dark mode theme using Bootstrap 5 utility classes.

---

## File Structure

The project contains the following core files:

*   [`db.php`]: Configures the database connection using the `mysqli` extension.
*   [`todo.php`]: Contains the `todo` class, encapsulating the database logic and queries (CRUD operations).
*   [`homepage.php`]: The dashboard displaying the checklist of all tasks, complete/incomplete status, and action buttons.
*   [`add.php`]: Form to add new tasks with name, description, and status.
*   [`detail.php`]: Renders details of a selected task.
*   [`edit.php`]: Form to update the name, description, or status of an existing task.

---

## Requirements

To run this application, make sure you have the following installed:

- **PHP** (v7.4 or higher recommended)
- **Apache Server** (e.g., XAMPP, WampServer, or Laragon)
- **MySQL Database Server**

---

## Installation & Setup

1.  **Clone or Copy the Files**  
    Place the project directory (`coba-bootstrap`) inside your server's root folder (e.g., `C:\xampp\htdocs\coba-coba\web\coba-bootstrap`).

2.  **Database Setup**  
    Start Apache and MySQL from your local server dashboard (e.g., XAMPP Control Panel) and open **phpMyAdmin** (`http://localhost/phpmyadmin`).
    
    Execute the following SQL commands to create the database and table:

    ```sql
    CREATE DATABASE IF NOT EXISTS db_todo;
    USE db_todo;

    CREATE TABLE IF NOT EXISTS todos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(255) NOT NULL,
        description TEXT,
        is_completed TINYINT(1) DEFAULT 0
    );
    ```

3.  **Database Configuration**  
    If your database configuration differs (different host, user, password, or port), update the credentials in [`db.php`](file:///d:/xampp/htdocs/coba-coba/web/coba-bootstrap/db.php):
    ```php
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "db_todo";
    private $port = "3306";
    ```

4.  **Running the Application**  
    Open your web browser and navigate to:
    ```
    http://localhost/coba-coba/web/coba-bootstrap/homepage.php
    ```
