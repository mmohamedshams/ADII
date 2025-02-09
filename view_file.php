<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

require_once('db_connect.php');


if (isset($_GET['id'])) {
    $file_id = $_GET['id'];

    
    $file_sql = "SELECT * FROM money_files WHERE id = $file_id";
    $file_result = $conn->query($file_sql);

    if ($file_result->num_rows == 1) {
        $file_row = $file_result->fetch_assoc();
        $file_path = 'money_file/' . $file_row['file_name'];

       
        header('Content-Type: application/pdf'); 
        header('Content-Disposition: inline; filename="' . $file_row['text_value'] . '"');
        header('Content-Length: ' . filesize($file_path));
        readfile($file_path);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
