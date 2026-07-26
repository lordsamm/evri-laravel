# Evri Laravel Application

A comprehensive Laravel-based shipment tracking and management system with public-facing pages and an admin dashboard.

## Project Description

This application provides a complete parcel delivery management solution including:
- Public shipment tracking interface
- Admin dashboard for managing shipments, tracking events, fees, and documents
- Payment proof submission and verification system
- Country management for international shipping
- Public-facing static pages migrated from the Evri website

## Main Features

### Admin Dashboard
- **Shipment Management**: Create, view, edit, and track shipments
- **Tracking Events**: Add and manage tracking status updates
- **Fee Management**: Track and manage shipment fees with payment status
- **Document Management**: Upload and manage shipment-related documents (invoices, labels, customs forms, etc.)
- **Payment Proofs**: Review and verify customer payment submissions
- **Country Management**: Manage supported shipping destinations

### Public Features
- **Shipment Tracking**: Public tracking page for customers to check shipment status
- **Payment Proof Submission**: Customers can submit payment proofs for unpaid fees
- **Static Pages**: 400+ public-facing pages including FAQs, guides, service information, and more

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Bootstrap 5
- **Build Tool**: Vite
- **CSS Framework**: Tailwind CSS 4
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Auth
- **File Storage**: Laravel Storage (Public Disk)

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and NPM
- MySQL or SQLite database

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd evri-laravel
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file with your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=evri_laravel
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Link storage (for file uploads)**
   ```bash
   php artisan storage:link
   ```

8. **Start development server**
   ```bash
   php artisan serve
   ```

## Admin Login

Access the admin dashboard at `/admin/login`

Default credentials (create an admin user in the database):
- Username: (configured in database)
- Password: (configured in database)

## Public Tracking

Access the public tracking page at `/track-a-parcel`

Enter a tracking number to view shipment status and tracking history.

## Screenshots

<!-- Add screenshots here -->
- Admin Dashboard
- Shipment Management
- Tracking Interface
- Payment Proof Verification

## Deployment

### Production Deployment Checklist

1. **Environment Variables**
   - Set `APP_ENV=production` in `.env`
   - Set `APP_DEBUG=false` in `.env`
   - Configure production database credentials
   - Set appropriate `APP_URL`

2. **Optimization**
   ```bash
   composer install --optimize-autoloader --no-dev
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   npm run build
   ```

3. **File Permissions**
   - Ensure `storage` and `bootstrap/cache` directories are writable
   - Run `php artisan storage:link` for file uploads

4. **Queue Workers** (if using queues)
   ```bash
   php artisan queue:work --daemon
   ```

### Server Requirements
- PHP >= 8.2
- MySQL >= 5.7 or SQLite
- Composer
- Node.js & NPM
- Mod_rewrite or equivalent URL rewriting

## License

This project is open-sourced software licensed under the MIT license.
