<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng Dụng Vẽ</title>
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
            max-width: 1400px;
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

        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .header h1 i {
            color: #667eea;
        }

        .header p {
            color: #666;
            font-size: 1rem;
        }

        .content {
            display: flex;
            gap: 2rem;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            flex: 1;
        }

        .canvas-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        canvas {
            border: 3px solid #667eea;
            border-radius: 8px;
            background: white;
            cursor: crosshair;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            max-height: 600px;
            width: 100%;
            aspect-ratio: 4/3;
        }

        .controls-section {
            width: 250px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .control-group {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .control-group label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
        }

        .control-group p {
            color: #666;
            font-size: 0.85rem;
            margin-bottom: 0.8rem;
        }

        /* Color picker */
        #colorPicker {
            width: 100%;
            height: 50px;
            border: 2px solid #667eea;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Brush size slider */
        #brushSize {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #ddd;
            outline: none;
            -webkit-appearance: none;
        }

        #brushSize::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #667eea;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        #brushSize::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #667eea;
            cursor: pointer;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .size-display {
            text-align: center;
            color: #667eea;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        /* Buttons */
        .btn-group {
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }

        button {
            padding: 0.8rem;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.3);
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(39, 174, 96, 0.3);
        }

        .btn-secondary {
            background: #95a5a6;
            color: white;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
            transform: translateY(-2px);
        }

        button:active {
            transform: scale(0.98);
        }

        /* Eraser toggle */
        .eraser-toggle {
            background: #f0f0f0;
            border: 2px solid #667eea;
            color: #333;
            padding: 0.8rem;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .eraser-toggle.active {
            background: #667eea;
            color: white;
        }

        .eraser-toggle:hover {
            transform: translateY(-2px);
        }

        /* Preset colors */
        .color-presets {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
        }

        .color-preset {
            width: 100%;
            height: 40px;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .color-preset:hover {
            transform: scale(1.1);
            border-color: #333;
        }

        /* Tool selector */
        .tool-selector {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .tool-btn {
            background: #f0f0f0;
            border: 2px solid #ddd;
            color: #333;
            padding: 0.6rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .tool-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .tool-btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 1024px) {
            .content {
                flex-direction: column;
                gap: 1.5rem;
            }

            .controls-section {
                width: 100%;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1rem;
            }

            canvas {
                max-width: 100%;
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

            .container {
                padding: 1rem;
            }

            .content {
                flex-direction: column;
                padding: 1rem;
            }

            .header h1 {
                font-size: 1.8rem;
            }

            canvas {
                aspect-ratio: auto;
                height: 400px;
            }

            .controls-section {
                width: 100%;
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
                <li class="menu-item">
                    <a href="/projects" title="Dự Án">
                        <i class="fas fa-project-diagram"></i>
                        Dự Án
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/about" title="Giới Thiệu">
                        <i class="fas fa-info-circle"></i>
                        Về tôi
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
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="header">
            <h1>
                <i class="fas fa-palette"></i>
                Ứng Dụng Vẽ
            </h1>
            <p>Vẽ và sáng tạo trên canvas của bạn</p>
        </div>

        <div class="content">
            <div class="canvas-section">
                <canvas id="drawingCanvas"></canvas>
            </div>

            <div class="controls-section">
                <!-- Color Picker -->
                <div class="control-group">
                    <label for="colorPicker">
                        <i class="fas fa-palette"></i> Màu Sắc
                    </label>
                    <input type="color" id="colorPicker" value="#000000">
                </div>

                <!-- Brush Size -->
                <div class="control-group">
                    <label for="brushSize">
                        <i class="fas fa-pen"></i> Độ Rộng Bút
                    </label>
                    <input type="range" id="brushSize" min="1" max="50" value="3">
                    <div class="size-display"><span id="sizeValue">3</span>px</div>
                </div>

                <!-- Tools -->
                <div class="control-group">
                    <label><i class="fas fa-tools"></i> Công Cụ</label>
                    <div class="tool-selector">
                        <button class="tool-btn active" onclick="selectTool('pen')">
                            <i class="fas fa-pen"></i> Bút
                        </button>
                        <button class="tool-btn" onclick="selectTool('eraser')">
                            <i class="fas fa-eraser"></i> Tẩy
                        </button>
                        <button class="tool-btn" onclick="selectTool('line')">
                            <i class="fas fa-minus"></i> Đường
                        </button>
                        <button class="tool-btn" onclick="selectTool('circle')">
                            <i class="fas fa-circle"></i> Hình Tròn
                        </button>
                        <button class="tool-btn" onclick="selectTool('rectangle')">
                            <i class="fas fa-square"></i> Hình Vuông
                        </button>
                    </div>
                </div>

                <!-- Preset Colors -->
                <div class="control-group">
                    <label><i class="fas fa-swatches"></i> Màu Nhanh</label>
                    <div class="color-presets">
                        <div class="color-preset" style="background: #000000;" onclick="setColor('#000000')"></div>
                        <div class="color-preset" style="background: #FF0000;" onclick="setColor('#FF0000')"></div>
                        <div class="color-preset" style="background: #0000FF;" onclick="setColor('#0000FF')"></div>
                        <div class="color-preset" style="background: #00AA00;" onclick="setColor('#00AA00')"></div>
                        <div class="color-preset" style="background: #FFFF00;" onclick="setColor('#FFFF00')"></div>
                        <div class="color-preset" style="background: #FF00FF;" onclick="setColor('#FF00FF')"></div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="control-group">
                    <div class="btn-group">
                        <button class="btn-primary" onclick="undoDrawing()">
                            <i class="fas fa-undo"></i> Hoàn Tác
                        </button>
                        <button class="btn-danger" onclick="clearCanvas()">
                            <i class="fas fa-trash"></i> Xóa Tất Cả
                        </button>
                        <button class="btn-success" onclick="downloadImage()">
                            <i class="fas fa-download"></i> Tải Xuống
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const canvas = document.getElementById('drawingCanvas');
        const ctx = canvas.getContext('2d');
        const colorPicker = document.getElementById('colorPicker');
        const brushSize = document.getElementById('brushSize');
        const sizeValue = document.getElementById('sizeValue');

        let isDrawing = false;
        let lastX = 0;
        let lastY = 0;
        let currentTool = 'pen';
        let history = [];

        // Set canvas size
        function resizeCanvas() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }

        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        // Update brush size display
        brushSize.addEventListener('input', (e) => {
            sizeValue.textContent = e.target.value;
        });

        // Update color picker value
        colorPicker.addEventListener('change', (e) => {
            if (currentTool === 'eraser') {
                selectTool('pen');
            }
        });

        // Save canvas state
        function saveState() {
            history.push(canvas.toDataURL());
        }

        // Undo
        function undoDrawing() {
            if (history.length > 0) {
                history.pop();
                if (history.length > 0) {
                    const img = new Image();
                    img.src = history[history.length - 1];
                    img.onload = () => {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0);
                    };
                } else {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                }
            }
        }

        // Clear canvas
        function clearCanvas() {
            if (confirm('Bạn có chắc muốn xóa tất cả vẽ không?')) {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                history = [];
            }
        }

        // Download image
        function downloadImage() {
            const link = document.createElement('a');
            link.href = canvas.toDataURL('image/png');
            link.download = 'drawing-' + new Date().getTime() + '.png';
            link.click();
        }

        // Select tool
        function selectTool(tool) {
            currentTool = tool;
            document.querySelectorAll('.tool-btn').forEach(btn => btn.classList.remove('active'));
            event.target.closest('.tool-btn').classList.add('active');
        }

        // Set color
        function setColor(color) {
            colorPicker.value = color;
            if (currentTool === 'eraser') {
                selectTool('pen');
            }
        }

        // Mouse events
        canvas.addEventListener('mousedown', (e) => {
            isDrawing = true;
            const rect = canvas.getBoundingClientRect();
            lastX = e.clientX - rect.left;
            lastY = e.clientY - rect.top;
            saveState();
        });

        canvas.addEventListener('mousemove', (e) => {
            if (!isDrawing) return;

            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            ctx.strokeStyle = currentTool === 'eraser' ? '#FFFFFF' : colorPicker.value;
            ctx.fillStyle = currentTool === 'eraser' ? '#FFFFFF' : colorPicker.value;
            ctx.lineWidth = brushSize.value;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            if (currentTool === 'pen' || currentTool === 'eraser') {
                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(x, y);
                ctx.stroke();
            } else if (currentTool === 'line') {
                // Preview line (redraw from saved state)
                const img = new Image();
                img.src = history[history.length - 1];
                img.onload = () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                    ctx.beginPath();
                    ctx.moveTo(lastX, lastY);
                    ctx.lineTo(x, y);
                    ctx.stroke();
                };
            } else if (currentTool === 'circle') {
                const radius = Math.sqrt(Math.pow(x - lastX, 2) + Math.pow(y - lastY, 2));
                const img = new Image();
                img.src = history[history.length - 1];
                img.onload = () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                    ctx.beginPath();
                    ctx.arc(lastX, lastY, radius, 0, 2 * Math.PI);
                    ctx.stroke();
                };
            } else if (currentTool === 'rectangle') {
                const img = new Image();
                img.src = history[history.length - 1];
                img.onload = () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                    ctx.strokeRect(lastX, lastY, x - lastX, y - lastY);
                };
            }
        });

        canvas.addEventListener('mouseup', () => {
            isDrawing = false;
        });

        canvas.addEventListener('mouseout', () => {
            isDrawing = false;
        });

        // Touch events for mobile
        canvas.addEventListener('touchstart', (e) => {
            e.preventDefault();
            const touch = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            const mouseEvent = new MouseEvent('mousedown', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        });

        canvas.addEventListener('touchmove', (e) => {
            e.preventDefault();
            const touch = e.touches[0];
            const rect = canvas.getBoundingClientRect();
            const mouseEvent = new MouseEvent('mousemove', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        });

        canvas.addEventListener('touchend', (e) => {
            e.preventDefault();
            const mouseEvent = new MouseEvent('mouseup', {});
            canvas.dispatchEvent(mouseEvent);
        });

        // Initialize
        saveState();
    </script>
</body>
</html>
