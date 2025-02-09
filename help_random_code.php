<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require_once('db_connect.php');
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM help_requests WHERE id = $user_id";
$result = $conn->query($sql);


if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Customer Data</title>
<link rel="icon" href="image/logo_dashboard.jpg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&family=Raleway&display=swap" rel="stylesheet">
<style>
* {
    font-family: 'Noto Kufi Arabic', sans-serif;
}
body {
    font-family: 'Raleway', sans-serif;
    background-color: #e3f2fd;
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
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
    font-family: 'Noto Kufi Arabic', sans-serif;
    filter: brightness(100);
    font-size: 25px;
}
.container {
    height: 100%;
    background-color: rgba(255, 255, 255, 0.6);
}
.form-box {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: rgba(255, 255, 255, 0.9);
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1 {
    text-align: center;
}
.data {
    margin-top: 20px;
}
.data p {
    margin: 0;
    padding: 5px 0;
    font-weight: bold;
}
.data p span {
    font-weight: normal;
}
.button-container {
    text-align: center;
    margin-top: 20px;
}
.button-container button {
    background-color: #0770c8;
    color: #fff;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}
.button-container button:hover {
    background-color: #0d98f4;
}
img {
    height: 20px;
}
.logo {
    padding: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}
a {
    text-decoration: none;
    color: #0d98f4;
}        
#editFields {
    display: none;
}
#editFields input,
#editFields select {
    width: 80%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}
#editFields button {
    background-color: #0770c8;
    color: #fff;
    padding: 15px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
    width: 70%;
}
</style>
</head>
<body>
<div class="header">
            <form method="post" style="margin-left: 10px;">
            <button class="logout-button" type="submit" name="logout">تسجيل الخروج</button>
            </form>
            <div class="logo">
            <a href="dashboard_home.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div> 
            </a>
            
</div>
    <div class="container">
        <div class="form-box">
            <h1>Customer help</h1>
            <div class="data">
            <a href="dashboard_help.php">Back</a>
                <?php
                if (isset($_GET['code'])) {
                    
                    $code = $_GET['code'];

                    $sql = "SELECT name, email,  message, random_code, id,created_at, role FROM help_requests WHERE random_code = '$code'";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        echo "<p><strong>Name:</strong> {$row['name']}</p>";
                        echo "<p><strong>Created At:</strong> {$row['created_at']}</p>";
                        echo "<p><strong>Email:</strong> {$row['email']}</p>";
                        echo "<p><strong>message:</strong> {$row['message']}</p>";
                        echo "<p><strong>Code:</strong> {$row['random_code']}</p>";
                        echo "<p><strong>Role:</strong> {$row['role']}</p>";

                       
                       
                    } else {
                        echo "لم يتم العثور على بيانات العميل";
                    }
                    $conn->close();
                } else {
                    echo "الرمز العشوائي غير محدد";
                }
                ?>
                
            </div>
        </div>
    </div>

<script>
    function editCustomer() {
        document.getElementById('editFields').style.display = 'block';
    }
</script>

</body>

</html>