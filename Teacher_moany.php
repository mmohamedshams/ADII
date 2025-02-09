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
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Je3SOpbSm8mI5s2n5P4ynfGSc4eGL4qpeXp8F5c5bJw4+xj" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&display=swap" rel="stylesheet">
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Salary</title>
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
}
a{
    text-decoration: none;
    color: #fff;
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
    margin: 20px 200px;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    border-radius: 5px;
    background-color: #fff;
    color: #000;
    height: 70vh;
    overflow: auto;
}
.content h1{          
    text-align: center;
    margin-bottom: 20px;
    color: #1492FD;      
}
.user-info1 {
    display: flex;
    align-items: center;
    
}
.user-image-circle1 {
    margin-right: 20px; 
    width: 100px; 
    height: 100px;
    background-color: #fff;
    border-radius: 50%; 
    overflow: hidden; 
}
.user-details1 {
    display: flex;
    flex-direction: column;
    margin-left: 15px;
}
.user-details1 h2, .user-details1 p {
    margin: 5px 0; 
    
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
            <div class="logo">
            <a href="Teacher_home.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div>
            <div class="user-image-circle2">
                <a href="Teacher_profile.php">
                <div class="user-image" style="background-image: url('<?php echo $row['image_path']; ?>');"></div>
                        
            </div>
            <h2 id="toggle-slider" class="info-button" > <?php echo $full_name; ?></h2>
            </a>
</div>
<div class="slider-container">
            <div class="slider">
                <div class="user-info">
                    <div class="user-image-circle">
                        <a href="Teacher_profile.php">
                        <div class="user-image" style="background-image: url('<?php echo $row['image_path']; ?>');"></div>
                        </a>
                    </div>
                    <h2 class="name"><?php echo $full_name; ?></h2>
                    <h2 class="code"><?php echo $random_code; ?></h2>
                </div>
                <div class="buttons-container">
                <a class="slider-button" href="Teacher_table.php">الجداول<img src="image/table.png" > </a>
                <a class="slider-button" href="Teacher_coursas.php">المحاضرات<img src="image/training_1654193.png" > </a>
                <a class="slider-button" href="Teacher_moany.php">الراتب<img src="image/money-bag_1990406.png" ></a>
                <a class="slider-button" href="Teacher_exam.php">الامتحانات<img src="image\Exam-Cartoon-Transparent-Background.png" ></a> 
                <a class="slider-button" href="Teacher_result.php">الدرجات<img src="image/5050958.png" ></a> 
                <a class="slider-button" href="Teacher_help.php">مساعده  <img src="image/3144621.png" ></a>  
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
<div class="content" >
<h1>الراتب</h1>
<div class="user-info1">
    <div class="user-image-circle1">
        <img class="user-image" src="<?php echo $row['image_path']; ?>" alt="صورة المستخدم">
    </div>
    <div class="user-details1">
        <table>   
          <tr>
          <th style="padding: 0px 80px;"  ><p>الاسم </p></th>
        <th style="padding: 0px 80px;" > <p>الحاله</p></th>
        <th style="padding: 0px 80px;"> <p>الكود</p></th>
          </tr>  
          <tr>
        <th style="padding: 0px 80px;"  ><p><?php echo $full_name; ?></p></th>
        <th style="padding: 0px 80px;" > <p><?php echo $row['role']; ?></p></th>
        <th style="padding: 0px 80px;"> <p><?php echo $random_code; ?></p></th>
        </tr> 
        </table>
    </div>
</div>
<table style="width:100%; margin-top: 20px; border-collapse: collapse;">
<tr style="background-color: #1492FD; color:#fff;">
    <th style="padding: 10px; border: 1px solid #ddd;">الشهر</th>
    <th style="padding: 10px; border: 1px solid #ddd;">الراتب الأساسي</th>
    <th style="padding: 10px; border: 1px solid #ddd;">الإضافات</th>
    <th style="padding: 10px; border: 1px solid #ddd;">الخصومات</th>
    <th style="padding: 10px; border: 1px solid #ddd;">المجموع</th>
</tr>
<?php


$random_code = mysqli_real_escape_string($conn, $random_code); 

$sqlSalary = "SELECT * FROM money_teachers WHERE code = ?";
$stmt = $conn->prepare($sqlSalary);
$stmt->bind_param("s", $random_code);
$stmt->execute();
$resultSalary = $stmt->get_result();

if ($resultSalary->num_rows > 0) {
    while ($rowSalary = $resultSalary->fetch_assoc()) {
        $month = $rowSalary['month'];
        $basicSalary = $rowSalary['basic_salary'];
        $additions = $rowSalary['additions'];
        $deductions = $rowSalary['deductions'];
        $totalSalary = $basicSalary + $additions - $deductions;

        echo "<tr>";
        echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>" . $month . "</td>";
        echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>" . $basicSalary . "</td>";
        echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>" . $additions . "</td>";
        echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>" . $deductions . "</td>";
        echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>" . $totalSalary . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5' style='padding: 10px; border: 1px solid #ddd;'>لا يوجد معلومات حول الراتب</td></tr>";
}

$stmt->close();
?>
</table>
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
</script>
</body>
</html>