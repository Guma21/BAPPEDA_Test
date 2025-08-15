# Bappeda Test Full Stack Developer

## Overview

This project is a Laravel-based REST API Using These table **Periode**, **Gambar Usulan**, **SKPD**, **Status Usulan**, & **Usulan**
The API uses **Laravel Sanctum** for authentication via API tokens.

## Requirements

-   PHP >= 8.1
-   Composer
-   Laravel >= 10
-   MySQL or MariaDB
-   Node.js & NPM (for frontend assets if needed)

---

## Installation

```bash
# Clone the repository
git clone https://github.com/Guma21/BAPPEDA_Test.git
cd BAPPEDA-TEST

# Install dependencies
composer install

# Copy environment file and set up database
cp .env.example .env

# Edit .env to match your database configuration
DB_DATABASE=bappeda_test
DB_USERNAME=root
DB_PASSWORD=

# Generate application key
php artisan key:generate

# Run migrations
php artisan migrate

# Install Sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

# Serve the application
php artisan serve
```

---

## Authentication (API Token)

1. Register a new user via POST `/api/register`
2. Login via POST `/api/login`
3. Use the returned token in the request headers:

## API Endpoints

### Authentication

| Method | Endpoint      | Description            | Auth Required |
| ------ | ------------- | ---------------------- | ------------- |
| POST   | /api/register | Register user          | ❌            |
| POST   | /api/login    | Login user & get token | ❌            |
| POST   | /api/logout   | Logout user            | ✅            |

### Usulan Management

| Method | Endpoint          | Description                     | Auth Required |
| ------ | ----------------- | ------------------------------- | ------------- |
| GET    | /api/usulans      | List all usulans (with filters) | ✅            |
| POST   | /api/usulans      | Create a new usulan             | ✅            |
| GET    | /api/usulans/{id} | Get specific usulan             | ✅            |
| PUT    | /api/usulans/{id} | Update usulan                   | ✅            |
| DELETE | /api/usulans/{id} | Soft delete usulan              | ✅            |

## Frontend (Card View)

The project also includes a **web page** to display usulans as responsive cards:

-   **Desktop:** 3 cards per row
-   **Mobile:** 1 card per row

## 🗑 Soft Delete

Deleted usulans will not be removed from the database immediately but marked as deleted.  
To restore, you can use Laravel's `restore()` method.

---

## License

This project is licensed under the MIT License.
