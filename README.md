# MyWeb - Personal Website with Games

Một trang web cá nhân được xây dựng bằng Laravel, bao gồm Flappy Bird game và hệ thống quản lý game.

## 🎮 Tính năng

- ✅ Trang chủ với menu điều hướng
- ✅ Trang Giới thiệu (About) - hiển thị thông tin cá nhân
- ✅ Trang Game - danh sách các game
- ✅ Trò chơi Flappy Bird - chơi trực tiếp trên web
- ✅ Hệ thống quản lý game backend
- ✅ API REST để quản lý dữ liệu game
- ✅ Tìm kiếm game realtime

## 📋 Yêu cầu

- **PHP:** 8.0 hoặc cao hơn
- **Composer:** Để cài đặt PHP dependencies
- **Git:** Để clone repository

## 🚀 Hướng dẫn Cài đặt

### Bước 1: Clone Repository

```bash
git clone https://github.com/longnt2002/myweb.git
cd myweb
```

### Bước 2: Cài đặt Dependencies PHP

```bash
composer install
```

### Bước 3: Cấu hình Environment

Copy file `.env.example` thành `.env`:

```bash
cp .env.example .env
```

Tạo Application Key:

```bash
php artisan key:generate
```

### Bước 4: Setup Database

Chạy migrations để tạo tables:

```bash
php artisan migrate
```

Seed dữ liệu mẫu (6 games):

```bash
php artisan db:seed
```

### Bước 5: Chạy Development Server

**Cách 1: Dùng Laravel Artisan**
```bash
php artisan serve
```

**Cách 2: Dùng PHP Built-in Server**
```bash
php -S localhost:8000 -t public
```

Truy cập trang web tại: **http://localhost:8000**

## 📁 Cấu trúc Thư mục

```
myweb/
├── app/
│   ├── Http/Controllers/
│   │   ├── MenuController.php          # Điều hướng trang
│   │   └── Api/GameController.php      # API quản lý game
│   └── Models/
│       └── Game.php                    # Model Game
├── database/
│   ├── migrations/                     # Định nghĩa database schema
│   ├── seeders/                        # Dữ liệu mẫu
│   └── database.sqlite                 # SQLite database file
├── resources/
│   └── views/
│       ├── menu.blade.php             # Trang chủ
│       ├── about.blade.php            # Trang giới thiệu
│       ├── games.blade.php            # Danh sách game
│       ├── projects.blade.php         # Trang dự án
│       └── flappybird.blade.php       # Game Flappy Bird
├── routes/
│   ├── web.php                         # Web routes
│   └── api.php                         # API routes
├── .env.example                        # Template environment
└── README.md                           # File này
```

## 🔌 API Endpoints

### Lấy danh sách tất cả game
```
GET /api/games
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Flappy Bird",
    "description": "Trò chơi Flappy Bird kinh điển...",
    "image": "game1.jpg",
    "link": "/games/flappybird",
    "created_at": "2026-04-11T19:00:44.000000Z",
    "updated_at": "2026-04-11T19:00:44.000000Z"
  }
]
```

### Lấy 1 game cụ thể
```
GET /api/games/{id}
```

### Tạo game mới
```
POST /api/games
Content-Type: application/json

{
  "name": "Game Name",
  "description": "Game Description",
  "image": "game.jpg",
  "link": "/games/example"
}
```

### Cập nhật game
```
PUT /api/games/{id}
Content-Type: application/json

{
  "name": "Updated Name",
  "description": "Updated Description"
}
```

### Xóa game
```
DELETE /api/games/{id}
```

## 🎮 Cách Chơi Flappy Bird

1. Vào trang **Games** → Click vào **Flappy Bird**
2. Click nút **"Bắt Đầu Chơi"** hoặc nhấn **SPACE**
3. Nhấn **SPACE** hoặc **Click chuột** để bay lên
4. Tránh các đường ống, giành phục vụ cao nhất
5. **Điểm cao nhất** được lưu trữ (localStorage)

## 🔧 Troubleshooting

### Lỗi: "No encryption key has been defined"
```bash
php artisan key:generate
```

### Lỗi: "unable to open database file"
```bash
php artisan migrate
```

### Migrations không chạy được
Đảm bảo đã chạy:
```bash
php artisan migrate --force
```

### Database cần reset
```bash
php artisan migrate:refresh --seed
```

## 📝 Tùy chỉnh

### Thay đổi thông tin cá nhân
Chỉnh sửa file `resources/views/about.blade.php`

### Thêm game mới
Dùng Laravel Tinker:
```bash
php artisan tinker

App\Models\Game::create([
    'name' => 'Game Name',
    'description' => 'Description',
    'image' => 'image.jpg',
    'link' => '/games/slug'
]);
```

Hoặc POST tới API:
```bash
curl -X POST http://localhost:8000/api/games \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Game Name",
    "description": "Description",
    "image": "image.jpg",
    "link": "/games/slug"
  }'
```

## 📚 Tài liệu

- [Laravel Documentation](https://laravel.com/docs)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade Template](https://laravel.com/docs/blade)

## 📄 Files quan trọng

- `.env.example` - Template cho cấu hình
- `database/migrations/` - Schema definition
- `database/seeders/DatabaseSeeder.php` - Dữ liệu mẫu
- `routes/web.php` - Web routes
- `routes/api.php` - API routes

## 👨‍💻 Tác giả

**Ngô Tuấn Long**
- Email: longcpvc6@gmail.com
- Phone: 0909459402
- Address: Bình Tiên, Q6, TPHCM
- GitHub: [@longnt2002](https://github.com/longnt2002)

---

**Hãy star ⭐ repository này nếu bạn thích!**

Happy coding! 🚀
