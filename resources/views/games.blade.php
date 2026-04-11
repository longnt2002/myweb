<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trò Chơi</title>
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

        .search-container {
            margin-bottom: 2rem;
            text-align: center;
        }

        .search-input {
            width: 100%;
            max-width: 500px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            border: 2px solid #ddd;
            border-radius: 25px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .search-input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .games-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .game-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .game-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .game-card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-color: #f0f0f0;
        }

        .game-card-info {
            padding: 1rem;
        }

        .game-card-title {
            color: #333;
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
        }

        .game-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
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

            .games-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
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
        <!-- Thanh tìm kiếm -->
        <div class="search-container">
            <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm trò chơi...">
        </div>

        <!-- Lưới các trò chơi -->
        <div class="games-grid" id="gamesContainer">
            <!-- Games được tải từ API -->
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const gamesContainer = document.getElementById('gamesContainer');
        let allGames = [];

        // Lấy danh sách games từ API
        async function loadGames() {
            try {
                const response = await fetch('/api/games');
                const games = await response.json();
                // Lọc chỉ lấy games có link thực tế
                allGames = games.filter(game => game.link && game.link !== '#');
                displayGames(allGames);
            } catch (error) {
                console.error('Error loading games:', error);
                gamesContainer.innerHTML = '<p style="color: red;">Lỗi tải danh sách trò chơi</p>';
            }
        }

        // Hiển thị danh sách games
        function displayGames(games) {
            gamesContainer.innerHTML = '';
            games.forEach(game => {
                // Chỉ hiển thị game có link thực tế (không phải "#")
                if (!game.link || game.link === '#') {
                    return;
                }

                const gameCard = document.createElement('a');
                gameCard.href = game.link;
                gameCard.className = 'game-card-link game-item';
                gameCard.setAttribute('data-game-name', game.name.toLowerCase());
                gameCard.innerHTML = `
                    <div class="game-card">
                        <img src="{{ asset('images') }}/${game.image}" alt="${game.name}" class="game-card-image" onerror="this.src='https://via.placeholder.com/200x200?text=${encodeURIComponent(game.name)}'">
                        <div class="game-card-info">
                            <p class="game-card-title">${game.name}</p>
                            <p style="color: #666; font-size: 0.9rem; margin-top: 0.5rem;">${game.description || 'Không có mô tả'}</p>
                        </div>
                    </div>
                `;
                gamesContainer.appendChild(gameCard);
            });
        }

        // Tìm kiếm games
        searchInput.addEventListener('keyup', () => {
            const searchValue = searchInput.value.toLowerCase();
            const filteredGames = allGames.filter(game => 
                (game.link && game.link !== '#') &&
                (game.name.toLowerCase().includes(searchValue) || 
                (game.description && game.description.toLowerCase().includes(searchValue)))
            );
            displayGames(filteredGames);
        });

        // Tải games khi trang load
        document.addEventListener('DOMContentLoaded', loadGames);
    </script>
