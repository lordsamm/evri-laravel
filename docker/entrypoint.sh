#!/bin/bash
set -e

# Wait for database to be ready (optional, can be adjusted)
echo "Starting entrypoint script..."

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

# Create storage link (ignore errors if already exists)
echo "Creating storage link..."
php artisan storage:link || true

# Cache Laravel configuration
echo "Caching Laravel configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Optimize application
echo "Optimizing application..."
php artisan optimize

# Ensure permissions are correct
echo "Setting permissions..."
chown -R www-data:www-data /var/www/html
chmod -R 775 storage bootstrap/cache
chmod -R 755 public

echo "Entrypoint completed. Starting services..."

exec "$@"
