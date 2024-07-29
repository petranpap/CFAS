<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if a file was selected
    if (!empty($_FILES["zipFile"]["name"])) {
        
        // Define the maximum file size (10MB)
        $maxFileSize = 10 * 1024 * 1024; // in bytes

        // Check if the file size is within the allowed limit
        if ($_FILES["zipFile"]["size"] <= $maxFileSize) {
            
            // Specify the directory where you want to store the uploaded ZIP file
            $uploadDirectory = "uploads/";

            // Create the uploads directory if it doesn't exist
            if (!file_exists($uploadDirectory)) {
                mkdir($uploadDirectory, 0755, true);
            }

            // Generate a unique filename to avoid overwriting existing files
            $fileName = uniqid() . '_' . $_FILES["zipFile"]["name"];

            // Set the complete path to the uploaded file
            $filePath = $uploadDirectory . $fileName;

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["zipFile"]["tmp_name"], $filePath)) {
                echo "File uploaded successfully. File path: " . $filePath;
            } else {
                echo "Error uploading file.";
            }

        } else {
            echo "File size exceeds the allowed limit (10MB).";
        }

    } else {
        echo "Please select a ZIP file to upload.";
    }
}
?>

