<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dò Mìn - Minesweeper</title>
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
            display: flex;
            gap: 2rem;
            max-width: 1200px;
            width: 100%;
        }

        .game-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
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
            font-size: 2.2rem;
        }

        .controls {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 1rem;
            flex-wrap: wrap;
            width: 100%;
        }

        .difficulty-selector, .btn {
            padding: 0.6rem 1.2rem;
            font-size: 0.95rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .difficulty-selector {
            background: #f0f0f0;
            border: 2px solid #667eea;
            color: #333;
        }

        .difficulty-selector:hover {
            background: #e8e8e8;
        }

        .btn {
            background: #667eea;
            color: white;
        }

        .btn:hover {
            background: #5568d3;
            transform: scale(1.05);
        }

        .btn:active {
            transform: scale(0.98);
        }

        .game-info {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.8rem;
            background: #f8f9fa;
            border-radius: 8px;
            flex-wrap: wrap;
            gap: 0.8rem;
            width: 100%;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.95rem;
            color: #333;
        }

        .info-label {
            font-weight: 600;
            color: #667eea;
        }

        #gameBoard {
            display: inline-grid;
            gap: 2px;
            padding: 0.8rem;
            background: #ccc;
            border-radius: 8px;
            margin: 0.5rem 0;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .cell {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #bfbfbf;
            border: 1px solid #888;
            cursor: pointer;
            font-weight: bold;
            font-size: 0.85rem;
            user-select: none;
            transition: all 0.1s ease;
        }

        .cell:hover {
            background: #d3d3d3;
        }

        .cell.revealed {
            background: #ddd;
            border: 1px solid #999;
            cursor: default;
        }

        .cell.revealed:hover {
            background: #ddd;
        }

        .cell.flagged {
            background: #e74c3c;
            color: white;
        }

        .cell.mine {
            background: #c0392b;
            color: white;
        }

        .cell.safe {
            background: #ecf0f1;
        }

        .cell-0 { color: #999; }
        .cell-1 { color: #0041e3; }
        .cell-2 { color: #088208; }
        .cell-3 { color: #e41e3f; }
        .cell-4 { color: #080141; }
        .cell-5 { color: #820400; }
        .cell-6 { color: #099268; }
        .cell-7 { color: #000; }
        .cell-8 { color: #808080; }

        .game-status {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            margin-top: 0.5rem;
            min-height: 1.5rem;
        }

        .game-status.win {
            color: #27ae60;
        }

        .game-status.lose {
            color: #e74c3c;
        }

        .instructions {
            flex: 1;
            padding: 1.5rem;
            background: #f0f0f0;
            border-radius: 8px;
            text-align: left;
            max-height: 400px;
            overflow-y: auto;
        }

        .instructions h3 {
            color: #333;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .instructions ul {
            list-style: none;
            color: #666;
            font-size: 0.9rem;
        }

        .instructions li {
            margin-bottom: 0.6rem;
            padding-left: 1.5rem;
            position: relative;
            line-height: 1.4;
        }

        .instructions li:before {
            content: "→";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
        }

        @media (max-width: 1024px) {
            .game-content {
                flex-direction: column;
                gap: 1.5rem;
                padding: 1.5rem;
            }

            .instructions {
                max-height: none;
            }
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
                margin: 1rem;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem;
            }

            .game-title {
                font-size: 1.5rem;
            }

            .cell {
                width: 24px;
                height: 24px;
                font-size: 0.75rem;
            }

            .controls {
                flex-direction: column;
            }

            .difficulty-selector, .btn {
                width: 100%;
                padding: 0.5rem 1rem;
            }

            .game-info {
                flex-direction: column;
            }

            .instructions {
                max-height: 300px;
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
                <li class="menu-item">
                    <a href="/" title="Trang Chủ">
                        <i class="fas fa-home"></i>
                        Trang Chủ
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/games" title="Trò Chơi">
                        <i class="fas fa-gamepad"></i>
                        Trò Chơi
                    </a>
                </li>
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
                <li class="menu-item">
                    <a href="/projects" title="Dự Án">
                        <i class="fas fa-project-diagram"></i>
                        Dự Án
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/about" title="Giới Thiệu">
                        <i class="fas fa-info-circle"></i>
                        Giới Thiệu
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="game-container">
        <div class="game-content">
            <div class="game-wrapper">
                <div class="game-title">
                    <i class="fas fa-bomb"></i>
                    Dò Mìn
                </div>

                <div class="controls">
                    <select id="difficultySelector" class="difficulty-selector">
                        <option value="easy">Dễ (8x8, 10 mìn)</option>
                        <option value="normal" selected>Bình thường (12x12, 30 mìn)</option>
                        <option value="hard">Khó (16x16, 99 mìn)</option>
                    </select>
                    <button class="btn" onclick="initGame()">
                        <i class="fas fa-redo"></i> Trò Chơi Mới
                    </button>
                </div>

                <div class="game-info">
                    <div class="info-item">
                        <span class="info-label">Mìn:</span>
                        <span id="minesCount">30</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Đã Đánh Dấu:</span>
                        <span id="flagCount">0</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Thời Gian:</span>
                        <span id="timerDisplay">0s</span>
                    </div>
                </div>

                <div id="gameBoard"></div>

                <div class="game-status" id="gameStatus"></div>
            </div>

            <div class="instructions">
                <h3>Cách Chơi:</h3>
                <ul>
                    <li><strong>Click trái:</strong> Mở một ô</li>
                    <li><strong>Click phải:</strong> Đánh dấu mìn (🚩)</li>
                    <li>Các con số cho biết số mìn xung quanh ô đó</li>
                    <li>Mở tất cả ô không có mìn để thắng</li>
                    <li>Nếu mở phải ô có mìn, bạn sẽ thua</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Game variables
        let board = [];
        let revealed = [];
        let flagged = [];
        let gameOver = false;
        let gameWon = false;
        let gameStarted = false;
        let mines = 0;
        let rows = 0;
        let cols = 0;
        let timer = 0;
        let timerInterval = null;

        const difficulties = {
            easy: { rows: 8, cols: 8, mines: 10 },
            normal: { rows: 12, cols: 12, mines: 30 },
            hard: { rows: 16, cols: 16, mines: 99 }
        };

        // Initialize game
        function initGame() {
            const difficulty = document.getElementById('difficultySelector').value;
            const config = difficulties[difficulty];
            
            rows = config.rows;
            cols = config.cols;
            mines = config.mines;
            
            board = [];
            revealed = [];
            flagged = [];
            gameOver = false;
            gameWon = false;
            gameStarted = false;
            timer = 0;
            
            clearInterval(timerInterval);
            document.getElementById('timerDisplay').textContent = '0s';
            document.getElementById('minesCount').textContent = mines;
            document.getElementById('flagCount').textContent = '0';
            document.getElementById('gameStatus').textContent = '';
            document.getElementById('gameStatus').className = '';
            
            // Initialize arrays
            for (let i = 0; i < rows; i++) {
                board[i] = [];
                revealed[i] = [];
                flagged[i] = [];
                for (let j = 0; j < cols; j++) {
                    board[i][j] = 0;
                    revealed[i][j] = false;
                    flagged[i][j] = false;
                }
            }
            
            // Place mines randomly
            let minesPlaced = 0;
            while (minesPlaced < mines) {
                const row = Math.floor(Math.random() * rows);
                const col = Math.floor(Math.random() * cols);
                
                if (board[row][col] !== 'M') {
                    board[row][col] = 'M';
                    minesPlaced++;
                }
            }
            
            // Calculate numbers
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < cols; j++) {
                    if (board[i][j] !== 'M') {
                        board[i][j] = countAdjacentMines(i, j);
                    }
                }
            }
            
            renderBoard();
        }

        function countAdjacentMines(row, col) {
            let count = 0;
            for (let i = -1; i <= 1; i++) {
                for (let j = -1; j <= 1; j++) {
                    const newRow = row + i;
                    const newCol = col + j;
                    if (newRow >= 0 && newRow < rows && newCol >= 0 && newCol < cols) {
                        if (board[newRow][newCol] === 'M') {
                            count++;
                        }
                    }
                }
            }
            return count;
        }

        function renderBoard() {
            const gameBoard = document.getElementById('gameBoard');
            gameBoard.innerHTML = '';
            gameBoard.style.gridTemplateColumns = `repeat(${cols}, 30px)`;
            
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < cols; j++) {
                    const cell = document.createElement('div');
                    cell.className = 'cell';
                    cell.id = `cell-${i}-${j}`;
                    
                    if (revealed[i][j]) {
                        cell.classList.add('revealed');
                        if (board[i][j] === 'M') {
                            cell.classList.add('mine');
                            cell.textContent = '💣';
                        } else if (board[i][j] > 0) {
                            cell.classList.add(`cell-${board[i][j]}`);
                            cell.textContent = board[i][j];
                        } else {
                            cell.classList.add('safe');
                        }
                    } else if (flagged[i][j]) {
                        cell.classList.add('flagged');
                        cell.textContent = '🚩';
                    }
                    
                    cell.addEventListener('click', () => revealCell(i, j));
                    cell.addEventListener('contextmenu', (e) => {
                        e.preventDefault();
                        flagCell(i, j);
                    });
                    
                    gameBoard.appendChild(cell);
                }
            }
        }

        function revealCell(row, col) {
            if (gameOver || gameWon || revealed[row][col] || flagged[row][col]) {
                return;
            }
            
            if (!gameStarted) {
                gameStarted = true;
                startTimer();
            }
            
            revealed[row][col] = true;
            
            if (board[row][col] === 'M') {
                gameOver = true;
                revealAllMines();
                document.getElementById('gameStatus').textContent = '💥 GAME OVER! Bạn thua rồi!';
                document.getElementById('gameStatus').classList.add('lose');
                return;
            }
            
            if (board[row][col] === 0) {
                floodFill(row, col);
            }
            
            checkWin();
            renderBoard();
        }

        function floodFill(row, col) {
            for (let i = -1; i <= 1; i++) {
                for (let j = -1; j <= 1; j++) {
                    const newRow = row + i;
                    const newCol = col + j;
                    if (newRow >= 0 && newRow < rows && newCol >= 0 && newCol < cols) {
                        if (!revealed[newRow][newCol] && !flagged[newRow][newCol]) {
                            revealed[newRow][newCol] = true;
                            if (board[newRow][newCol] === 0) {
                                floodFill(newRow, newCol);
                            }
                        }
                    }
                }
            }
        }

        function flagCell(row, col) {
            if (gameOver || gameWon || revealed[row][col]) {
                return;
            }
            
            flagged[row][col] = !flagged[row][col];
            
            let flagCount = 0;
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < cols; j++) {
                    if (flagged[i][j]) flagCount++;
                }
            }
            
            document.getElementById('flagCount').textContent = flagCount;
            renderBoard();
        }

        function revealAllMines() {
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < cols; j++) {
                    if (board[i][j] === 'M') {
                        revealed[i][j] = true;
                    }
                }
            }
            renderBoard();
        }

        function checkWin() {
            let unrevealed = 0;
            for (let i = 0; i < rows; i++) {
                for (let j = 0; j < cols; j++) {
                    if (!revealed[i][j] && board[i][j] !== 'M') {
                        unrevealed++;
                    }
                }
            }
            
            if (unrevealed === 0) {
                gameWon = true;
                clearInterval(timerInterval);
                document.getElementById('gameStatus').textContent = '🎉 THẮNG! Chúc mừng bạn!';
                document.getElementById('gameStatus').classList.add('win');
            }
        }

        function startTimer() {
            timerInterval = setInterval(() => {
                timer++;
                document.getElementById('timerDisplay').textContent = timer + 's';
            }, 1000);
        }

        // Start the game on page load
        document.addEventListener('DOMContentLoaded', initGame);
    </script>
</body>
</html>
