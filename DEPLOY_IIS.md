# Deploy Gia Hưng Laravel application to IIS

This guide deploys the application with IIS pointing only at Laravel's `public` directory. Uploaded documents are private files under `storage/app/documents` and must be retained between releases.

## 1. Server prerequisites

- Windows Server with IIS, CGI, and the IIS URL Rewrite module.
- PHP 8.1 or newer, Non-Thread-Safe x64, registered as an IIS FastCGI handler for `*.php`.
- PHP extensions: `curl`, `fileinfo`, `mbstring`, `openssl`, `pdo_mysql` or `pdo_pgsql`, `tokenizer`, and `xml`.
- Composer 2 and Node.js 18 or newer available during deployment.
- A database and a dedicated application account.

Set the IIS application pool to **No Managed Code**, **Integrated** pipeline mode, and enable **Load User Profile**. Use a dedicated pool such as `GiaHungPool`.

## 2. Prepare the release

Run from an elevated PowerShell prompt. Change the two paths to match the server.

```powershell
$releasePath = 'C:\sites\gia-hung'
$backupPath = 'D:\backups\gia-hung'

Set-Location $releasePath
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
npm ci
npm run build
```

Create `.env` from `.env.example` on the first deployment and set at least:

```dotenv
APP_NAME="Gia Hung JSC"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.example
APP_LOCALE=vi
APP_KEY=base64:generated-key

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gia_hung_store
DB_USERNAME=gia_hung_app
DB_PASSWORD=use-a-secret-value

FILESYSTEM_DISK=local
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

Generate `APP_KEY` once with `php artisan key:generate`. Never regenerate it during later deployments.

## 3. Configure IIS

Create the IIS site with:

- Physical path: `C:\sites\gia-hung\public` (not the repository root).
- Application pool: `GiaHungPool`.
- HTTPS binding and the production certificate.
- The repository's `public/web.config`; it contains Laravel rewrite rules and a 25 MB IIS request limit for 20 MB document uploads.

Grant the application-pool identity read access to the release and modify access only to Laravel's runtime directories:

```powershell
icacls 'C:\sites\gia-hung' /grant 'IIS AppPool\GiaHungPool:(OI)(CI)RX' /T
icacls 'C:\sites\gia-hung\storage' /grant 'IIS AppPool\GiaHungPool:(OI)(CI)M' /T
icacls 'C:\sites\gia-hung\bootstrap\cache' /grant 'IIS AppPool\GiaHungPool:(OI)(CI)M' /T
```

The public banner images use `public/storage`. Create the Laravel link once:

```powershell
Set-Location 'C:\sites\gia-hung'
php artisan storage:link
```

If Windows policy blocks symbolic links, create a directory junction from `public\storage` to `storage\app\public` instead.

## 4. Deploy application changes

Back up the database and `storage` first. Do not replace `storage/app/documents` during deployment.

```powershell
Set-Location 'C:\sites\gia-hung'
php artisan down --retry=60

composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
npm ci
npm run build
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan up
Restart-WebAppPool -Name 'GiaHungPool'
```

For a new release directory, copy these persistent items from the previous release before running migrations:

- `.env`
- `storage/app/documents`
- `storage/app/public`

## 5. Verify

Check all of the following:

1. `GET /health` returns `{"status":"ok"}`.
2. The homepage carousel shows active banners in admin-defined order.
3. `/admin/banners` can upload, reorder, hide, and replace banner images.
4. `/admin/documents` can upload a test PDF and `/document` can download it.
5. Header, footer, contact page, and email actions show `gicovn186@gmail.com`.
6. `storage/logs/laravel.log` has no new errors.

## Rollback

Put the site in maintenance mode, restore the previous application release and its matching database backup, retain the backed-up `storage` directory, then run `php artisan optimize:clear`, bring the app up, and restart `GiaHungPool`. Review migration `down()` operations before using `php artisan migrate:rollback` on production data.
