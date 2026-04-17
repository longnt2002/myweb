<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flappy Bird</title>
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
            display: flex;
            flex-direction: column;
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

        /* Submenu styles */
        .submenu {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: rgba(0, 0, 0, 0.95);
            list-style: none;
            min-width: 200px;
            border-radius: 4px;
            margin-top: 0.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            transform: translateY(-10px);
        }

        .menu-item:hover .submenu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .submenu li {
            margin: 0;
        }

        .submenu li a {
            display: flex !important;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.2rem !important;
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 400;
            border-radius: 0;
        }

        .submenu li a:hover {
            background-color: #667eea;
            padding-left: 1.8rem !important;
        }

        .submenu li:first-child a {
            border-radius: 4px 4px 0 0;
        }

        .submenu li:last-child a {
            border-radius: 0 0 4px 4px;
        }

        .game-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .game-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        .game-title {
            color: #333;
            font-size: 2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .game-title i {
            color: #667eea;
        }

        #gameCanvas {
            border: 3px solid #667eea;
            border-radius: 8px;
            background-color: #87ceeb;
            display: block;
            max-width: 100%;
        }

        .canvas-container {
            position: relative;
            display: block;
            width: fit-content;
            margin: 1rem auto;
        }

        .game-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
            font-size: 1.1rem;
            color: #333;
        }

        .score-display {
            font-weight: bold;
            color: #667eea;
        }

        .game-instructions {
            margin-top: 1rem;
            padding: 1rem;
            background: #f0f0f0;
            border-radius: 4px;
            color: #666;
        }

        .game-instructions p {
            margin: 0.5rem 0;
        }

        .btn-back {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.75rem 1.5rem;
            background-color: #667eea;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #764ba2;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.4);
        }

        #startScreen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
            border-radius: 8px;
        }

        .start-content {
            text-align: center;
            color: #fff;
        }

        .start-content h2 {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #87ceeb;
        }

        .start-content p {
            font-size: 1.1rem;
            margin: 0.8rem 0;
            line-height: 1.6;
        }

        .btn-start {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 1rem 2rem;
            background-color: #667eea;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-start:hover {
            background-color: #764ba2;
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(102, 126, 234, 0.4);
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

            .game-content {
                padding: 1rem;
            }

            .game-title {
                font-size: 1.5rem;
            }

            #gameCanvas {
                max-width: 100%;
                height: auto;
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
                <!-- Tiện ích submenu -->
                <li class="menu-item">
                    <a href="#" title="Tiện ích">
                        <i class="fas fa-toolbox"></i>
                        Tiện ích
                        <i class="fas fa-chevron-down" style="font-size: 0.8rem; margin-left: 0.3rem;"></i>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="/paint" title="Ứng dụng vẽ">
                                <i class="fas fa-palette"></i>
                                Ứng Dụng Vẽ
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="game-container">
        <div class="game-content">
            <h1 class="game-title">
                <i class="fas fa-dove"></i>
                Flappy Bird
            </h1>

            <div class="game-info">
                <div>Score: <span class="score-display" id="score">0</span></div>
                <div>Best: <span class="score-display" id="bestScore">0</span></div>
            </div>

            <div class="canvas-container">
                <canvas id="gameCanvas" width="750" height="450"></canvas>

                <!-- Màn hình chờ bắt đầu -->
                <div id="startScreen">
                    <div class="start-content">
                        <h2>🐦 Flappy Bird 🐦</h2>
                        <p><strong>Hướng dẫn chơi:</strong></p>
                        <p>👆 Nhấn <strong>SPACE / CLICK</strong> để chim bay lên</p>
                        <p>⚠️ Tránh va chạm với các ống nước</p>
                        <p>🎯 Mỗi ống qua được = 1 điểm</p>
                        <button class="btn-start" onclick="startGame()">Bắt Đầu Chơi</button>
                    </div>
                </div>
            </div>

            <a href="/games" class="btn-back">
                <i class="fas fa-arrow-left"></i> Quay lại Trò Chơi
            </a>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        // Game variables
        let birdY = canvas.height / 2;
        let birdX = 50;
        let birdRadius = 15;
        let birdVelocity = 0;
        let gravity = 0.3;
        let jumpPower = 6;

        let score = 0;
        let bestScore = localStorage.getItem('flappyBirdBest') || 0;
        document.getElementById('bestScore').textContent = bestScore;

        let gameRunning = false;
        let gameStarted = false;
        let pipes = [];
        let pipeGap = 130;
        let pipeWidth = 50;
        let pipeFrequency = 100;
        let pipeCounter = 0;

        // Hàm bắt đầu game
        function startGame() {
            document.getElementById('startScreen').style.display = 'none';
            gameRunning = true;
            gameStarted = true;
        }

        // Mouse and keyboard controls
        document.addEventListener('keydown', (e) => {
            if (!gameStarted && e.code === 'Space') {
                startGame();
                e.preventDefault();
            } else if (gameStarted && e.code === 'Space') {
                if (gameRunning) {
                    birdVelocity = -jumpPower;
                } else {
                    resetGame();
                }
                e.preventDefault();
            }
        });

        canvas.addEventListener('click', () => {
            if (!gameStarted) {
                startGame();
            } else if (gameRunning) {
                birdVelocity = -jumpPower;
            } else {
                resetGame();
            }
        });

        function resetGame() {
            birdY = canvas.height / 2;
            birdVelocity = 0;
            score = 0;
            pipes = [];
            gameRunning = true;
            document.getElementById('score').textContent = score;
        }

        function drawBird() {
            // Bird body
            ctx.fillStyle = '#FFD700';
            ctx.beginPath();
            ctx.arc(birdX, birdY, birdRadius, 0, Math.PI * 2);
            ctx.fill();

            // Bird eye
            ctx.fillStyle = '#000';
            ctx.beginPath();
            ctx.arc(birdX + 5, birdY - 5, 4, 0, Math.PI * 2);
            ctx.fill();

            // Bird beak
            ctx.fillStyle = '#FF6B35';
            ctx.beginPath();
            ctx.moveTo(birdX + 10, birdY);
            ctx.lineTo(birdX + 20, birdY - 3);
            ctx.lineTo(birdX + 20, birdY + 3);
            ctx.fill();
        }

        function drawPipes() {
            ctx.fillStyle = '#228B22';

            pipes.forEach(pipe => {
                // Top pipe
                ctx.fillRect(pipe.x, 0, pipeWidth, pipe.topHeight);

                // Bottom pipe
                ctx.fillRect(pipe.x, pipe.topHeight + pipeGap, pipeWidth, canvas.height - pipe.topHeight - pipeGap);
            });
        }

        function updatePipes() {
            pipeCounter++;

            if (pipeCounter > pipeFrequency) {
                let topHeight = Math.random() * (canvas.height - pipeGap - 50) + 20;
                pipes.push({
                    x: canvas.width,
                    topHeight: topHeight
                });
                pipeCounter = 0;
            }

            pipes.forEach((pipe, index) => {
                pipe.x -= 2;

                // Remove off-screen pipes
                if (pipe.x + pipeWidth < 0) {
                    pipes.splice(index, 1);
                    score++;
                    document.getElementById('score').textContent = score;
                }

                // Collision detection
                if (
                    birdX + birdRadius > pipe.x &&
                    birdX - birdRadius < pipe.x + pipeWidth
                ) {
                    if (
                        birdY - birdRadius < pipe.topHeight ||
                        birdY + birdRadius > pipe.topHeight + pipeGap
                    ) {
                        gameOver();
                    }
                }
            });
        }

        function gameOver() {
            gameRunning = false;
            if (score > bestScore) {
                bestScore = score;
                localStorage.setItem('flappyBirdBest', bestScore);
                document.getElementById('bestScore').textContent = bestScore;
            }
        }

        function update() {
            if (gameRunning) {
                birdVelocity += gravity;
                birdY += birdVelocity;

                // Boundary collision
                if (birdY - birdRadius < 0 || birdY + birdRadius > canvas.height) {
                    gameOver();
                }

                updatePipes();
            }
        }

        function draw() {
            // Sky background
            ctx.fillStyle = '#87ceeb';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Ground
            ctx.fillStyle = '#8B7355';
            ctx.fillRect(0, canvas.height - 30, canvas.width, 30);

            drawPipes();
            drawBird();

            // Game over message
            if (!gameRunning) {
                ctx.fillStyle = 'rgba(0, 0, 0, 0.7)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = '#FFF';
                ctx.font = 'bold 40px Arial';
                ctx.textAlign = 'center';
                ctx.fillText('GAME OVER', canvas.width / 2, canvas.height / 2 - 20);

                ctx.font = '20px Arial';
                ctx.fillText(`Score: ${score}`, canvas.width / 2, canvas.height / 2 + 30);
                ctx.fillText('Click để chơi lại', canvas.width / 2, canvas.height / 2 + 70);
            }
        }

        function gameLoop() {
            update();
            draw();
            requestAnimationFrame(gameLoop);
        }

        gameLoop();
    </script>
</body>
</html>
