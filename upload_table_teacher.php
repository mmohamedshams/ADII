<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('db_connect.php');
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['type'])) {
        $type = $_POST['type'];

        if ($type === 'teacher' || $type === 'student') {
            $code = $_POST['code'];
            $username = $_POST["username"];

            $check_sql = "SELECT * FROM " . $type . "_files WHERE code = '$code' LIMIT 1";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                echo "<script>alert('بالفعل تم اضافه جدول لهذا الطالب');</script>";
                
               
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'admin_teacher_detalis.php'; 
                        }, 100); 
                      </script>";
            } else {
                if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
                    $file_name = $_FILES['file']['name'];
                    $file_tmp = $_FILES['file']['tmp_name'];

                    $upload_folder = ($type === 'teacher') ? 'uploads/teachers/' : 'uploads/students/';
                    $upload_path = $upload_folder . $file_name;

                    if (move_uploaded_file($file_tmp, $upload_path)) {
                        $sql = "INSERT INTO " . $type . "_files (user_id, file_path, code,username) VALUES ('$user_id', '$upload_path', '$code','$username')";
                        if ($conn->query($sql)) {
                            header("Location: admin_teacher_detalis.php");
                        } else {
                            echo "Error inserting into the database: " . $conn->error;
                        }
                    } else {
                        echo "Error moving file to destination folder.";
                    }
                } else {
                    echo "No file uploaded or an error occurred.";
                }
            }
            
        } else {
            echo "Invalid user type.";
        }
    } else {
        echo "Missing user type.";
    }
} else {
    echo "Invalid request method.";
}
?>
