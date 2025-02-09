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
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Invoice</title>
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
    font-family: 'Noto Kufi Arabic', sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
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
.slider-button i{
    margin-right: 10px;
}
i{
    margin-right: 10px ;
}
.content h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #1492FD; 
}
.content-container {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin: 20px;
    padding: 20px;
    max-width: 600px; 
    width: 100%;
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
    <a class="slider-button" href="dashboard.php"><i class="fas fa-users"></i> Users</a>
    <a class="slider-button" href="dashboard_moany_detalis.php"><i class="fas fa-file-invoice-dollar"></i> Invoice</a>
    <a class="slider-button" href="dashboard_salary_detalis.php"><i class="fa-solid fa-money-check-dollar"></i> Salary</a>
    <a class="slider-button" href="dashboard_stydent_detalis.php"><i class="fas fa-table-list"></i> Student</a>
    <a class="slider-button" href="dashboard_teacher_detalis.php"><i class="fas fa-chalkboard-teacher"></i> Teachers</a>
    <a class="slider-button" href="dashboard_result.php"><i class="fas fa-chart-bar"></i> Estimates</a>
    <a class="slider-button" href="dashboard_help.php"><i class="fas fa-question-circle"></i> Help</a>
</div> 
                <p class="Copyright">Copyright © 2023 Abu Dhabi International Institute. All Rights Reserved</p>
              </div>
</div>
<div class="content-container">
        <div class="content">
            <h2>Add Invoice</h2>
            <form action="upload_file.php" method="post" enctype="multipart/form-data">
                <div>
                    <label for="text_field"> text:</label>
                    <input type="text" id="text_field" name="text_field" required>
                </div>
                <div>
                    <label for="file_field">file:</label>
                    <input type="file" id="file_field" name="file_field" required>
                </div>
                <div>
                    <label for="random_code">Choose the random code:</label>
                    <select id="random_code" name="random_code" onchange="printSelectedOptions()" required>
    <option value="">Choose a random code</option>
    <?php

    $sql = "SELECT random_code, email FROM users WHERE role = 'student'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['random_code'] . "'>" . $row['random_code'] . " - " . $row['email'] . "</option>";
        }
    }
    ?>
</select>
                </div>
                <div>
                    <p>codes:</p>
                    <p name="random_code" id="selected_codes_result"></p>
                </div>
                <div>
                    <input type="submit" value="Upload file" name="submit">
                    <a class="back" href="dashboard_moany_detalis.php">Back</a>
                </div>
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

function printSelectedOptions() {
    var selectElement = document.getElementById("random_code");
    var selectedOptions = selectElement.selectedOptions;

    var selectedCodes = [];
    for (var i = 0; i < selectedOptions.length; i++) {
        selectedCodes.push(selectedOptions[i].value);
    }

  
    var resultElement = document.getElementById("selected_codes_result");
    resultElement.innerHTML = selectedCodes.join(", ");
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
