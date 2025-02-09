<?php
session_start();
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, email, password, role FROM users WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];

            
            if ($row['role'] == 'Teacher') {
                header("Location: Teacher_home.php");
            } elseif ($row['role'] == 'administrator') {
                header("Location: admin_home.php");
            } elseif ($row['role'] == 'student') {
                header("Location: user_home.php");  
            } elseif ($row['role'] == 'accountant') {
                 header("Location: accountant.php");
            
            }  
             else {
                header("Location: dashboard_home.php"); 
            }
            exit;
        } else {
            echo "<script>alert('كلمة المرور غير صحيحة.');</script>";
        }
    } else {
        echo "<script>alert('اسم المستخدم غير موجود.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Je3SOpbSm8mI5s2n5P4ynfGSc4eGL4qpeXp8F5c5bJw4+xj" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&display=swap" rel="stylesheet">
    <title>Login</title>
    <link rel="icon" href="image/جامعة زايد.png">
    <style>
        * {
            direction: rtl;
            font-family: 'Noto Kufi Arabic', sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url("image/جامعة-زايد.jpg");
            transition: background-image 2s;
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 300px;
            text-align: center;
            transition: transform 0.5s ease;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
            color: #1492FD;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-bottom: 2px solid #1492FD;
            background-color: transparent;
            color: #333;
            transition: border-bottom 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-bottom: 2px solid #1492FD;
        }
.password{
    display: flex;
}
i{
    margin-top: 20px;
    color: #1492FD;
}
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1492FD;
            border: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #000000;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }

        .register-link a {
            color: #1492FD;
            text-decoration: none;
        }

        .register-link a:hover {
            color: #2b1005;
        }

        img {
            max-width: 70px;
            max-height: 70px;
            margin: 0 auto;
        }

        .form-group a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="container">
        <img src="image/golden-logo-png.webp" alt="">
        <h2>تسجيل الدخول</h2>
        <form method="post" action="index.php">
            <div class="form-group"><input type="text" name="email" placeholder="البريد الالكترونى" required></div>
            <div class="form-group">
                <div class="password"><input type="password" name="password" id="password" placeholder="كلمة السر" required>
                <i class="fas fa-eye-slash" id="togglePassword"></i>
            </div>
            </div>
            <div class="register-link">
            <a href="forgot_password.php">نسيت كلمة المرور؟</a>
        </div>
            
            <div><button type="submit">دخول</button></div>
        </form>
        
    </div>

    <script>
        const backgroundImages = [
            "image/جامعة-زايد.jpg",
            "image/شروط-القبول-في-جامعة-زايد-أبو-ظبي.jpg",
            "image/415bb7a5-ce47-4be9-9e02-0c1f6a61ee1a.jpg"
        ];
        let currentIndex = 0;

        function changeBackgroundImage() {
            const body = document.body;
            currentIndex = (currentIndex + 1) % backgroundImages.length;
            body.style.backgroundImage = `url(${backgroundImages[currentIndex]})`;
        }

        setInterval(changeBackgroundImage, 5000);
    </script>
    <script>
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function () {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                togglePassword.classList.remove('fa-eye-slash');
                togglePassword.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                togglePassword.classList.remove('fa-eye');
                togglePassword.classList.add('fa-eye-slash');
            }
        });
    </script>

</body>

</html>
