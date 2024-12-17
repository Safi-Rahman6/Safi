<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['file'])) {
        $uploadDir = 'uploads/';
        $file = $_FILES['file'];

        if ($file['size'] > 5 * 1024 * 1024) { // 5MB limit
            echo "File exceeds the maximum allowed size.";
            exit;
        }

        $fileName = basename($file['name']);
        $targetPath = $uploadDir . $fileName;

        // Ensure uploads directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move file to uploads directory
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $fileUrl = "http://yourdomain.com/" . $targetPath; // Change to your domain
            echo $fileUrl;
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "No file uploaded.";
    }
}
?>
