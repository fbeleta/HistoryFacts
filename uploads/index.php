<?php
include 'connect.php';

$query = "SELECT * FROM Vijesti WHERE arhiva=0 ORDER BY datum DESC";
$result = mysqli_query($dbc, $query) or die('Error querying database.');

echo "<h1>Latest News</h1>";
while ($row = mysqli_fetch_array($result)) {
    echo "<h2>" . $row['naslov'] . "</h2>";
    echo "<p>" . $row['sazetak'] . "</p>";
    echo "<a href='clanak.php?id=" . $row['id'] . "'>Read more</a>";
}
mysqli_close($dbc);
?>
