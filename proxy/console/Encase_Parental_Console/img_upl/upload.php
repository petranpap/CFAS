<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if files were selected
    if (!empty($_FILES["imageFiles"]["name"][0])) {

        // Specify the directory where you want to store the uploaded images
        $uploadDirectory = "uploads/";

        // Create the uploads directory if it doesn't exist
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0755, true);
        }

        // Loop through each selected file
        foreach ($_FILES["imageFiles"]["name"] as $key => $fileName) {

            // Generate a unique filename to avoid overwriting existing files
            $uniqueFileName = $fileName;

            // Set the complete path to the uploaded file
            $filePath = $uploadDirectory . $uniqueFileName;

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["imageFiles"]["tmp_name"][$key], $filePath)) {
                echo "File uploaded successfully. File path: " . $filePath . "<br>";
            } else {
                echo "Error uploading file: " . $fileName . "<br>";
            }
        }

    } else {
        echo "Please select one or more image files to upload.";
    }
}
?>

