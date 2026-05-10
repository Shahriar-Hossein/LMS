# LMS — Learning Management System

A Learning Management System (LMS) built with Laravel, Livewire, and TailwindCSS. This project provides instructor course creation, media uploads (images & videos), student enrollment, course reviews, and basic payment integration.

## Features
- Instructor course creation and management
- Course modules, lessons, and assignments
- File uploads for course banners and videos
- Student enrollment and course progress tracking
- Course reviews and ratings
- Admin and role-based permissions

## Tech Stack
- Backend: Laravel (>= 12)
- Frontend: Livewire + TailwindCSS
- DB: MySQL / MariaDB (or other supported DB)
- Testing: Pest / PHPUnit

## Requirements
- PHP >= 8.2
- Composer
- Node.js + npm
- MySQL / MariaDB (or another supported DB)

## Quick Start
1. Clone the repository:

```bash
git clone <repo-url> lms-project
cd lms-project
```

2. Install PHP and JS dependencies:

```bash
composer install
npm install
```

3. Copy the environment file and generate app key:

```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your `.env` with DB and mail settings, then run migrations and seeders:

```bash
php artisan migrate --seed
```

5. Create the storage symlink for public access to uploaded files:

```bash
php artisan storage:link
```

6. (Optional) Publish Livewire config if you need to adjust preview/upload settings:

```bash
php artisan livewire:publish --config
```

## File Uploads / PHP limits
- Course banner images: recommended max 5 MB
- Course videos: recommended max 50 MB

Ensure your PHP settings in `php.ini` accommodate uploads, for example:

```ini
upload_max_filesize = 50M
post_max_size = 60M
max_execution_time = 300
memory_limit = 256M
```

Uploaded files are stored under `storage/app/public/courses/` (publicly available after running `php artisan storage:link`).

## Running locally
- Compile assets for development:

```bash
npm run dev
```

- Or build for production:

```bash
npm run build
```

- Start the Laravel server:

```bash
php artisan serve
```

- Start all servers:

```bash
composer run dev
```

## Tests
- Run the test suite with Pest / PHPUnit:

```bash
./vendor/bin/pest
# or
php artisan test
```

## Useful Artisan Commands
- `php artisan migrate` — run migrations
- `php artisan db:seed` — run seeders
- `php artisan storage:link` — link storage
- `php artisan livewire:publish --config` — publish Livewire config

## Environment Tips
- Make sure database credentials in `.env` are correct.
- Configure mail settings (SMTP) for notifications.
- If using third-party payment providers, add API keys to `.env` (e.g., SSLCommerz/Stripe).

## Contributing
Contributions are welcome. Please open issues or PRs for bug fixes, features, or documentation improvements.

