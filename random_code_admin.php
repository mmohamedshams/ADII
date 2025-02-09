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
    padding: 5px 30px;
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
    text-align: center; 
}     
#editFields {
    display: none;
}
#editFields input,
#editFields select {
    width: 50%; 
    padding: 10px;
    margin: 10px auto; 
    display: block; 
    border: 1px solid #ccc;
    border-radius: 5px;
}
#editFields button {
    background-color: #0770c8;
    color: #fff;
    padding: 5px 30px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
    width: 40%; 
    margin: 10px auto;
}
</style>
</head>
<body>
<div class="header">
            <form method="post" style="margin-left: 10px;">
            <button class="logout-button" type="submit" name="logout">تسجيل الخروج</button>
            </form>
            <div class="logo">
            <a href="admin_home.php"><h1>معهد أبوظبى الدولى</h1></a>
            </div>
            
           
            </a>
</div>
    <div class="container">
        <div class="form-box">
            <h1>Customer Data</h1>
            <a href="admin_dashboard.php">Back</a>
            <div class="data">
                <?php
                if (isset($_GET['code'])) {
                    
                    $code = $_GET['code'];

                    $sql = "SELECT full_name, email, family_name, phone, random_code, id, role,created_at,updated_at FROM users WHERE random_code = '$code'";
                    $result = $conn->query($sql);

                    if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                        echo "<p><strong>Name:</strong> {$row['full_name']}</p>";
                        echo "<p><strong>Family Name:</strong> {$row['family_name']}</p>";
                        echo "<p><strong>Email:</strong> {$row['email']}</p>";
                        echo "<p><strong>Phone:</strong> {$row['phone']}</p>";
                        echo "<p><strong>Code:</strong> {$row['random_code']}</p>";
                        echo "<p><strong>Role:</strong> {$row['role']}</p>";
                        if ($row['role'] == 'student') {
                            echo "<p><strong>Level:</strong> {$row['level']}</p>";
                        }
                        echo "<p><strong>Created At:</strong> {$row['created_at']}</p>";
                        echo "<p><strong>Updated At:</strong> {$row['updated_at']}</p>";

                       
                        echo "<div class='button-container'>
                                <button onclick='editCustomer()'>Edit</button>
                              </div>";

                        
                        echo "<div id='editFields'>
                                <form method='POST' action='update_admin.php'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <p><label for='new_role'>Select New Role:</label>
                                    <select name='new_role' id='new_role'required>
                                        
                                        <option value='student'>Student</option>
                                        <option value='Teacher'>Teacher</option>
                                        <option value='administrator'>administrator</option>
                                        <option value='accountant'>Accountant</option>
                                        <option value='it'>IT</option>
                                    </select></p>
                                    <p><input type='text' name='new_name' placeholder='Fall Name' value='{$row['full_name']}' required></p>
                        <p><input type='text' name='new_username' placeholder='Family Name' value='{$row['family_name']}' required></p>
                        <p><input type='text' name='new_email' placeholder='New Email' value='{$row['email']}' required></p>
                        <p><input type='text' name='new_phone' placeholder='New Phone' value='{$row['phone']}'></p>
                                    <p><button type='submit'>Update</button></p>
                                </form>
                              </div>";
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