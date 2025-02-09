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
    $role =$row['role'];
    

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
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Schedule</title>
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
.logout-button{
    background-color: #000	; 
    color: white;
    border: none;
    padding: 5px 5px;
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
    width: 17%;
    background-color: #F2F4F4;
    height: 90%;
    top: 8%; 
    left: 0; 
    position: fixed;
    transition: left 0.5s; 
    border-radius: 20px; 
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.5); 
    overflow: auto;
}
a {
 text-decoration: none;
 color: #0077cc;
}
.header a{
    text-decoration: none;
    color: #fff;
}
#toggle-slider{
    font-size: 20px;
   margin-left:10px ;
}
.Copyright{
    font-size: 7px;
    direction: ltr;
    text-align: center; 
    margin-top: 40px;     
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
.slider-button img{
    width: 25px;
    height: 25px;
    margin-bottom: 10px;
    margin: 0px 10px; 
}
.slider-button img:hover{
    filter: invert(100%);
}

.content-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    padding: 20px;
    max-width: 600px;
    width: 80%;
}
.container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 60vh;
}
.container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #1492FD;
}
input[type="text"],
input[type="file"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #1492FD;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #151B54;
}
.back {
    background-color: #1492FD;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 20px;
    cursor: pointer;
    text-decoration: none;
}
.back:hover {
    background-color: #151B54;
    text-decoration: none;
}
i{
    margin-right: 10px ;
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
           
            <div class="logo">
            <a href="dashboard_home.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div>
            <a href="dashboard_edit.php">
            <h2 id="toggle-slider" class="info-button" > <?php echo $full_name; ?></h2>
            </a> 
</div>
<div class="slider-container">
            <div class="slider">
                <a href="dashboard_home.php">
                <div class="slider-img">
                    <img src="image/golden-logo-png.webp" alt="">
                </div>
                </a>
                <div class="buttons-container">
            <a class="slider-button" href="dashboard.php"><img src="image/person-15.png" alt=""> Users </a>
            <a class="slider-button" href="dashboard_moany_detalis.php"><img src="image/money-bag_1990406.png" alt="">Invoice</a>
            <a class="slider-button" href="dashboard_salary_detalis.php"><img src="image/money-bag_1990406.png" alt="">Salary</a>
            <a class="slider-button" href="dashboard_stydent_detalis.php"><img src="image/Exam-Cartoon-Transparent-Background.png" alt=""> Student</a> 
            <a class="slider-button" href="dashboard_teacher_detalis.php"><img src="image/Exam-Cartoon-Transparent-Background.png" alt=""> Teachers</a> 
            <a class="slider-button" href="dashboard_result.php"><img src="image/5050958.png" alt="">Estimates</a> 
            <a class="slider-button" href="dashboard_help.php"><img src="image/3144621.png" alt="">  Help</a> 
        </div> 
                <p class="Copyright">Copyright © 2023 Abu Dhabi International Institute. All Rights Reserved</p>
              </div>
</div>
<div class="content-container">
<div class="container">

        <form action="upload_teacher.php" method="post" enctype="multipart/form-data">
            <table>
                <h1>Teacher schedule</h1>
                <tr>
                    <td>
                    <input type="hidden" name="type" value="teacher">
                    <label for="code">Choose file :</label>
                    </td>
                    <td>
                        <input type="file" name="file" id="file" required>
                    </td>
                </tr>
                <tr>
    <td>
        <label for="code"> Choose the code :</label>
    </td>
    <td>
        <select name="code" id="code" onchange="updateUsername()">
            <?php
            $sql = "SELECT random_code , email, full_name FROM users WHERE role = 'teacher'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['random_code'] . "' data-username='" . $row['full_name'] . "'>" . $row['random_code'] . " - " . $row['email'] . "</option>";
                }
            }
            ?>
        </select>
    </td>
</tr>
<tr>
    <td>
        <label for="username">Username:</label>
    </td>
    <td>
        <input type="text" name="username" id="username" readonly>
    </td>
</tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Upload file">
                        <a class="back" href="dashboard_teacher_detalis.php">Back</a>
                    </td>
                </tr>
            </table>
        </form>
    </div> 
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
function updateUsername() {
    var codeSelect = document.getElementById("code");
    var usernameInput = document.getElementById("username");
    var selectedOption = codeSelect.options[codeSelect.selectedIndex];
    var username = selectedOption.getAttribute("data-username");
    usernameInput.value = username;
}



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
