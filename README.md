<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# KisahOmbak

KisahOmbak adalah web yang menyediakan banyak artikel tentang destinasi wisata air yang ada di Kalimantan Timur dengan menjelaskan dari lokasi, harga tiket masuk, akomodasi, paket aktivitas, dan susunan jadwal untuk setiap wisata air.

## Tujuan Web
- Ditujukan untuk keluarga dan remaja yang ingin mengunjungi destinasi wisata air di Kaltim
- Menulis artikel dengan informatif dan akurat untuk dibaca oleh setiap pengguna

## Tujuan Proyek
- Memenuhi tugas proyek dari basis data
- Melatih kerja tim dan pengembangan web
- Menerapkan konsep CRUD, autentikasi, dan UI/UX

## Teknologi yang Digunakan
- **Framework** : Laravel
- **Frontend** : Blade / Tailwind CSS
- **Backend** : PHP
- **Database** : MySQL
- **Tools** : Git, GitHub

## Fitur Utama
- Login & Register
- CRUD data (pengguna, artikel, komentar, like, dan rating)
- Upload gambar
- Logout

## Role Pengguna
- **Admin** : Mengelola pengguna dan artikel
- **Writer** : Menulis, menjadwalkan, dan mempublikasikan artikel
- **User** : Membaca, memberi komentar, like, dan rating

## Struktur Folder (opsional)
```text
├── app
│   └── console
│       └── commands
│           └── PublishScheduledArticles.php
|   └── Kernel.php
├── http/controllers
|   └── admin
|       └── ArticleController.php
|       └── UserController.php
|   └── writer
|       └── ArticleController.php
|       └── StoriesController.php
|       └── WriteController.php
|   └── ArticleController.php
|   └── AuthController.php
|   └── CommentController.php
|   └── Controller.php
├── models
|   └── Article.php
|   └── Comment.php
|   └── User.php
├── providers
│   └── AppServiceProvider..php
├── database
|   └── factories
|   └── migrations
├── public
|   └── images
|       └── sea.jpg
├── resources
|   └── views
|       └── admin
|           └── homepagea.blade.php
|           └── librarypagea.blade.php
|           └── managementpagea.blade.php
|       └── article
|           └── detail.blade.php
|       └── auth
|           └── login.blade.php
|           └── register.blade.php
|       └── user
|           └── homepageu.blade.php
|           └── librarypageu.blade.php
|       └── writer
|           └── homepagew.blade.php
|           └── librarypagew.blade.php
|           └── storiespagew.blade.php
|           └── writepage.blade.php
|       └── landingpage.blade.php
├── routes
|   └── console.php
|   └── web.php
└── README.md

## Alur KisahOmbak di Notion
https://www.notion.so/Alur-KisahOmbak-2fe7f6e8b7908091947bfe6cb6dd44bf?source=copy_link

## ERD KisahOmbak di draw.io
https://drive.google.com/file/d/1vo1KA8IKScbHvnTrAZbb6fx6SKc4Xu6p/view?usp=drive_link

## UI/UX KisahOmbak di Figma
hhttps://www.figma.com/design/585bRULRsjqQoOjxfSH7NQ/Untitled?node-id=0-1&t=lKViiuXPTWHzdku4-1