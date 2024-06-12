<?php
session_start();
include 'config.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $display = isset($_POST['display']) ? 1 : 0;

    // if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    //     // Handle file upload
    //     $upload_dir = 'uploads/';
    //     $uploaded_file = $upload_dir . basename($_FILES['image']['name']);
    //     if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
    //         $image_path = $uploaded_file;
    //     } else {
    //         echo "Failed to move uploaded file.";
    //     }
    // } else {
    //     echo "Error uploading file: " . $_FILES['image']['error'];
    // }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
        $uploadDir = 'htdocs/ZavrsniProjektPWA/uploads/'; // Directory to save the uploaded images

        $imageName = $_FILES["image"]["name"]; // Original image name
        $imageTmpName = $_FILES["image"]["tmp_name"]; // Temporary file path of the uploaded image

        $targetPath = $upload_dir . basename($_FILES['image']['name']); // Path where the image will be saved

        $target = $targetPath . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        // Move the uploaded image to the target path
        if (move_uploaded_file($imageTmpName, $targetPath)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded.";
    }

    
    // Handle file upload
    // $image_path = null;
    // if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    //     $upload_dir = 'uploads/';
    //     $uploaded_file = $upload_dir . basename($_FILES['image']['name']);
    //     if (move_uploaded_file($_FILES['image']['tmp_name'], $uploaded_file)) {
    //         $image_path = $uploaded_file;
    //     }
    // }

    // Insert data into the database

    $stmt = $conn->prepare("INSERT INTO news (title, summary, content, category, image, display) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $summary, $content, $category, $imageName, $display);
    $stmt->execute();
    $stmt->close();

    // Redirect to the homepage
    header('Location: index.php');
    exit;
}


?>
