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
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    background-color: #F2F4F4  ;
    height: 90%;
    top: 8%; 
    left: 0; 
    position: fixed;
    transition: left 0.3s;  
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
    margin-top: 10px;      
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
.content-container {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}
.content-container2 {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}
.content-container3 {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-top: 20px;
    margin-bottom: 20px ;
}
.info-box {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    width: 150px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: auto; 
}
.info-box2 {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    width: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: auto;
    height: 300px;
}
.info-box3 {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    width: auto;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: auto;
    height: 300px;
    flex: 1;
    margin-right: 100px; 
    margin-left: 100px; 
}
.combined-container {
    flex: 1;
}
.info-box h3 {
    margin-bottom: 10px;
    color: #1492FD;
}
.info-box p {
    font-size: 20px;
    margin: 0;
}
.info-box2 h3 {
    margin-bottom: 10px;
    color: #1492FD;
}
.info-box2 p {
    font-size: 20px;
    margin: 0;
}
.info-box3 h3 {
    margin-bottom: 10px;
    color: #1492FD;
}
.info-box3 p {
    font-size: 20px;
    margin: 0;
}
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    border: 1px solid #ddd;
    padding: 7px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
tr:hover{
    background-color: #EBF5FB; 
}
i{
    margin-right: 10px ;
}
.Graph{
    display: flex;
}
.chart-container {
    width: 200px;
    height: 200px;
    background-color: #fff;
    overflow: hidden;
    margin: 20px auto;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.chart-container-1{
    width: 400px;
    height: 250px;
    background-color: #fff;
    overflow: hidden;
    margin: 20px auto;
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
</style>
</head>
<body>
<div class="header">
<form method="post" style="margin-right: 10px;">
            <button class="logout-button" type="submit" name="logout">تسجيل الخروج </button>
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
<div class="content-container">
    <div class="info-box">
    <h3>Users <i class="fas fa-users"></i></h3>
        <?php
        $usersCountQuery = "SELECT COUNT(*) as userCount FROM users";
        $usersCountResult = $conn->query($usersCountQuery);

        if ($usersCountResult && $usersCountResult->num_rows > 0) {
            $usersCount = $usersCountResult->fetch_assoc()['userCount'];
            echo "<p>$usersCount</p>";
        } else {
            echo "<p>خطأ في جلب البيانات</p>";
        }
        ?>
    </div>

    <div class="info-box">
    <h3>Invoices <i class="fas fa-file-invoice-dollar"></i></h3>
        <?php
        $filesCountQuery = "SELECT COUNT(*) as filesCount FROM money_files";
        $filesCountResult = $conn->query($filesCountQuery);

        if ($filesCountResult && $filesCountResult->num_rows > 0) {
            $filesCount = $filesCountResult->fetch_assoc()['filesCount'];
            echo "<p>$filesCount</p>";
        } else {
            echo "<p>خطأ في جلب البيانات</p>";
        }
        ?>
    </div>
    <div class="info-box">
    <h3> Exams <i class="fas fa-clipboard-list"></i></h3>
        <?php
        $filesCountQuery = "SELECT COUNT(*) as filesCount FROM content";
        $filesCountResult = $conn->query($filesCountQuery);

        if ($filesCountResult && $filesCountResult->num_rows > 0) {
            $filesCount = $filesCountResult->fetch_assoc()['filesCount'];
            echo "<p>$filesCount</p>";
        } else {
            echo "<p>خطأ في جلب البيانات</p>";
        }
        ?>
    </div>
    <div class="info-box">
    <h3>Student schedules <i class="fas fa-table-list"></i> </h3>
        <?php
        $filesCountQuery = "SELECT COUNT(*) as filesCount FROM student_files";
        $filesCountResult = $conn->query($filesCountQuery);

        if ($filesCountResult && $filesCountResult->num_rows > 0) {
            $filesCount = $filesCountResult->fetch_assoc()['filesCount'];
            echo "<p>$filesCount</p>";
        } else {
            echo "<p>خطأ في جلب البيانات</p>";
        }
        ?>
    </div>
    <div class="info-box">
    <h3>Teachers' schedules <i class="fas fa-chalkboard-teacher"></i></h3>
        <?php
        $filesCountQuery = "SELECT COUNT(*) as filesCount FROM teacher_files";
        $filesCountResult = $conn->query($filesCountQuery);

        if ($filesCountResult && $filesCountResult->num_rows > 0) {
            $filesCount = $filesCountResult->fetch_assoc()['filesCount'];
            echo "<p>$filesCount</p>";
        } else {
            echo "<p>خطأ في جلب البيانات</p>";
        }
        ?>
    </div>
</div>
<div class="Graph">
<div class="chart-container">
    <canvas id="userChart" width="200" height="200"></canvas>
</div>
<div class="chart-container">
<canvas id="teacherStudentChart" width="200" height="200"></canvas>
</div>
<div class="chart-container">
<canvas id="randomCodeChart" width="200" height="200"></canvas>
</div>
</div>
<div class="content-container2">
<div class="info-box2">
    <h3>List of students</h3>
        <table border="1">
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Random Code</th>
                
            </tr>
            <?php
            $studentQuery = "SELECT * FROM users WHERE role = 'student'";
            $studentResult = $conn->query($studentQuery);

            if ($studentResult && $studentResult->num_rows > 0) {
                while ($studentRow = $studentResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $studentRow['full_name'] . "</td>";
                    echo "<td>" . $studentRow['email'] . "</td>";
                    echo "<td>" . $studentRow['random_code'] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>لا توجد بيانات</td></tr>";
            }
            ?>
        </table>
</div>
<div class="info-box2">
    <h3>List of teachers</h3>
        <table border="1">
            <tr>
                <th> Teacher Name</th>
                <th> email </th>
                <th>Random Code</th> 
                
            </tr>
            <?php
            $teacherQuery = "SELECT * FROM users WHERE role = 'teacher'";
            $teacherResult = $conn->query($teacherQuery);

            if ($teacherResult && $teacherResult->num_rows > 0) {
                while ($teacherRow = $teacherResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $teacherRow['full_name'] . "</td>";
                    echo "<td>" . $teacherRow['email'] . "</td>";
                    echo "<td>" . $teacherRow['random_code'] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>لا توجد بيانات</td></tr>";
            }
            ?>
        </table>
</div> 
</div>
<div class="content-container3">
<div class="info-box3">
    <h3>List of Exam</h3>
        <table border="1">
            <tr>
                <th> Exam text</th>
                <th>Teacher Name </th>
                <th>Teacher code </th> 
                
            </tr>
            <?php
            $teacherQuery = "SELECT * FROM content ";
            $teacherResult = $conn->query($teacherQuery);

            if ($teacherResult && $teacherResult->num_rows > 0) {
                while ($teacherRow = $teacherResult->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $teacherRow['text'] . "</td>";
                    echo "<td>" . $teacherRow['teacher_name'] . "</td>";
                    echo "<td>" . $teacherRow['random_code'] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>لا توجد بيانات</td></tr>";
            }
            ?>
        </table>
</div>
<div class="combined-container">
<div class="chart-container-1">
<canvas id="teacherExamChart" width="400" height="300"></canvas>
</div>
</div>
</div>
<?php
$studentCountQuery = "SELECT COUNT(*) as studentCount FROM users WHERE role = 'student'";
$teacherCountQuery = "SELECT COUNT(*) as teacherCount FROM users WHERE role = 'teacher'";

$studentCountResult = $conn->query($studentCountQuery);
$teacherCountResult = $conn->query($teacherCountQuery);

if ($studentCountResult && $teacherCountResult) {
    $studentCount = $studentCountResult->fetch_assoc()['studentCount'];
    $teacherCount = $teacherCountResult->fetch_assoc()['teacherCount'];
} else {
    $studentCount = 0;
    $teacherCount = 0;
}

$teacherTablesCountQuery = "SELECT COUNT(*) as teacherTablesCount FROM teacher_files";
$teacherTablesCountResult = $conn->query($teacherTablesCountQuery);

if ($teacherTablesCountResult && $teacherTablesCountResult->num_rows > 0) {
    $teacherTablesCount = $teacherTablesCountResult->fetch_assoc()['teacherTablesCount'];
} else {
    $teacherTablesCount = 0;
}

$studentTablesCountQuery = "SELECT COUNT(*) as studentTablesCount FROM student_files";
$studentTablesCountResult = $conn->query($studentTablesCountQuery);

if ($studentTablesCountResult && $studentTablesCountResult->num_rows > 0) {
    $studentTablesCount = $studentTablesCountResult->fetch_assoc()['studentTablesCount'];
} else {
    $studentTablesCount = 0;
}
$randomCodeCountQuery = "SELECT code, COUNT(*) as codeCount FROM money_teachers GROUP BY code";
$randomCodeCountResult = $conn->query($randomCodeCountQuery);

$randomCodeCounts = array(); 

if ($randomCodeCountResult && $randomCodeCountResult->num_rows > 0) {
    while ($row = $randomCodeCountResult->fetch_assoc()) {
        $randomCode = $row['code'];
        $codeCount = $row['codeCount'];
        $randomCodeCounts[$randomCode] = $codeCount;
    }
}
$teacherExamCountQuery = "SELECT teacher_name, COUNT(*) as examCount FROM content GROUP BY teacher_name";
$teacherExamCountResult = $conn->query($teacherExamCountQuery);

$teacherExamCounts = array();

if ($teacherExamCountResult && $teacherExamCountResult->num_rows > 0) {
    while ($row = $teacherExamCountResult->fetch_assoc()) {
        $teacherName = $row['teacher_name'];
        $examCount = $row['examCount'];
        $teacherExamCounts[$teacherName] = $examCount;
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
    var studentCount = <?php echo $studentCount; ?>;
    var teacherCount = <?php echo $teacherCount; ?>;

    var ctx = document.getElementById('userChart').getContext('2d');
    var userChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Students', 'Teachers'],
            datasets: [{
                data: [studentCount, teacherCount],
                backgroundColor: ['#1492FD', '#e74c3c'],
            }]
        },
        options: {
            responsive: true,
            cutoutPercentage: 70, 
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Students vs Teachers Ratio',
                fontSize: 14,
            },
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {

    var teacherTablesCount = <?php echo $teacherTablesCount; ?>;
    var studentTablesCount = <?php echo $studentTablesCount; ?>;

    var ctx2 = document.getElementById('teacherStudentChart').getContext('2d');
    var teacherStudentChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Teacher Tables', 'Student Tables'],
            datasets: [{
                data: [teacherTablesCount, studentTablesCount],
                backgroundColor: ['#e74c3c', '#1492FD'],
            }]
        },
        options: {
            responsive: true,
            cutoutPercentage: 70,
            legend: {
                display: false,
            },
            title: {
                display: true,
                text: 'Teacher Tables vs Student Tables',
                fontSize: 14,
            },
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    var randomCodeCounts = <?php echo json_encode($randomCodeCounts); ?>;

    var labels = Object.keys(randomCodeCounts);
    var data = Object.values(randomCodeCounts);

    var ctx4 = document.getElementById('randomCodeChart').getContext('2d');
    var randomCodeChart = new Chart(ctx4, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: ['#f39c12', '#1492FD', '#2ecc71', '#e74c3c', '#9b59b6'],
            }]
        },
        options: {
            responsive: true,
            cutoutPercentage: 70,
            legend: {
                display: true,
                position: 'bottom',
            },
            title: {
                display: true,
                text: 'Random Code Occurrences',
                fontSize: 14,
            },
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    var teacherExamCounts = <?php echo json_encode($teacherExamCounts); ?>;

    var labelsExam = Object.keys(teacherExamCounts);
    var dataExam = Object.values(teacherExamCounts);

    var ctx3 = document.getElementById('teacherExamChart').getContext('2d');
    var teacherExamChart = new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: labelsExam,
        datasets: [{
            label: 'Number of Exams',
            data: dataExam,
            backgroundColor: '#1492FD',
            borderWidth: 1,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, 
        legend: {
            display: false,
        },
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Teacher Name',
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Number of Exams',
                }
            }
        },
        title: {
            display: true,
            text: 'Teacher-wise Exam Occurrences',
            fontSize: 18, 
        },
    }
});
});
</script>
</body>
</html>