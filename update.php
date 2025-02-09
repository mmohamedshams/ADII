<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('db_connect.php'); 

    $id = $_POST['id'];
    $newRole = $_POST['new_role'];
    $newName = $_POST['new_name'];
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPhone = $_POST['new_phone'];

    
    $checkEmailQuery = "SELECT id FROM users WHERE email='$newEmail' AND id != '$id'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
      
        echo "<script>alert('عذرًا، هذا البريد الإلكتروني مستخدم بالفعل.');</script>";
        echo "<script>history.back();</script>";
    } else {
     
        $sql = "UPDATE users SET role='$newRole', full_name='$newName', family_name='$newUsername', email='$newEmail', phone='$newPhone' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");
        } else {
            echo "حدث خطأ أثناء تحديث البيانات: " . $conn->error;
        }
    }

    $conn->close(); 
}
?>

