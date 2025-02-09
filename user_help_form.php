<?php
require_once('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];
    $random_code = $_POST['random_code'];
    $role= $_POST['role'];

    
    $sql = "INSERT INTO help_requests (name, email,random_code,role, message) VALUES ('$name', '$email','$random_code','$role', '$message')";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_home.php");
    } else {
        echo "حدث خطأ أثناء إرسال الرسالة: " . $conn->error;
    }
} else {
    header("Location: index.php");
    exit;
}

$conn->close();
?>