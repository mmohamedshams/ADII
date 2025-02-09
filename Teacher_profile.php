<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('db_connect.php');
$user_id = $_SESSION['user_id'];

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

if (isset($_POST['update'])) {
   
    $new_full_name = $_POST['new_full_name'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_phone = $_POST['new_phone'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    if (isset($_FILES['user_image'])) {
        $user_image = $_FILES['user_image']['tmp_name'];
        $user_image_data = file_get_contents($user_image);
        
    }
    
    $password_sql = "SELECT password FROM users WHERE id = $user_id";
    $password_result = $conn->query($password_sql);
    if ($password_result->num_rows == 1) {
        $row = $password_result->fetch_assoc();
        $stored_password = $row['password'];

        
        if (password_verify($current_password, $stored_password)) {
           
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET full_name = '$new_full_name', family_name = '$new_username', email = '$new_email', phone = '$new_phone', password = '$hashed_new_password' WHERE id = $user_id";
            
            if ($conn->query($sql) === TRUE) {
                header("Location: Teacher_profile.php");
             
            } else {
                echo "حدثت مشكلة أثناء تحديث البيانات: " . $conn->error;
            }
        } else {
            echo "<script>alert('كلمة المرور الحاليه غير صحيحة.');</script>";
        }
    }
}

$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $full_name = $row['full_name'];
    $family_name = $row['family_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $random_code = $row['random_code'];
} else {
    echo "حدثت مشكلة أثناء جلب معلومات المستخدم.";
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
<title>Profile</title>
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
    display: flex;
    flex-direction: column;
    overflow-y: auto;
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
    position: fixed;
    flex-direction: row-reverse;
    justify-content: center; 
    align-items: center;
    height: 7vh;
    background-color: black;
    border: 0.5px solid black;
    width: 100%;
}
.content-box {
    background-color: #f0f0f0;
    margin: 60px 400px; 
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
    height: 100%;
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
.user-image-circle-container{
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
.user-info-container{
    text-align: center;
    color: #000;
    text-decoration: none;
    padding: 1vh ;
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
.name-container {
    color: #000;
    text-decoration: none;
    font-size: 15px;
    margin-top: 10px;
    margin-bottom: .5px;
}
.code-container{
    color: #000;
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

.form-group {
    margin: 5px 0;
}
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}
input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-bottom: 10px;
    box-sizing: border-box;
}
button.info-button {
    background-color: #000;
    color: white;
    border: none;
    padding: 15px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    border: 0.5px solid black;
}
button.info-button:hover {
    color: #1492FD;
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
<div class="content-box">
<div class="user-info-container">
<div class="user-image-circle-container">
    <div class="user-image" style="background-image: url('<?php echo $row['image_path']; ?>');" onclick="openImageUploader()"></div>
    <input type="file" id="image-input" accept="image/*" name="user_image" style="display: none;" onchange="previewImage(event)">
</div>
    <h2 class="name-container"><?php echo $full_name; ?></h2>
    <h2 class="code-container"><?php echo $random_code; ?></h2>

   
    <button class="info-button" onclick="toggleUpdateForm()">تحديث البيانات</button>

    <div id="update-form" style="display: none;">
        <form method="post">
            <div style="display:flex;">
            <div class="form-group">
                <label for="new_full_name">الاسم الطالب:</label>
                <input type="text" id="new_full_name" name="new_full_name" value="<?php echo $full_name; ?>" required>
            </div>

            <div class="form-group">
                <label for="new_username">اسم العائلة:</label>
                <input type="text" id="new_username" name="new_username" value="<?php echo $family_name; ?>" required>
            </div>
            </div>
            <div class="form-group">
                <label for="new_email">البريد الإلكتروني:</label>
                <input type="email" id="new_email" name="new_email" value="<?php echo $email; ?>" required>
            </div>

            <div class="form-group">
                <label for="new_phone">رقم الهاتف:</label>
                <input type="text" id="new_phone" name="new_phone" value="<?php echo $phone; ?>" required>
            </div>
            <div style="display:flex;">
            <div class="form-group">
                <label for="current_password">كلمة المرور الحالية:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">كلمة المرور الجديدة:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            </div>

            <div class="form-group">
                <button class="info-button" type="submit" name="update">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>
</div>


<script>
function toggleUpdateForm() {
    var updateForm = document.getElementById('update-form');
    if (updateForm.style.display === 'none') {
        updateForm.style.display = 'block';
    } else {
        updateForm.style.display = 'none';
    }
}
function openImageUploader() {
    document.getElementById("image-input").click();
}

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