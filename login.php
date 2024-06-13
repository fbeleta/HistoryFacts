<?php
session_start();

$servername = "localhost";
$username = "root"; // Promeni prema tvom korisničkom imenu
$password = ""; // Promeni prema tvojoj lozinci
$dbname = "korisnici";

// Kreiranje konekcije
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera konekcije
if ($conn->connect_error) {
    die("Konekcija nije uspjela: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement za sigurnost
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $user, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Lozinka je ispravna, kreiraj sesiju
            $_SESSION['username'] = $user;
            header("Location: index.php"); // Preusmjeri korisnika na početnu stranicu
            exit;
        } else {
            echo "Pogrešna lozinka.";
        }
    } else {
        echo "Korisničko ime ne postoji.";
    }

    $stmt->close();
}

$conn->close();
?>
