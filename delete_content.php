<?php

require_once('db_connect.php');


if (isset($_GET['content_id']) && filter_var($_GET['content_id'], FILTER_VALIDATE_INT)) {
    $content_id = $_GET['content_id'];

 
    $deleteSql = "DELETE FROM content WHERE id = $content_id";

    if ($conn->query($deleteSql) === TRUE) {
     
        header("Location: admin_exam.php");
        exit;
    } else {
    
        echo "Error deleting record: " . $conn->error;
    }
} else {
  
    echo "Invalid content ID";
}


$conn->close();
?>

