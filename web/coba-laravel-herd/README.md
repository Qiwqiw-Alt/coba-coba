# Finance Book 📊

A clean and simple personal finance and transaction tracker built with **Laravel 13** and **Bootstrap**. This application helps users track their daily financial activities by recording incomes and outcomes (expenses) and providing an instant summary of their financial health.

---

##  Features

- **Financial Summary**: Real-time totals for **Total Income** and **Total Outcome** displayed at the top of the dashboard.
- **Transaction History**: An interactive list of all transactions sorted by date and ID in descending order.
- **Transaction Details**: Detailed view of each transaction, including date, amount, category, type (Income/Outcome), asset (cash, card, etc.), and custom description.
- **CRUD Management**: Easily **Add**, **Edit**, **View**, and **Delete** individual transaction records.
- **Bulk Delete**: A secure "Delete All Transactions" feature to easily reset your tracker.
- **Robust Input Handling**: Validations for inputs and automatic formatting of transaction values.

---

##  Tech Stack

- **Backend Framework**: [Laravel 13](https://laravel.com/)
- **Programming Language**: PHP >= 8.3
- **Frontend Styling**: [Bootstrap](https://getbootstrap.com/)
- **Database**: MySQL (Default, configurable in `.env`)
- **Testing Framework**: [Pest PHP](https://pestphp.com/)
- **Dev Utilities**: Laravel Boost & Laravel Pail

---

##  Prerequisites

Ensure you have the following installed on your local machine:
- **PHP** >= 8.3
- **Composer** (PHP Package Manager)
- **MySQL** or any other compatible relational database
- **Laravel Herd** (recommended) or PHP CLI for local serving

---

##  Installation & Setup

Follow these steps to set up the project locally:

### 1. Clone the Repository
Download or clone the project directory to your web server workspace (e.g., Herd, XAMPP `htdocs`, etc.).

### 2. Install Dependencies
Run Composer to install all required PHP packages:
```bash
composer install
```

### 3. Environment Configuration
Create a `.env` file by copying the example file:
```bash
cp .env.example .env
```
Open `.env` and configure your database settings. For example, if you are using MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_finance_book
DB_USERNAME=your_username
DB_PASSWORD=your_password
```
*(Make sure you create the `db_finance_book` database in your MySQL server before running the next step).*

### 4. Generate Application Key
Generate a secure encryption key for the Laravel application:
```bash
php artisan key:generate
```

### 5. Run Migrations
Run the migrations to set up the database tables (e.g., `transactions`):
```bash
php artisan migrate
```

---

## 🖥️ Running the Application

### Using Laravel Herd (Recommended)
If you are using **Laravel Herd**, the application is served automatically. 
Simply access it in your browser at:
`http://coba-laravel-herd.test`

### Using Artisan Serve
If you are not using Herd, you can start the Laravel built-in server:
```bash
php artisan serve
```
Then open `http://127.0.0.1:8000` in your web browser.

---

##  Running Tests

The project is configured with **Pest PHP** for testing. Run the following command to execute the test suite:
```bash
php artisan test
```
or use the Composer alias:
```bash
composer run test
```

---

##  Project Structure (Key Directories)

- [`app/Models/Transaction.php`](file:///d:/xampp/htdocs/coba-coba/web/coba-laravel-herd/app/Models/Transaction.php) - The database model representing a financial transaction.
- [`app/Http/Controllers/TransactionController.php`](file:///d:/xampp/htdocs/coba-coba/web/coba-laravel-herd/app/Http/Controllers/TransactionController.php) - Controller containing the CRUD logic, calculations, and redirection flows.
- [`routes/web.php`](file:///d:/xampp/htdocs/coba-coba/web/coba-laravel-herd/routes/web.php) - Web routing configuration.
- [`resources/views/transaction/`](file:///d:/xampp/htdocs/coba-coba/web/coba-laravel-herd/resources/views/transaction) - Blade templates for the application pages (`index.blade.php`, `create.blade.php`, `edit.blade.php`).
- [`database/migrations/`](file:///d:/xampp/htdocs/coba-coba/web/coba-laravel-herd/database/migrations) - Database table schemas.
