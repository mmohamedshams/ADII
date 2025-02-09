<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "root", "school_db");
    if ($conn->connect_error) {
        die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
    }

    $family_name = $_POST['family_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);
    $role = $_POST['role'];
    $level = $_POST['level'];

    if ($result->num_rows > 0) {
        echo "<script>alert('عذرًا، هذا البريد الإلكتروني مستخدم بالفعل.');</script>";
    } else {

        $random_code = mt_rand(10000000, 99999999);

       
        $image_path = "uploads/person-15.png"; 
        if ($_FILES['profile_picture']['name'] != '') {
            $image_name = $_FILES['profile_picture']['name'];
            $image_tmp = $_FILES['profile_picture']['tmp_name'];
            $image_path = "uploads/" . $image_name;
            move_uploaded_file($image_tmp, $image_path);
        }

        $sql = "INSERT INTO users (family_name, email, phone, full_name, password, role, random_code, image_path ,level) 
                VALUES ('$family_name', '$email', '$phone', '$full_name', '$password', '$role', '$random_code', '$image_path' ,'$level')";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
        } else {
            echo "خطأ في الإضافة: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create a new account</title>
<link rel="icon" href="image/logo_dashboard.jpg">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@700&family=Raleway&display=swap" rel="stylesheet">
<style>
*{
    font-family: 'Noto Kufi Arabic', sans-serif;
}
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    width: 40%;
    padding: 20px;
    background-color: #fff;
    text-align: center;
}
.container h2 {
    text-align: center;
    color: #1492FD;
}
.form-group {
    margin-bottom: 15px;
    text-align: center;
}
input[type="text"],
input[type="password"],
input[type="file"],
select {
    width: 80%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}
button {
    background-color: #0077cc;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
}
button:hover {
    background-color: #0055aa;
}
a {
    background-color: #0077cc;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 5px 20px;
    cursor: pointer;
    text-decoration: none;
}
a:hover {
    background-color: #0055aa;
    text-decoration: none;
}
</style>
</head>
<body>
<div class="container">
    <h2>Create a new account</h2>
    <form method="post" action="add_account.php" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="full_name" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="family_name" placeholder="Family Name" required>
        </div>
        <div class="form-group">
            <input type="text" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="text" name="phone" placeholder="Phone Number" >
        </div>
        <div class="form-group">
            <input type="file" name="profile_picture" accept="image/*" >
        </div>
        <div class="form-group">
            <select name="role" required>
                <option value="" disabled selected>Roles</option>
                <option value="student">student</option>
                <option value="Teacher">Teacher</option>
                <option value="it">it</option>              
                <option value="administrator">Administrator</option>
                <option value="accountant">accountant</option>
            </select>
        </div>
        <div class="form-group">
            <select name="level">
                <option value="" disabled selected>level</option>
                <option value="Beginner">Beginner</option>
                <option value="middle">middle</option>
                <option value="advanced">advanced</option>              
            </select>
        </div>
        <button type="submit">registration</button>
        <a href="dashboard.php">Back</a>
    </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    
    var roleSelect = document.querySelector('select[name="role"]');
   
    var levelSelect = document.querySelector('select[name="level"]');
    
   
    levelSelect.style.display = 'none';

  
    roleSelect.addEventListener('change', function() {
      
        levelSelect.style.display = this.value === 'student' ? 'block' : 'none';
    });
});
</script>

</body>
</html>