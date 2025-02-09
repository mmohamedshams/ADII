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
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Je3SOpbSm8mI5s2n5P4ynfGSc4eGL4qpeXp8F5c5bJw4+xj" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Je3SOpbSm8mI5s2n5P4ynfGSc4eGL4qpeXp8F5c5bJw4+xj" crossorigin="anonymous">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&display=swap" rel="stylesheet">
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Home</title>
<link rel="icon" href="image/جامعة زايد.png">
<style>
* {
    direction: rtl;
    font-family: 'Noto Kufi Arabic', sans-serif;
}
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #e3f2fd;
    color: white;
    height: 100%;
    display: flex;
    flex-direction: column;
    overflow: auto;
}
.logo {
    margin-left: auto;
    margin-right: auto;
}
.logo h1 {
    font-size: 25px;
}
.header {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center; 
    align-items: center;
    height: 7vh;
    background-color: black;
    border: 0.5px solid black;
}
.user-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
}
.user-image-circle2 {
    width: 40px; 
    height: 40px; 
    background-color: #fff; 
    border-radius: 50%; 
    overflow: hidden; 
}
a{
    text-decoration: none;
    color: #fff;
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
.info-button{
    background-color: #000	; 
    color: white;
    border: none;
    padding: 0px 20px;
    margin: 5px 0;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 10px;
    font-size: 15px;
    font-weight: bold;
    border: 0.5px solid black;
}
.info-button:hover {
    color: #1492FD;
}
.slider-logo{
    max-width: 20px; 
    max-height: 20px;
}
.container1 {
    display: flex;
    justify-content: center;
    align-items: center; 
    margin-top: 30px; 
}
.container2 {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 30px;
}
.box-table {
    width: 200px;
    height: 200px;
    background-color: #82E0AA;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px;
    transition: transform 0.3s ease-in-out;
    color:#fff;
}
.box-table:hover {
    transform: scale(1.1);
}
.box-coursas {
    width: 200px;
    height: 200px;
    background-color: #F1948A ;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px;
    transition: transform 0.3s ease-in-out;
    color:#fff;
}
.box-coursas:hover {
    transform: scale(1.1);
}
.box-moany {
    width: 200px;
    height: 200px;
    background-color: #D4AC0D ;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px;
    transition: transform 0.3s ease-in-out;
    color:#fff;
}
.box-moany:hover {
    transform: scale(1.1);
}
.box-exam {
    width: 200px;
    height: 200px;
    background-color: #2874A6;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px;
    transition: transform 0.3s ease-in-out;
    color:#fff;
}
.box-exam:hover {
    transform: scale(1.1);
}
.box-result {
    width: 200px;
    height: 200px;
    background-color: #C39BD3;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px;
    transition: transform 0.3s ease-in-out;
    color:#fff;
}
.box-result:hover {
    transform: scale(1.1);
}
.box-help {
    width: 200px;
    height: 200px;
    background-color: #BA4A00;
    border-radius: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 20px;
    transition: transform 0.3s ease-in-out;
    color:#fff;
}
.box-help:hover {
    transform: scale(1.1);
}
.box-table img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}
.box-coursas img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}
.box-moany img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}
.box-exam img {
    width: 120px;
    height: 120px;
    margin-bottom: 10px;
}
.box-result img {
    width: 120px;
    height: 120px;
    margin-bottom: 10px;
}
.box-help img {
    width: 100px;
    height: 100px;
    margin-bottom: 10px;
}
.announcement-bar {
    background-color: #f3f3f3;
    height: 20px; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    overflow: hidden;
    color: #000;
    direction: ltr;
}
.announcement-content {
    animation: scrollText 30s linear infinite; 

}
@keyframes scrollText {
    0% {
    transform: translateX(-100%); 
    }
    100% {
    transform: translateX(165%); 
    }
}
.uae-flag {
    width: 25px; 
    height: 15px; 
    margin-right: 10px; 
    align-items: center;
}

.current-time {
    font-weight: bold;
    
}
.clock-and-flag{
    display: flex;
    align-items: center;
    direction: ltr;
    background-color: #f3f3f3;
    overflow: hidden;
    position: relative;
    padding: 10px;
}
</style>
</head>
<body>
<div class="announcement-bar">
    <div class="announcement-content">
        <p> يرجى العلم بانى جميع المحاضرات و الامتحانات حسب التوقيت المحلى لدوله الامارات العربيه المتحده  </p>
        
    </div>
    <div class="clock-and-flag">
            <img src="image/Flag_of_the_United_Arab_Emirates.svg.png" alt="علم الإمارات" class="uae-flag">
            <div class="current-time" id="current-time">00:00:00</div>
    </div>
</div>


<div class="header">
            <form method="post" style="margin-left: 10px;">
            <button class="logout-button" type="submit" name="logout">تسجيل الخروج</button>
            </form>
            <div class="fullscreen-button" style="margin-left: 15px;">
            <a class="fullscreen-button" onclick="toggleFullScreen()">
            <i class="fas fa-expand"></i> 
            </a>
            </div>
            <div class="notification-button" style="margin-left: 20px; display:none;">
            <a class="notification-button" onclick="showNotifications()">
            <i class="fas fa-bell"></i> 
            </a>
            </div>
            <div class="logo">
            <a href="user_home.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div>
            <div class="user-image-circle2">
            <a href="user_profile.php">
            <div class="user-image" style="background-image: url('<?php echo $row['image_path']; ?>');"></div>       
            </div>
            <h2 id="toggle-slider" class="info-button" > <?php echo $full_name; ?></h2>
            </a>
</div>
<div class="container"> 
<div class="container1">
                <a href="user_table.php" class="box-table" >
                <img src="image/table.png" >
                    <p>الجداول</p>
                </a>
                <a href="user_coursas.php" class="box-coursas" >
                <img src="image/training_1654193.png" >
                    <p>المحاضرات</p>
                </a>
                <a href="user_moany.php" class="box-moany" >
                <img src="image/money-bag_1990406.png" >
                    <p>المصروفات</p>
                </a>
                <a href="user_exam.php" class="box-exam" >
                <img src="image\Exam-Cartoon-Transparent-Background.png" >
                    <p>الامتحانات</p>
                </a>
</div>
<div class="container2">
                <a href="user_result.php" class="box-result" >
                <img src="image/5050958.png" >
                    <p>التقدير</p>
                </a>
                
                <a href="user_help.php" class="box-help" >
                <img src="image/3144621.png" >
                    <p>المساعدة</p>
                </a>
</div>  
</div> 
<script>
document.addEventListener("DOMContentLoaded", function () {
    var slider = document.querySelector(".slider");
    var rightSide = document.body.clientWidth; 
    document.addEventListener("mousemove", function (event) {       
    if (event.clientX > rightSide - 50) {
    slider.style.right = "0vh"; 
    }
    });
    slider.addEventListener("mouseleave", function () {
        slider.style.right = "-20%"; 
    });
});
function updateCurrentTime() {
    const currentTimeElement = document.getElementById("current-time");
    const currentTime = new Date().toLocaleTimeString('en-AE', { timeZone: 'Asia/Dubai' });
    currentTimeElement.textContent = currentTime;
}
setInterval(updateCurrentTime, 1000);
updateCurrentTime();
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