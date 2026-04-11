<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dự Án</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('{{ asset("images/background.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
        }

        nav {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 1rem 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            color: #fff;
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .menu {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .menu-item {
            position: relative;
        }

        .menu-item > a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .menu-item > a:hover {
            background-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
        }

        .menu-item a i {
            font-size: 1.1rem;
        }

        .content {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .content h1 {
            color: #333;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }

        .content p {
            color: #666;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .hero {
            text-align: center;
            padding: 3rem;
        }

        .hero .page-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .menu {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .content {
                margin: 1rem;
            }

            .content h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav-container">
            <a href="/" class="logo">
                <i class="fas fa-bars"></i>
                My Website
            </a>
            <ul class="menu">
                @foreach($menuItems as $item)
                    <li class="menu-item">
                        <a href="{{ $item['url'] }}" title="{{ $item['name'] }}">
                            <i class="fas {{ $item['icon'] }}"></i>
                            {{ $item['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    <div class="content">
        <div class="hero">
            <div class="page-icon">
                <i class="fas fa-project-diagram"></i>
            </div>
            <h1>Dự Án</h1>
            <p>Đây là trang Dự Án. Thêm danh sách các dự án của bạn ở đây.</p>
        </div>
    </div>
</body>
</html>
