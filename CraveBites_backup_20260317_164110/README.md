# CraveBites Coursework Project

This is a complete Web Application Development coursework project built with:
- HTML
- CSS
- JavaScript
- PHP
- MySQL

## Implemented Requirements

- Online business website with responsive UI
- More than 4 main pages:
  - Home (`index.php`)
  - Products (`products.php`)
  - News (`news.php`)
  - Contact (`contact.php`)
- Admin features:
  - Login/logout
  - Dashboard
  - Product management (Create, Read, Update, Delete)
  - News management (Create, Read, Update, Delete)
  - Contact message management (Read, Delete)
- Database integration with all DML operations:
  - `SELECT`
  - `INSERT`
  - `UPDATE`
  - `DELETE`

## Admin Login

- Username: `admin`
- Password: `admin123`

## Setup Instructions

1. Install XAMPP/WAMP (or any PHP + MySQL server).
2. Copy this project into your server root (for example `htdocs/CraveBites`).
3. Start Apache and MySQL.
4. Open phpMyAdmin and execute [database/schema.sql](database/schema.sql).
5. Update database credentials if needed in [config/database.php](config/database.php).
6. Visit:
   - `http://localhost/CraveBites/index.php`

## GitHub Contribution Evidence

To show contribution analysis for coursework:
- Push this project to GitHub.
- Use commit history with meaningful commit messages.
- Take screenshots of:
  - Commit log
  - Contributors graph
  - Repository insights

## Project Structure

- `index.php`, `products.php`, `news.php`, `contact.php` - Public pages
- `admin/` - Admin panel pages
- `includes/` - Shared layout and helper functions
- `config/database.php` - PDO database connection
- `database/schema.sql` - Database schema + sample data
- `public/css/styles.css` - Styling
- `public/js/main.js` - Frontend JavaScript
