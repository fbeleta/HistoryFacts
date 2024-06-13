<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    if (isset($_POST['update'])) {
        $title = $_POST['title'];
        $summary = $_POST['summary'];

        $stmt = $conn->prepare("UPDATE news SET title=?, summary=? WHERE id=?");
        $stmt->bind_param("ssi", $title, $summary, $id);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM news WHERE id=?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $stmt->close();
            header('Location: index.php');
        } else {
            echo "Error deleting record: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
