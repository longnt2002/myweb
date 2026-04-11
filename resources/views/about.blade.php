<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Về Tôi</title>
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

        .profile-image {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            margin: 1rem auto;
            border: 4px solid #667eea;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .profile-subtitle {
            color: #666;
            font-size: 1rem;
            margin-top: 1rem;
            font-style: italic;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile-container {
            display: flex;
            gap: 3rem;
            align-items: flex-start;
        }

        .profile-image-section {
            flex: 0 0 250px;
            text-align: center;
        }

        .profile-info-section {
            flex: 1;
        }

        .info-item {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .info-item i {
            font-size: 1.5rem;
            color: #667eea;
            width: 2rem;
            text-align: center;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            color: #999;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .info-value {
            color: #333;
            font-size: 1.1rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .profile-container {
                flex-direction: column;
                gap: 2rem;
            }

            .profile-image-section {
                flex: 0 0 auto;
            }

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
        <div class="profile-container">
            <!-- Phần ảnh bên trái -->
            <div class="profile-image-section">
                <img src="{{ asset('images/avatar.jpg') }}" alt="Ảnh của tôi" class="profile-image">
                <p class="profile-subtitle">Tốt nghiệp SGU - ngành Công nghệ thông tin</p>
            </div>

            <!-- Phần thông tin tịnh bên phải -->
            <div class="profile-info-section">
                <h1>Thông Tin Cá Nhân</h1>

                <div class="info-item">
                    <i class="fas fa-user"></i>
                    <div class="info-content">
                        <div class="info-label">Họ và Tên</div>
                        <div class="info-value">Ngô Tuấn Long</div>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <div class="info-content">
                        <div class="info-label">Email</div>
                        <div class="info-value"><a href="mailto:longcpvc6@gmail.com" style="color: #667eea; text-decoration: none;">longcpvc6@gmail.com</a></div>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <div class="info-content">
                        <div class="info-label">Số Điện Thoại</div>
                        <div class="info-value"><a href="tel:0909459402" style="color: #667eea; text-decoration: none;">0909459402</a></div>
                    </div>
                </div>

                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="info-content">
                        <div class="info-label">Địa Chỉ</div>
                        <div class="info-value">Bình Tiên, Quận 6, TP.HCM</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
