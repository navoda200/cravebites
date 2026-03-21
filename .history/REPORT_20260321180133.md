# CraveBites Coursework Report

## 1. Project Title
Online Business Website with Admin Features: CraveBites

## 2. Student Project Overview
CraveBites is a PHP and MySQL based online food business website developed to meet the coursework requirement of building a complete website with at least four main pages, database support, and administrative functionality.

The system includes a customer-facing website for browsing products and placing orders, as well as an admin panel for managing products, deals, news updates, and customer contact messages.

## 3. Technologies Used
- Frontend: HTML5, CSS3, JavaScript
- Backend: PHP (PDO)
- Database: MySQL
- Version Control: Git and GitHub
- Local Server: XAMPP/WAMP compatible

## 4. UI Design Plan
The user interface was planned around clarity, responsiveness, and conversion-focused navigation.

Design goals:
- Simple top navigation for quick access to Home, Products, Deals, Contact, Cart
- Prominent call-to-action buttons (Order Now, Add to Cart)
- Card-based menu and deals layout for visual consistency
- Mobile responsive navigation menu
- Separate admin interface for management operations

Key UI files:
- index.php
- products.php
- deals.php
- contact.php
- public/css/styles.css

## 5. Functional Requirements Coverage

### 5.1 Minimum Four Main Pages
The project contains more than four main pages:
- Home page: index.php
- Products page: products.php
- Deals page: deals.php
- Contact page: contact.php
- Additional pages: signin.php, signup.php, cart.php, checkout.php

### 5.2 Admin Features
Admin functionality is implemented in the admin directory:
- Admin authentication: admin/login.php, admin/logout.php
- Admin dashboard: admin/dashboard.php
- Product management (CRUD): admin/products.php, admin/product_form.php
- Deals management (CRUD): admin/deals.php, admin/deal_form.php
- News management (CRUD): admin/news.php, admin/news_form.php
- Contact message management (Read/Delete): admin/contacts.php

## 6. Database Design

### 6.1 Main Tables
- products
- deals
- contacts
- users
- cart_items
- orders
- order_items
- news

### 6.2 Database Scripts
- database/schema.sql
- database/migration_add_auth_cart_orders.sql
- database/migration_create_deals_table.sql
- database/migration_add_categories_and_seed.sql

## 7. DML Operations Evidence
All required DML operations are used in the system.

- SELECT examples:
  - products listing in products.php
  - deals listing in deals.php
  - dashboard counts in admin/dashboard.php

- INSERT examples:
  - contact form submission in contact.php
  - user registration in signup.php
  - order creation in checkout.php

- UPDATE examples:
  - cart quantity update in cart.php
  - product update in admin/product_form.php
  - deal update in admin/deal_form.php

- DELETE examples:
  - cart item removal in cart.php
  - product deletion in admin/products.php
  - deal deletion in admin/deals.php
  - contact deletion in admin/contacts.php

## 8. System Setup and Launch
1. Copy the project folder into htdocs/cravebites.
2. Start Apache and MySQL from XAMPP/WAMP.
3. Create/import database by executing SQL files in order:
   - database/schema.sql
   - database/migration_add_auth_cart_orders.sql
   - database/migration_create_deals_table.sql
   - database/migration_add_categories_and_seed.sql
4. Confirm database credentials in config/database.php.
5. Launch site:
   - http://localhost/cravebites/index.php

## 9. GitHub Contribution Analysis
GitHub is used for contribution tracking and evidence.

Recommended evidence screenshots for submission:
- Repository commit history
- Contributors graph
- Insights/Activity views
- Pull requests or branch history (if available)

Recommended commit message categories:
- feat: for new pages/functions
- fix: for bug fixes
- style: for UI updates
- docs: for README/report updates
- refactor: for code improvements

## 10. Deliverables Mapping

Deliverable 1: Developed website soft copy and launch
- Included as complete source code in this repository
- Launchable through localhost using PHP + MySQL

Deliverable 2: Report including proposal, GUI, and database details
- Provided in this report document (REPORT.md)
- Includes UI planning, features, and database design/details

## 11. Conclusion
The CraveBites project successfully fulfills the coursework requirements by delivering:
- A complete online business website
- More than four public pages
- Full admin features
- Database integration with all DML operations
- GitHub-based development and contribution tracking
