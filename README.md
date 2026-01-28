# LMS Project (Laravel + Livewire)

A Learning Management System (LMS) built with **Laravel**, **Livewire**, and **TailwindCSS**.  
Supports instructor course creation, file uploads (images/videos), and student course enrollment.

---

## 🛠 Requirements

- PHP ≥ 8.2
- Laravel ≥ 12
- Composer
- Node.js + npm (for compiling frontend assets)
- MySQL / MariaDB (or any supported DB)
- Storage link configured: `php artisan storage:link`

---

## ⚡ Installation / Setup

1. **Clone the repository**  
   ```bash
    git clone <repo-url> lms-project
    cd lms-project
    composer install
    npm install
    npm run dev   # or npm run build for production
    cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan livewire:publish --config
set livewire preview mimes

File Uploads

Banner: Images for courses, max size 5MB

Video: Course videos, max size 50MB

Ensure php.ini values are set appropriately:

upload_max_filesize = 50M
post_max_size = 60M
max_execution_time = 300
memory_limit = 128M


Uploaded files stored in storage/app/public/courses/

running the app 
composer run dev

