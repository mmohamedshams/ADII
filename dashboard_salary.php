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
<title>Add Salary</title>
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
.update-form {
    max-width: 500px;
    margin: 15px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.update-form h2{
    text-align: center;
    color: #1492FD; 
}
label {
    display: block;
    margin-bottom: 5px;
}
select,
input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}
input[type="submit"] {
    background-color: #1492FD;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #0077cc;
}
.back{
    background-color: #1492FD;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    font-size: 12px;
}
.back:hover{
    background-color: #0077cc;
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

<div class="update-form">
        <form method="post" action="process_money.php">
            <h2>Add Salary</h2>
            <label for="code"> Choose the teacher code :</label>
            <select name="code" id="code" onchange="updateFields()">
                <?php
                $sqlCodes = "SELECT * FROM users WHERE role = 'teacher'";
                $resultCodes = $conn->query($sqlCodes);

                if ($resultCodes->num_rows > 0) {
                    while ($rowCode = $resultCodes->fetch_assoc()) {
                        $selected = ($rowCode['id'] == $user_id) ? 'selected' : '';
                        echo "<option value='{$rowCode['random_code']}' data-fullname='{$rowCode['full_name']}'>{$rowCode['random_code']}</option>";
                    }
                } else {
                    echo "<option value='' data-fullname=''>لا توجد أكواد عشوائية</option>";
                }
                ?>
            </select>

            <label for="full_name" style="display: none;"> اسم المدرس:</label>
            <input type="text" name="full_name" id="full_name" style="display: none;" required readonly>

            <label for="random_code" style="display: none;"> الكود العشوائي:</label>
            <input type="text" name="random_code" id="random_code" style="display: none;" required readonly>


<label for="month"> Month :</label>
        <select name="month" id="month">
            <option value="" selected>Choose a month </option>
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>

           
        </select>

    
    <label for="basic_salary"> basic salary :</label>
    <input type="text" name="basic_salary" id="basic_salary" required>

   
    <label for="additions">additions :</label>
    <input type="text" name="additions" id="additions" required>

    
    <label for="deductions">deductions:</label>
    <input type="text" name="deductions" id="deductions" required>

   
    <input type="submit" value="Save">
    
    <a href="dashboard_salary_detalis.php"><div class="back"> Back   </div></a>
  
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

function updateFields() {
            var codeSelect = document.getElementById('code');
            var fullNameInput = document.getElementById('full_name');
            var randomCodeInput = document.getElementById('random_code');

            
            var selectedOption = codeSelect.options[codeSelect.selectedIndex];

            
            fullNameInput.value = selectedOption.getAttribute('data-fullname');
            randomCodeInput.value = selectedOption.value;
        }
</script>

</body>
</html>
