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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Je3SOpbSm8mI5s2n5P4ynfGSc4eGL4qpeXp8F5c5bJw4+xj" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&display=swap" rel="stylesheet">
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Exam</title>
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
.content-box {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
    margin: auto;
    margin-top: 20px;
    transition: transform 0.3s ease-in-out;
    color: #000;
    overflow: auto;
    height: 80vh;
}
.content-box h1{
    text-align: center;
    color: #1492FD;
}
.content-box a {
    color: #000;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;  
}
table, th, td {
    border: 1px solid #ddd;
}
th, td {
    padding: 10px;
    text-align: center;
}
th {
    background-color: #1492FD;
    color: #fff;
}
tr:nth-child(even) {
    background-color: #f2f2f2;
}
tr:hover {
    background-color: #f5f5f5;
}
.edit-box {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
    z-index: 999;
    width: 500px;
}
.edit-box h2 {
    text-align: center;
    color: #1492FD;
}

.edit-box label {
    display: block;
    margin-bottom: 5px;
    color: #000;
}
.edit-box input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}
.edit-box button {
    background-color: #1492FD;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 5px;
}
.edit-box button:hover {
    background-color: #151B54;
}
.edit-box button:last-child {
    margin-left: 10px;
    background-color: #ccc;
    color: #000;
}
i{
    margin-left:10px ;
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
    <h1>جدول الامتحانات</h1>
    <a href="Teacher_add_exam.php"> <i class="fas fa-clipboard-list"></i> اضافه امتحان جديد </a>
    <table border="1">
        <tr>
            <th>نص الامتحان </th>
            <th>وقت الانشاء</th>
            <th> البداية</th>
            <th> الانتهاء</th>
            <th>الكود الطالب</th>
            <th>Actions</th>
        </tr>
        <?php
        $contentSql = "SELECT * FROM content WHERE user_code = '$random_code'";
        $contentResult = $conn->query($contentSql);

        if ($contentResult->num_rows > 0) {
            while ($contentRow = $contentResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a style='color : #1492FD;' href='" . $contentRow['link'] . "' target='_blank'>" . $contentRow['text'] . "</a></td>";
                echo "<td>" . $contentRow['created_at'] . "</td>";
                echo "<td>" . $contentRow['start_time'] . "</td>";
                echo "<td>" . $contentRow['end_time'] . "</td>";
                echo "<td>" . $contentRow['random_code'] . "</td>";
                
                echo "<td >";

                echo "<a href='#'  onclick='openEditBox(" . $contentRow['id'] . ")'> <i class='fa-solid fa-pen-to-square' ></i></a>";
                
                echo "<a href='#' onclick='deleteContent(" . $contentRow['id'] . ")'><i class='fa-solid fa-trash-can' style='color:#E74C3C'></i></a>";
                echo "</td>";

               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>لا توجد بيانات.</td></tr>";
        }
        ?>
    </table>
</div>     
<?php
if (isset($_POST['delete_content'])) {
    $content_id = $_POST['content_id'];
   
    $deleteSql = "DELETE FROM content WHERE id = $content_id";

    if ($conn->query($deleteSql) === TRUE) {
        
        header("Location: Teacher_exam.php");
        exit;
    } else {
        echo "حدثت مشكلة أثناء حذف المحتوى: " . $conn->error;
    }
}
?>
<div id="edit-box" class="edit-box" style="display:none;">
    <h2>تعديل البيانات </h2>
    <form id="edit-form" method="post">
        <input type="hidden" id="edit-content-id" name="edit_content_id" value="">
        <label for="edit-text">نص الامتحان:</label>
        <input type="text" id="edit-text" name="edit_text"  required>
        <label for="edit-link">الرابط:</label>
        <input type="url" id="edit-link" name="edit_link" required>
        <label for="edit-start-time"> وقت البدء:</label>
        <input type="datetime-local" id="edit-start-time" name="edit_start_time" required>
        <label for="edit-end-time"> وقت الانتهاء:</label>
        <input type="datetime-local" id="edit-end-time" name="edit_end_time" required>
        <button type="submit" name="update_content">تحديث</button>
        <button type="button" onclick="closeEditBox()">رجوع</button>
    </form>
</div>
<?php
if (isset($_POST['update_content'])) {
    $edit_content_id = $_POST['edit_content_id'];
    $edit_text = $_POST['edit_text'];
    $edit_link = $_POST['edit_link'];
    $edit_start_time = $_POST['edit_start_time'];
    $edit_end_time = $_POST['edit_end_time'];

   
    $updateSql = "UPDATE content SET text = '$edit_text', link = '$edit_link', start_time = '$edit_start_time', end_time = '$edit_end_time' WHERE id = $edit_content_id";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: Teacher_exam.php");
        exit;
    } else {
        echo "حدثت مشكلة أثناء تحديث المحتوى: " . $conn->error;
    }
}
?>
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
    var contentBox = document.querySelector(".content-box");

    function showContentBox() {
        contentBox.classList.remove("slide-out");
        contentBox.classList.add("slide-in");
    }

    function hideContentBox() {
        contentBox.classList.remove("slide-in");
        contentBox.classList.add("slide-out");
    }

 
    document.getElementById("toggle-content-box").addEventListener("click", function () {
        if (contentBox.classList.contains("slide-in")) {
            hideContentBox();
        } else {
            showContentBox();
        }
    });
});

function openEditBox(contentId) {
    var editBox = document.getElementById('edit-box');
    var editText = document.getElementById('edit-text');
    var editLink = document.getElementById('edit-link');
    var editStartTime = document.getElementById('edit-start-time');
    var editEndTime = document.getElementById('edit-end-time');

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            editText.value = data.text;
            editLink.value = data.link;
            editStartTime.value = data.start_time;
            editEndTime.value = data.end_time;
        }
    };
    xhr.open("GET", "get_content.php?content_id=" + contentId, true);
    xhr.send();

    document.getElementById('edit-content-id').value = contentId;

    editBox.style.display = 'block';
}
function closeEditBox() {
    var editBox = document.getElementById('edit-box');
    editBox.style.display = 'none';

    window.location.reload();
}
document.addEventListener("DOMContentLoaded", function () {
   
    function openEditBox(contentId, contentText, contentLink, startTime, endTime) {
        var editBox = document.getElementById('edit-box');
        var editText = document.getElementById('edit-text');
        var editLink = document.getElementById('edit-link');
        var editStartTime = document.getElementById('edit-start-time');
        var editEndTime = document.getElementById('edit-end-time');

        editText.value = contentText;
        editLink.value = contentLink;
        editStartTime.value = startTime;
        editEndTime.value = endTime;

        document.getElementById('edit-content-id').value = contentId;

        editBox.style.display = 'block';
    }
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
<script>
function deleteContent(contentId) {
    if (confirm('Are you sure you want to delete this content?')) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                
                window.location.reload();
            }
        };
        xhr.open("GET", "delete_content_teacher.php?content_id=" + contentId, true);
        xhr.send();
    }
}
</script>

</body>
</html>