# Laravel User Position API

## Project Overview

This project provides an API for managing user positions. It allows users to perform CRUD (Create, Read, Update, Delete) operations on positions. The API includes validation rules and search functionality.

This project is built using **Laravel 11** (although the exam requires **Laravel 10**).

### Features:
1. **Create new position**
2. **View all positions**
3. **View position details**
4. **Update position name and report hierarchy**
5. **Delete position**

---

## Requirements

- **PHP 8.3 or higher**
- **Laravel 11** (Exam requires Laravel 10)
- **MySQL 8**
- Composer (for dependency management)

---

## Setup (Run dependencies)

1. **clone the repository**
2. **composer install**
2. **run 'npm install'**
3. **run 'npm run dev' on the terminal**
4. **'php artisan serve' on the terminal**

## API Routes
Bash
# View all positions
http://localhost:8000/api/user-positions
# View position details
http://localhost:8000/api/user-position/{id}
# Create new position
http://localhost:8000/api/user-position
# Update position
http://localhost:8000/api/user-position/{id}
# Delete position
http://localhost:8000/api/user-position/{id}

