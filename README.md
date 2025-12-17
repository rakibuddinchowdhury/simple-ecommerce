# 🛒 Simple eCommerce System

A robust, full-stack eCommerce application built with **Laravel 12**, **MySQL**, and **Tailwind CSS**. This project features a complete shopping experience for customers and a comprehensive admin dashboard for store management.

## 🚀 Features

### **User (Frontend)**
* **Authentication:** Secure Login, Registration, and Password Management.
* **Product Discovery:** Browse by Categories, "Trending" products, and "New Arrivals".
* **Search:** Real-time product search functionality.
* **Shopping Cart:** AJAX-powered cart with dynamic price calculation.
* **Checkout:** Support for **Cash on Delivery (COD)** and **Stripe Credit Card** payments.
* **Order Management:** View order history and status.
* **Invoicing:** Auto-generated **PDF Invoices** for every order.
* **Profile:** Manage shipping address and account details.

### **Admin (Backend)**
* **Dashboard:** Analytics for Total Revenue, Orders, and registered Users.
* **Product Management:** CRUD operations for Products with image support.
* **Category Management:** Organize products into categories.
* **Order Fulfillment:** View order details and update status (Pending → Completed → Cancelled).
* **User Management:** View registered customers.

---

## 🛠️ Tech Stack

* **Framework:** [Laravel](https://laravel.com)
* **Database:** MySQL
* **Frontend:** Blade Templates, Tailwind CSS
* **Payment Gateway:** Stripe API
* **PDF Generation:** `barryvdh/laravel-dompdf`
* **Scripting:** jQuery (for AJAX requests)

---

## ⚙️ Installation Guide

Follow these steps to run the project locally:

### 1. Clone the Repository
```bash
git clone [https://github.com/rakibuddinchowdhury/simple-ecommerce.git](https://github.com/rakibuddinchowdhury/simple-ecommerce.git)
cd simple-ecommerce

2. Install Dependencies
composer install

3. Environment Setup
Rename the example environment file and configure your database:
cp .env.example .env
Open .env and update your database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=

(Optional) Add your Stripe keys if testing payments:
STRIPE_KEY=your_publishable_key
STRIPE_SECRET=your_secret_key

4. Generate App Key
php artisan key:generate

5. Run Migrations & Seed Data
This command creates the tables and inserts dummy products, categories, and users.
php artisan migrate:fresh --seed

6. Start the Server
php artisan serve
