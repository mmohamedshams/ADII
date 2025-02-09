<?php

require_once('db_connect.php');

if (isset($_POST['submit'])) {
   
    $textValue = $_POST['text_field'];
    $random_code = $_POST['random_code'];
   
    if (isset($_FILES['file_field'])) {
        $file = $_FILES['file_field'];
        
        if ($file['error'] === 0) {
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $fileType = $file['type'];
            
            
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
            
            if (in_array($fileType, $allowedTypes)) {
                $selectedCodes = $_POST['random_code'];
                
                $sql = "INSERT INTO money_files (text_value, random_code, file_name, file_data) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);

                $stmt->bind_param("sssb", $textValue, $random_code, $fileName, file_get_contents($fileTmpName));
                
                $stmt->execute();

                $stmt->close();

                $destinationPath = "money_file/" . $fileName;
                if (move_uploaded_file($fileTmpName, $destinationPath)) {
                    header("Location: accountant_moany.php");
                    exit;
                } else {
                    echo "حدث خطأ أثناء حفظ الملف على القرص.";
                }
            } else {
                echo "الملف غير مدعوم. يرجى تحميل ملف من نوع PDF أو Word.";
            }
        } else {
            echo "حدث خطأ أثناء رفع الملف.";
        }
    } else {
        echo "الملف غير موجود.";
    }
} else {
    echo "لم يتم إرسال النموذج بشكل صحيح.";
}
?>
