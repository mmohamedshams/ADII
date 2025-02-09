<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('db_connect.php');
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_code = $_POST['random_code'];
    $full_name = $_POST['full_name'];
    $month = $_POST['month'];
    $basic_salary = $_POST['basic_salary'];
    $additions = $_POST['additions'];
    $deductions = $_POST['deductions'];

    $totalSalary = ($basic_salary + $additions - $deductions)*0;



   
    $insert_sql = "INSERT INTO money_teachers (code, full_name, month, basic_salary, additions, deductions, totalSalary)
                   VALUES ('$selected_code', '$full_name', '$month', '$basic_salary', '$additions', '$deductions', '$totalSalary')";

    if ($conn->query($insert_sql) === TRUE) {
        header("Location: admin_salary_detalis.php");
    } else {
        echo "حدثت مشكلة أثناء إضافة البيانات: " . $conn->error;
    }
}
?>