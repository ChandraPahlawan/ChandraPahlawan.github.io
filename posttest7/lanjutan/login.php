<?php
include 'config.php';
session_start();
if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0; 
    $_SESSION['lockout_time'] = 0;
}

$lockout_duration = 60; // 1 minute lockout

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_time = time();

   
    if ($_SESSION['lockout_time'] > 0 && ($current_time - $_SESSION['lockout_time']) < $lockout_duration) {
        $remaining_time = $lockout_duration - ($current_time - $_SESSION['lockout_time']);
        echo "<div class='alert alert-danger'>Too many failed login attempts. Please wait for {$remaining_time} seconds and try again.</div>";
    } else {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

       
        if ($_SESSION['lockout_time'] > 0 && ($current_time - $_SESSION['lockout_time']) >= $lockout_duration) {
            $_SESSION['attempts'] = 0;
            $_SESSION['lockout_time'] = 0;
        }

        
        if ($username === "admin" && $password === "admin") {
            $_SESSION['username'] = $username;
            header("Location: crud.php");
            exit();
        }

        $sql = "SELECT * FROM registrasi WHERE username = :username AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['username'] = $username;
            header("Location: user.php");
            exit();
        } else {
            
            $_SESSION['attempts']++;

            // gagal 3 kali
            if ($_SESSION['attempts'] >= 3) {
                $_SESSION['lockout_time'] = $current_time;
                echo "<div class='alert alert-danger'>Too many failed login attempts. Please wait for 1 minute.</div>";
            } else {
                echo "<div class='alert alert-danger'>Invalid username or password. Attempt {$_SESSION['attempts']} of 3.</div>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #4CAF50;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background: #45a049;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        .login-link a {
            color: #666;
            text-decoration: none;
        }
        .login-link a:hover {
            color: #333;
            text-decoration: underline;
        }
        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            text-align: center;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            if ($username === "admin" && $password === "admin") {
                $_SESSION['username'] = $username;
                header("Location: crud.php");
                exit();
            }
            
            $sql = "SELECT * FROM registrasi WHERE username = :username AND password = :password";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $_SESSION['username'] = $username;
                header("Location: user.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Invalid username dan password</div>";
            }
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
        <div class="login-link">
            <a href="registrasi.php">Tidak punya akun? Register disini</a>
        </div>
    </div>
</body>
</html>