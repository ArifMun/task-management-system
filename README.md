# Task Management System

Tech Stack
PHP v8.2
Laravel v12.0
Filament v4.0
Filament Shield v4.0
MySQL (sesuaikan dengan .env)

Sebuah aplikasi manajemen tugas berbasis **Laravel + Filament**, dengan dukungan **Filament Shield** untuk pengaturan role dan permission.

## 🚀 Fitur
- **User Management**: Kelola pengguna dengan role dan permission.
- **Role & Permission**: Menggunakan [Filament Shield](https://github.com/bezhanSalleh/filament-shield) untuk manajemen akses.
- **Severities & Status**: Atur tingkat keparahan (severity) dan status dari task.
- **Task Management**:
  - **Role Developer** hanya dapat melihat task miliknya sendiri.
  - **Role Admin** dapat melihat semua task.
- **Kelebihan**:
  - Setiap task memiliki fitur komentar dengan level 1/ tingkat 1 .
  - Untuk tingkat keparahan dapat diubah warnya badgenya
  - Role dari setiap akun bisa diseting seperlunya
  - Terdapat filter berdasarkan severity dan status
  - Auto fill finish date ketika status diubah ke completed
  
## 📦 Instalasi

1. Clone repository
   ```bash
   git clone https://github.com/ArifMun/task-management-system.git
   cd task-management-system
2. composer update
3. cp .env.example .env
4. sesuaikan di

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=[local]
DB_PASSWORD=[password local]

5. lalu tambahkan di .env
6. php artisan key:generate
7. php artisan shield:generate --all
8. php artisan db:seed
9. php artisan serve untuk menjalankan laravelnya
10. ketikan url berikut pada browser : http://127.0.0.1:8000/task-management-system/
11. lalu login menggunakan akun di bawah ini
Login dengan akun berikut:
Username: admin@example.com
Password: password

12. Lakukan seting terlebih dahulu pada menu roles untuk menentukan siapa saja dan membutuhkan menu apa saja
