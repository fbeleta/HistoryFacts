<?php
$servername = "localhost";
$username = "root"; // promijeni ako koristiš drugačije korisničko ime
$password = ""; // promijeni ako koristiš drugačiju lozinku
$dbname = "korisnici";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera konekcije
if ($conn->connect_error) {
    die("Konekcija nije uspjela: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

//    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

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

$conn->close();
?>
