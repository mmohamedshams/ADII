<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $conn = new mysqli("localhost", "root", "", "school_db");
    if ($conn->connect_error) {
        die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
    }

    $sql = "DELETE FROM money_teachers WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_salary_detalis.php");
    } else {
        echo "خطأ في الحذف: " . $conn->error;
    }

    $conn->close();
}
?>