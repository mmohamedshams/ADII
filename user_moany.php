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
    $level = $row['level'];
    

} else {
    echo "حدثت مشكلة أثناء جلب معلومات المستخدم.";
}
$random_code_exists = false;


$money_sql = "SELECT * FROM money_files WHERE random_code = '$random_code'";
$money_result = $conn->query($money_sql);

if ($money_result->num_rows > 0) {
    $random_code_exists = true;
}


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Je3SOpbSm8mI5s2n5P4ynfGSc4eGL4qpeXp8F5c5bJw4+xj" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&display=swap" rel="stylesheet">
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Money</title>
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
    overflow: hidden;
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
.header a{
    text-decoration: none;
    color: #fff;
}
.slider-container {
    flex-grow: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background-size: cover;
    background-position: center;          
}
.slider {
    width: 20%; 
    background-color: black;
    height: 100%; 
    top: 0vh; 
    right: -20%; 
    position: fixed;
    transition: right 0.3s; 
    overflow: auto;
}
.slick-slide img {
    width: 100%;
    height: auto;
}
.user-image-circle {
    width: 100px; 
    height: 100px;
    background-color: #fff;
    border-radius: 50%; 
    overflow: hidden; 
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
.user-info {
    text-align: center;
    color: #fff;
    text-decoration: none;
    padding: 3vh ;
    display: flex; 
    flex-direction: column; 
    align-items: center; 
}
.name {
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    margin-top: 10px;
    margin-bottom: 1px;
}
.code{
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    margin-top: .5px;
    margin-bottom: 1px;
}
a{
    text-decoration: none;
}
.Copyright{
    font-size: 8px;
    direction: ltr;
    text-align: center; 
    margin-top: 1vh;      
}
.social-media-links {
    margin-top: 2vh;
    margin-bottom: 1px;
    display: flex;
    justify-content: center; 
    align-items: center; 
}    
.social-media-links a {
    text-decoration: none;
    color: #fff; 
    margin-right: 15px;
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
    padding: 9px 80px;
    margin: 5px 0;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 10px;
    font-weight: bold;
    border: 0.5px solid black;
    width: 30px;
    display: flex;
    justify-content: center;
    align-items: center;     
}
.slider-button:hover {   
    background-color: #151B54; 
}
.slider-button img{
    width: 25px;
    height: 25px;
    margin-bottom: 10px;
    margin: 0px 10px; 
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
.content {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    color: #000;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
}
.content h1{          
    text-align: center;
    margin-bottom: 20px;
    color: #1492FD;      
}
.money-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.money-table th, .money-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}
.money-table th {
    background-color: #1492FD;
    color: #fff;
}
.No_Invoice{
    text-align: center;
    margin-bottom: 20px;
    color: #1492FD;
    font-size:30px;
}
</style>
</head>
<body>
    
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
<div class="slider-container">
            <div class="slider">
                <div class="user-info">
                    <div class="user-image-circle">
                        <a href="user_profile.php">
                        <div class="user-image" style="background-image: url('<?php echo $row['image_path']; ?>');"></div>
                        </a>
                    </div>
                    <h2 class="name"><?php echo $full_name; ?></h2>
                    <h2 class="code"><?php echo $random_code; ?></h2>
                    <h2 class="code"><?php echo $level; ?></h2>
                </div>
                <div class="buttons-container">
                <a class="slider-button" href="user_table.php">الجداول<img src="image/table.png" > </a>
                <a class="slider-button" href="user_coursas.php">المحاضرات<img src="image/training_1654193.png" > </a>
                <a class="slider-button" href="user_moany.php">المصروفات<img src="image/money-bag_1990406.png" ></a>
                <a class="slider-button" href="user_exam.php">الامتحانات<img src="image\Exam-Cartoon-Transparent-Background.png" ></a> 
                <a class="slider-button" href="user_result.php">التقدير<img src="image/5050958.png" ></a> 
                <a class="slider-button" href="user_help.php">مساعده  <img src="image/3144621.png" ></a> 
                </div>
                <div class="social-media-links">
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="https://www.instagram.com/m.hub.ae/"><i class="fab fa-instagram"></i></a>
    <a href="https://twitter.com/mhubae2023" ><i class="fab fa-twitter"></i></a>
    <a href="https://www.linkedin.com/company/the-hub-for-general-maintenance" ><i class="fab fa-linkedin"></i></a>
</div>
                <p class="Copyright">Copyright © 2023 Abu Dhabi International Institute. All Rights Reserved</p>
              </div>
</div>   
<div class="content">
    <?php if ($random_code_exists): ?>
        
        <h1>فواتيرك </h1>
        <?php
           
            $money_files_sql = "SELECT * FROM money_files WHERE random_code = '$random_code'";
            $money_files_result = $conn->query($money_files_sql);

            if ($money_files_result->num_rows > 0) {
                echo '<table class="money-table">';
                echo '<tr>';
                echo '<th> الفاتورة</th>';
                echo '<th>تاريخ الفاتورة</th>';
                echo '<th>دفع</th>';
                echo '<th>تحميل</th>';     
                echo '<th>معاينه</th>';
                echo '</tr>';

                while ($money_file_row = $money_files_result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $money_file_row['text_value'] . '</td>';
                    echo '<td>' . $money_file_row['created_at'] . '</td>';
                    echo '<td>';
                    echo '<a class="payment-button" data-invoice-id="' . $money_file_row['id'] . '">';
                    echo '<img src="image/paypal.png" width="60" height="20" alt="الدفع">';
                    echo '</a>';
                    echo '</td>';
                    echo '<td>';

                    $download_link = 'money_file/' . $money_file_row['file_name'];
                    echo '<a href="' . $download_link . '" download>';
                    echo '<i class="fa-solid fa-download" style="color:#000"></i>';
                    echo '</a>';                   
                    echo '<td>';
                    $download_link = 'money_file/' . $money_file_row['file_name'];
                    echo '<a href="view_file.php?id=' . $money_file_row['id'] . '" target="_blank">';
                    echo '<i class="fa-regular fa-eye" style="color:#000"></i>';
                    echo '</a>';
                    echo '</td>';
                }
                echo '</table>';
            } else {
                echo '<p>ليس لديك فواتير حاليًا.</p>';
            }
        ?>
    <?php else: ?>
       
        <p class="No_Invoice">لا يوجد فواتير لك حاليًا.</p>
    <?php endif; ?>
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

document.addEventListener("DOMContentLoaded", function () {
    
    var paymentButtons = document.querySelectorAll('.payment-button');

    
    paymentButtons.forEach(function (button) {
        button.addEventListener('click', function () {
           
            var invoiceId = button.getAttribute('data-invoice-id');

            
            var bankPaymentUrl = 'https://www.paypal.com/signin?returnUri=https%3A%2F%2Fwww.paypal.com%2Fmep%2F' + invoiceId;

           
            window.location.href = bankPaymentUrl;
        });
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