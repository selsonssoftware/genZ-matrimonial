# GenZ Matrimonial Admin

Laravel 10 application for the GenZ Matrimonial administration portal. It provides admin authentication and screens for the dashboard, member management, profile verification, reports, settings, membership, vendors, and matrimony master data.

## Requirements

- PHP 8.1 or later
- Composer
- MySQL/MariaDB for the existing application database
- A web server configured to serve `backend/public` (for example, XAMPP/Apache)

## Local setup

1. Install PHP dependencies:

   ```powershell
   cd backend
   composer install
   ```

2. Configure the environment:

   ```powershell
   Copy-Item .env.example .env
   php artisan key:generate
   ```

   Set `APP_URL` to the local URL that serves this project's `backend/public` directory, and configure the database connection values to use the existing application database. Do not commit `.env` or share its credentials.

3. Apply available Laravel migrations after confirming the database configuration and taking a backup:

   ```powershell
   php artisan migrate
   ```

   The repository does not include a complete fresh-install schema or a default admin account seeder. The existing member/admin tables and an admin login must be provisioned for this application before use.

4. Point the local web server's document root at `backend/public`, then open the configured `APP_URL` and sign in with a provisioned admin account.

## Testing

Run the backend PHPUnit suite from `backend`:

```powershell
php artisan test
```

## Notes

- Admin routes are under `/admin`; a successful admin login redirects to `/admin/dashboard`.
- Settings include role permissions, security preferences, notification preferences, audit history, and privacy/retention options. External notification delivery, a 2FA challenge/provider, and automated retention cleanup require additional integrations.
- Admin settings backups exclude secrets. Keep database backups and application secrets protected.
