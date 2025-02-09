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
<title>Invoice</title>
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
    top: 10%;
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
.slider-button i{
    margin-right: 10px;
}
.container {
    width: 80%;
    margin: 10px auto;
    padding: 10px;
    background-color: #fff;
    height: 80vh;
}
.container h1{          
    text-align: center;  
    color: #1492FD;      
}
table {
    border-collapse: collapse;
    width: 100%;
    overflow: auto;
   
}
th, td {
    border: 1px solid #ddd;
    padding: 7px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
a {
    text-decoration: none;
    color: #0077cc;
}
.actions {
    margin-top: 20px;
}
.slider-img img{
    width: 100px;
    height: 100px;
    padding: 9px 60px;
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
            </a>
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
  
<div class="container">
    <h1>Invoice</h1>
    <div class="actions">
    <input type="text" id="filterInput" placeholder="بحث">
    <button type="button" id="clearButton" onclick="clearSearch()">Delete</button>
    </div>
    <table>
        <div>
        <a href="dashboard_moany.php"> <i class="fa-solid fa-plus"></i>Add Invoice</a>
        </div>
        <thead>
            <tr>
                <th>text_value</th>
                
                <th>Random Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            $sql = "SELECT *  FROM money_files";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["text_value"] . "</td>
                        
                        <td> ". $row["random_code"] . "</td>
                        <td><a onclick='confirmDelete(" . $row["id"] . ")'>
                        <i class='fa-regular fa-trash-can' style='color:#E74C3C'></i></a></td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>There are no new requests</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
   
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

document.addEventListener("DOMContentLoaded", function() {
       
    document.getElementById("filterInput").addEventListener("input", function() {
        var filterValue = this.value.toLowerCase(); 

        var rows = document.querySelectorAll("table tbody tr"); 

       
        var numCols = document.querySelector("table thead tr").cells.length;
            
        for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].cells;
                var rowText = "";

                for (var j = 0; j < numCols; j++) {
                    rowText += cells[j].textContent.trim().toLowerCase();
                }

               
                if (rowText.includes(filterValue)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
        }
        });
    });
    document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("filterInput").addEventListener("input", function() {
       

        
        var clearButton = document.getElementById("clearButton");
        clearButton.style.display = this.value.length > 0 ? "block" : "none";
    });

   
    window.clearSearch = function() {
        document.getElementById("filterInput").value = "";
       
        document.getElementById("clearButton").style.display = "none";
    };
});
function confirmDelete(recordId) {
    var result = confirm("Are you sure you want to delete this content?");

    if (result) {
       
        window.location.href = 'delete_moany_dashboard.php?id=' + recordId;
    } else {
        
      
    }
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
