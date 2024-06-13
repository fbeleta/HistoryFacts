<?php
session_start();
include 'config.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;

    $imageName = null;
    $uploadDir = 'uploads/'; // Directory to save the uploaded images

    // Ensure the upload directory exists and is writable
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die("Failed to create upload directory.");
        }
    }

    if (!is_writable($uploadDir)) {
        die("Upload directory is not writable.");
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageTmpName = $_FILES['image']['tmp_name']; // Temporary file path of the uploaded image
        $imageName = basename($_FILES['image']['name']); // Original image name

        $targetPath = $uploadDir . $imageName; // Path where the image will be saved

        if (move_uploaded_file($imageTmpName, $targetPath)) {
            echo "Image uploaded successfully to $targetPath.";
        } else {
            die("Failed to move uploaded file.");
        }
    } else {
        die("No image uploaded or an error occurred: " . $_FILES['image']['error']);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO news (title, summary, content, category, image, archive) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $summary, $content, $category, $imageName, $archive);

    if ($stmt->execute()) {
        $stmt->close();
        // Redirect to the homepage
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
    }
}
?>
