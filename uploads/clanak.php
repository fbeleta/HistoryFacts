<?php
include 'connect.php';

$id = $_GET['id'];
$query = "SELECT * FROM Vijesti WHERE id=$id";
$result = mysqli_query($dbc, $query) or die('Error querying database.');

if ($row = mysqli_fetch_array($result)) {
    echo "<h1>" . $row['naslov'] . "</h1>";
    echo "<p>" . $row['tekst'] . "</p>";
    echo "<img src='img/" . $row['slika'] . "' alt='Article Image'>";
} else {
    echo "<p>Article not found.</p>";
}
mysqli_close($dbc);
?>
