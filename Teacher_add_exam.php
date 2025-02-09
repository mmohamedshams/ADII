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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $text = $_POST['text'];
    $link = $_POST['link'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $selected_code = $_POST['selected_code'];
    $teacher_name = $_POST['teacher_name'];
    $user_code = $_POST['user_code'];

   
    $insertSql = "INSERT INTO content (text, link, start_time, end_time, random_code , teacher_name ,user_code) 
                  VALUES ('$text', '$link', '$start_time', '$end_time', '$selected_code', '$teacher_name', '$user_code')";

    if ($conn->query($insertSql) === TRUE) {
         header("Location: Teacher_exam.php");
    } else {
        echo "حدثت مشكلة أثناء إضافة المحتوى: " . $conn->error;
    }
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
<title>New Exam</title>
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
.content-box {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    margin: auto;
    margin-top: 20px;
    transition: transform 0.3s ease-in-out;
}
.content-box.slide-in {
    transform: translateX(0%);
}
.content-box.slide-out {
    transform: translateX(-100%);
}
.content-box a{
    color: #000;
}
.contant {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.contant form {
    width: 50%;
    margin: auto;
    color: #000;
}
.contant label, .contant input, .contant select, .contant button {
    margin-bottom: 10px;
}
.contant input[type="text"] , input[type="url"] { 
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
}
.contant input[type="datetime-local"] {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
.contant button {
    background-color: #1492FD;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 5px;
    margin: 5px;
}
.contant button:hover {
    background-color: #151B54;
}
.back{
    background-color: #1492FD;
    color: white;
    border: none;
    padding: 5px 20px;
    margin: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    border-radius: 5px;
    
}
.back:hover {
    background-color: #151B54;
}
.contant select {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-bottom: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff; 
    appearance: none; 
}
.contant input:focus {
    outline: none; 
    border-color: #1492FD; 
}
.contant select:focus {
    outline: none; 
    border-color: #1492FD; 
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


<div class="contant">
   
<div class="content-box">
    <form method="post" action="">
        <label for="text">نص الامتحان:</label>
        <input type="text" name="text" required>

        <label for="link">الرابط:</label>
        <input type="url" id="link" name="link" placeholder="https://example.com" required>

        <label for="start_time">وقت البدء:</label>
        <input type="datetime-local" id="datetime" name="start_time" required>

        <label for="end_time">وقت الانتهاء:</label>
        <input type="datetime-local" id="datetime" name="end_time" required>

        <label for="selected_code">اختر الكود العشوائي:</label>
        <select name="selected_code">
        <?php
    $randomCodesSql = "SELECT * FROM users WHERE role = 'student'";
    $randomCodesResult = $conn->query($randomCodesSql);

    while ($codeRow = $randomCodesResult->fetch_assoc()) {
        $email = $codeRow['email'];
        $randomCode = $codeRow['random_code'];
        echo "<option value='$randomCode'>$randomCode - $email</option>";
    }
    ?>
        </select>
        <label for="teacher_name" style="display:none;">اسم المستخدم:</label>
<input type="text" name="teacher_name" value="<?php echo htmlspecialchars($full_name); ?>" style="display:none;">

<label for="user_code" style="display:none;">الكود العشوائي:</label>
<input type="text" name="user_code" value="<?php echo htmlspecialchars($random_code); ?>" style="display:none;">

       <div style="display:flex;">
        <button id="toggle-content-box" class="add_button">إضافة امتحان</button>
        <a href="Teacher_exam.php"><div class="back">رجوع</div></a>
        </div>
    </form>
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