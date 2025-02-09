<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require_once('db_connect.php');
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $family_name = $row['family_name'];
    $email = $row['email'];
    $phone =$row['phone'];
    $random_code = $row['random_code'];  
} else {
    echo "حدثت مشكلة أثناء جلب معلومات المستخدم.";
}
if (isset($_POST['update_user'])) {
  
    $new_full_name = $_POST['new_full_name'];
    $new_family_name = $_POST['new_family_name'];
    $new_email = $_POST['new_email'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
   
    $update_sql = "UPDATE users SET full_name = '$new_full_name', family_name = '$new_family_name', email = '$new_email', password = '$new_password' WHERE id = $user_id";
    if ($conn->query($update_sql) === TRUE) {
        header("Location: accountant.php");
    } else {
        echo "حدثت مشكلة أثناء تحديث بيانات المستخدم: " . $conn->error;
    }
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="image/logo_dashboard.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&family=Raleway&display=swap" rel="stylesheet">
    <style>
* {
    font-family: 'Noto Kufi Arabic', sans-serif;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}
.header {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center; 
    align-items: center;
    height: 7vh;
    background-color: black;
    border: 0.5px solid black;
    width: 100%;  
}
.header a{
    text-decoration: none;
    color: #fff;
}
#toggle-slider{
    font-size: 20px;
   margin-left:10px ;
}
.logout-button{
    background-color: #000	; 
    color: white;
    border: none;
    margin: 5px 0;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 30px;
    font-size: 15px;
    font-weight: bold;
    border: 0.5px solid black;
}
.logout-button:hover {
    color: #1492FD;
}
.logo {
    margin-left: auto;
    margin-right: auto;
}
.logo h1 {
    font-size: 25px;
}
.slider {
    width: 15%;
    background-color: #F2F4F4  ;
    height: 90%;
    top: 8%; 
    left: 0; 
    position: fixed;
    transition: left 0.3s;  
    border-radius: 20px; 
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5);
}
a {
 text-decoration: none;
 color: #0077cc;
}
.header a{
    text-decoration: none;
    color: #fff;
}
.Copyright{
    font-size: 7px;
    direction: ltr;
    text-align: center; 
    margin-top: 160%;      
}
.buttons-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin-top: 1px;
}
.slider-button {
    background-color: #1492FD; 
    color: white;
    border: none;
    padding: 9px 70px;
    margin: 5px 0;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 10px;
    font-weight: bold;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center; 
}
.slider-button:hover { 
    background-color: #151B54;   
}
.slider-img img{
    width: 100px;
    height: 100px;
    padding: 9px 60px;
}
.slider-button i{
    margin-right: 10px;
}
.update-form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.update-form h2 {
    text-align: center;
    color: #1492FD;
}
.update-form label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}
.update-form input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    box-sizing: border-box;
}
.update-form button {
    background-color: #1492FD;
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 16px;
    font-weight: bold;
    width: 100%;
    transition: background-color 0.3s;
}
.update-form button:hover {
    background-color: #151B54;
}
</style>
</head>
<body>
<div class="header">
<form method="post" style="margin-right: 10px;">
            <button class="logout-button" type="submit" name="logout">تسجيل الخروج</button>
            </form>
            <div class="fullscreen-button" style="margin-right: 15px;">
            <a class="fullscreen-button" onclick="toggleFullScreen()">
            <i class="fas fa-expand"></i> 
            </a>
            </div>
            <div class="notification-button" style="margin-right: 20px;">
            <a class="notification-button" onclick="showNotifications()">
            <i class="fas fa-bell"></i> 
            </a>
            </div>
            <div class="logo">
            <a href="accountant.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div>            
            <a href="accountant_edit.php">
            <h2 id="toggle-slider" class="info-button" > <?php echo $full_name; ?></h2>
            </a>
</div>

<div class="slider-container">
<div class="slider">
        <a href="accountant.php">
        <div class="slider-img">
            <img src="image/golden-logo-png.webp" alt="">
        </div>
        </a>
        <div class="buttons-container">          
            <a class="slider-button" href="accountant_moany.php"><i class="fas fa-file-invoice-dollar"></i> Invoice</a>           
        </div>     
        <p class="Copyright">Copyright © 2023 Abu Dhabi International Institute. All Rights Reserved</p>
</div>
</div>
<div class="update-form">
    <h2>Update user data</h2>
    <form method="post" action="">
        <label for="new_full_name">Full Name:</label>
        <input type="text" id="new_full_name" name="new_full_name" value="<?php echo $full_name; ?>" required>

        <label for="new_family_name">Family Name :</label>
        <input type="text" id="new_family_name" name="new_family_name" value="<?php echo $family_name; ?>" required>

        <label for="new_email">Email:</label>
        <input type="email" id="new_email" name="new_email" value="<?php echo $email; ?>" required>

        <label for="new_password">New Password :</label>
        <input type="password" id="new_password" name="new_password" required>

        <button type="submit" name="update_user">Update </button>
    </form>
</div> 
<script>
document.addEventListener("DOMContentLoaded", function () {
    var slider = document.querySelector(".slider");
    var sliderWidth = slider.clientWidth; 
    var sliderLeft = -sliderWidth + "px"; 


    slider.style.left = sliderLeft;

    document.addEventListener("mousemove", function (event) {
        if (event.clientX < 160) { 
            slider.style.left = "0"; 
        } else {
            slider.style.left = sliderLeft; 
        }
    });

    slider.addEventListener("mouseleave", function () {
        slider.style.left = "-35%"; 
    });
});

function toggleFullScreen() {
    var doc = window.document;
    var docEl = doc.documentElement;

    var requestFullScreen = docEl.requestFullscreen || docEl.mozRequestFullScreen || docEl.webkitRequestFullScreen || docEl.msRequestFullscreen;
    var cancelFullScreen = doc.exitFullscreen || doc.mozCancelFullScreen || doc.webkitExitFullscreen || doc.msExitFullscreen;

    if (!doc.fullscreenElement && !doc.mozFullScreenElement && !doc.webkitFullscreenElement && !doc.msFullscreenElement) {
        requestFullScreen.call(docEl);
        
        localStorage.setItem('fullscreen', 'true');
    } else {
        cancelFullScreen.call(doc);
       
        localStorage.removeItem('fullscreen');
    }
}


document.addEventListener("DOMContentLoaded", function () {
    var fullscreenStatus = localStorage.getItem('fullscreen');
    if (fullscreenStatus === 'true') {
        toggleFullScreen();
    }
});
</script>
</body>
</html>
