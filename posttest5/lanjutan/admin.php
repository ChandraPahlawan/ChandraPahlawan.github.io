<?php
session_start();

// variabel
$message = "";
$attempts = isset($_SESSION['attempts']) ? $_SESSION['attempts'] : 0;
$locktime = isset($_SESSION['locktime']) ? $_SESSION['locktime'] : 0;

// memeriksa apakah akun terkunci
function is_locked() {
    global $locktime;
    if ($locktime > 0) {
        $timeleft = $locktime + 60 - time(); // 60 detik = 1 menit
        if ($timeleft > 0) {
            return $timeleft;
        } else {
            $_SESSION['locktime'] = 0;
            $_SESSION['attempts'] = 0;
            return false;
        }
    }
    return false;
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $locked = is_locked();
    if ($locked) {
        $message = "Mohon tunggu " . $locked . " detik sebelum mencoba lagi.";
    } else {
        if ($username === 'admin' && $password === 'admin') {
            $message = "Login berhasil!";
            // mengarahkan ke halaman CRUD
            header("Location: crud.php");
            exit();
        } else {
            $attempts++;
            $_SESSION['attempts'] = $attempts;
            if ($attempts >= 3) {
                $message = "Anda bukan admin ya";
                $_SESSION['locktime'] = time();
            } else {
                $message = "Login gagal. Sisa percobaan: " . (3 - $attempts);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            transition: background-color 0.3s, color 0.3s;
        }
        body.dark-mode {
            background-color: #333;
            color: #fff;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            transition: background-color 0.3s, color 0.3s;
        }
        .dark-mode .container {
            background-color: #444;
            color: #fff;
        }
        input, button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.8;
        }
        #message {
            color: red;
            margin-top: 10px;
        }
        .dark-mode #message {
            color: #ff6b6b;
        }
        #darkModeToggle {
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 14px;
            z-index: 1000;
        }
        .dark-mode #darkModeToggle {
            background-color: #f0f0f0;
            color: #333;
        }
    </style>
</head>
<body>
    <button id="darkModeToggle">🌓</button>
    <div class="container">
        <h2>Login Admin</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <button onclick="goBack()">Kembali</button>
        <p id="message"><?php echo $message; ?></p>
    </div>

    <script>
        function goBack() {
            window.location.href = 'tampilan.php';
        }

        const darkModeToggle = document.getElementById('darkModeToggle');
        const body = document.body;

        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            darkModeToggle.textContent = body.classList.contains('dark-mode') ? '☀️' : '🌓';
        });
    </script>
</body>
</html>