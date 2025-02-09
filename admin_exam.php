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
<title>Exams</title>
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
}
.header a{
    text-decoration: none;
    color: #fff;
}
.Copyright{
    font-size: 8px;
    direction: ltr;
    text-align: center; 
    margin-top: 5px;     
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
    padding: 5px 70px;
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
.content-box {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: auto;
    margin-top: 20px;
    transition: transform 0.3s ease-in-out;
    color: #000;
    overflow: auto;
    height: 80vh;
    width: 1100px;
}
.content-box h1{
    text-align: center;
    color: #1492FD;
}
.content-box a {
    color: #0077cc;
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
    background-color: #f2f2f2;
    color: #000;
}
tr:hover{
    background-color: #EBF5FB; 
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
    margin-right:10px ;
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
            <a href="admin_home.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div>
            <a href="admin_edit.php">
            <h2 id="toggle-slider" class="info-button" > <?php echo $full_name; ?></h2>
            </a> 
            

</div>

<div class="slider-container">
            <div class="slider">
                <a href="admin_home.php">
                <div class="slider-img">
                    <img src="image/golden-logo-png.webp" alt="">
                </div>
                </a>
                <div class="buttons-container">
    <a class="slider-button" href="admin_dashboard.php"><i class="fas fa-users"></i> Users </a>
    <a class="slider-button" href="admin_moany_detalis.php"><i class="fas fa-file-invoice-dollar"></i> Invoice</a>
    <a class="slider-button" href="admin_salary_detalis.php"><i class="fa-solid fa-money-check-dollar"></i> Salary</a>
    <a class="slider-button" href="admin_stydent_detalis.php"><i class="fas fa-table-list"></i> Student</a>
    <a class="slider-button" href="admin_teacher_detalis.php"><i class="fas fa-chalkboard-teacher"></i> Teachers</a>
    <a class="slider-button" href="admin_result.php"><i class="fas fa-chart-bar"></i> Estimates</a>
    <a class="slider-button" href="admin_exam.php"><i class="fas fa-clipboard-list"></i> Exams</a>
    <a class="slider-button" href="admin_courses.php"><i class="fas fa-graduation-cap"></i> Lectures</a>
    <a class="slider-button" href="admin_help.php"><i class="fas fa-question-circle"></i> Help</a>
</div>   
                
                <p class="Copyright">Copyright © 2023 Abu Dhabi International Institute. All Rights Reserved</p>
              </div>
</div>
 
<div class="content-box">
    <h1> Exams</h1>
    <a href="admin_add_exam.php"> <i class="fas fa-clipboard-list"></i> Add Exam </a>
    <table border="1">
        <tr>
            <th>Exam text</th>
            <th>Create time</th>
            <th> Start</th>
            <th> End </th>
            <th> Student code</th>
            <th> Teacher Name</th>
            <th> Teacher code</th>
            <th>Actions</th>
        </tr>
        <?php
        $contentSql = "SELECT * FROM content" ;
        $contentResult = $conn->query($contentSql);

        if ($contentResult->num_rows > 0) {
            while ($contentRow = $contentResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a style='color : #1492FD;' href='" . $contentRow['link'] . "' target='_blank'>" . $contentRow['text'] . "</a></td>";
                echo "<td>" . $contentRow['created_at'] . "</td>";
                echo "<td>" . $contentRow['start_time'] . "</td>";
                echo "<td>" . $contentRow['end_time'] . "</td>";
                echo "<td>" . $contentRow['random_code'] . "</td>";
                echo "<td>" . $contentRow['teacher_name'] . "</td>";
                echo "<td>" . $contentRow['user_code'] . "</td>";
                echo "<td >";
                echo "<a href='#' onclick='deleteContent(" . $contentRow['id'] . ")'><i class='fa-solid fa-trash-can' style='color:#E74C3C'></i></a>";
                echo "<a href='#' onclick='openEditBox(" . $contentRow['id'] . ")'> <i class='fa-solid fa-pen-to-square'></i></a>";
                
              
                echo "</td>";

               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>لا توجد بيانات.</td></tr>";
        }
        ?>
    </table>
</div>     

<div id="edit-box" class="edit-box" style="display:none;">
    <h2>تعديل البيانات </h2>
    <form id="edit-form" method="post">
        <input type="hidden" id="edit-content-id" name="edit_content_id" value="">
        <label for="edit-text">Text:</label>
        <input type="text" id="edit-text" name="edit_text" required>
        <label for="edit-link">Link:</label>
        <input type="url" id="edit-link" name="edit_link" required>
        <label for="edit-start-time">Start Time:</label>
        <input type="datetime-local" id="edit-start-time" name="edit_start_time" required>
        <label for="edit-end-time">End Time:</label>
        <input type="datetime-local" id="edit-end-time" name="edit_end_time" required>
        <button type="submit" name="update_content">Update</button>
        <button type="button" onclick="closeEditBox()">Cancel</button>
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
        xhr.open("GET", "delete_content.php?content_id=" + contentId, true);
        xhr.send();
    }
}
</script>

</body>
</html>
