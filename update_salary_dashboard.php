<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('db_connect.php');
$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if (isset($_POST['record_id']) && isset($_POST['month']) && isset($_POST['basic_salary']) && isset($_POST['additions']) && isset($_POST['deductions'])) {
        
     
        $record_id = $_POST['record_id'];
        $month = $_POST['month'];
        $basic_salary = $_POST['basic_salary'];
        $additions = $_POST['additions'];
        $deductions = $_POST['deductions'];

    
        $sql = "UPDATE money_teachers SET
                month = '$month',
                basic_salary = '$basic_salary',
                additions = '$additions',
                deductions = '$deductions'
                WHERE id = $record_id";

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard_salary_detalis.php");
        } else {
            echo "حدث خطأ أثناء التحديث: " . $conn->error;
        }
    } else {
        echo "يرجى توفير جميع الحقول المطلوبة.";
    }

    $conn->close();
} else {
    echo "Invalid Request!";
}
?>
