<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $conn = new mysqli("localhost", "root", "", "school_db");
    if ($conn->connect_error) {
        die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
    }

    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "خطأ في الحذف: " . $conn->error;
    }

    $conn->close();
}
?>
