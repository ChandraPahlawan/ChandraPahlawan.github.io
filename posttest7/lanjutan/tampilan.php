<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pilihan dengan Dark Mode</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            transition: background 0.3s ease, color 0.3s ease;
        }
        .container {
            text-align: flex;
            width: 100%;
            max-width: 800px;
            padding: 2rem;
        }
        h1 {
            color: #333;
            margin-bottom: 2rem;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .menu-item {
            background-color: #fff;
            color: #333;
            padding: 1rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .menu-item:hover {
            background-color: #4CAF50;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }
        .dark-mode-toggle {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background-color: #333;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .dark-mode-toggle:hover {
            background-color: #555;
        }
        body.dark-mode {
            background: linear-gradient(135deg, #2c3e50 0%, #1a2a3a 100%);
            color: #f5f5f5;
        }
        body.dark-mode h1 {
            color: #f5f5f5;
        }
        body.dark-mode .menu-item {
            background-color: #2c3e50;
            color: #f5f5f5;
        }
        body.dark-mode .menu-item:hover {
            background-color: #4CAF50;
        }
        body.dark-mode .dark-mode-toggle {
            background-color: #f5f5f5;
            color: #333;
        }
        body.dark-mode .dark-mode-toggle:hover {
            background-color: #e0e0e0;
        }
        @media (min-width: 768px) {
            .menu {
                flex-direction: row;
            }
        }
    </style>
</head>
<body>
    <button class="dark-mode-toggle" onclick="toggleDarkMode()">Dark Mode</button>
    <div class="container">
        <h1>Selamat Datang Ciee Mau Liburan</h1>
        <div class="menu">
            <a href="login.php" class="menu-item">Booking</a>
            <a href="jadwal.php" class="menu-item">Lihat Jadwal</a>
            <a href="../index.php" class="menu-item">Kembali</a>
        </div>
    </div>
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
            const button = document.querySelector('.dark-mode-toggle');
            if (document.body.classList.contains('dark-mode')) {
                button.textContent = 'Light Mode';
            } else {
                button.textContent = 'Dark Mode';
            }
        }
    </script>
</body>
</html>