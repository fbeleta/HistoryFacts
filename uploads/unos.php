<?php
include 'connect.php'; // Include the database connection

// Initialize variables
$naslov = $sazetak = $tekst = $kategorija = "";
$naslovErr = $sazetakErr = $tekstErr = $kategorijaErr = "";
$successMessage = $errorMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naslov = $_POST['naslov'];
    $sazetak = $_POST['sazetak'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    // Validate input
    $isValid = true;

    if (empty($naslov)) {
        $naslovErr = "Title is required";
        $isValid = false;
    }
    if (empty($sazetak)) {
        $sazetakErr = "Summary is required";
        $isValid = false;
    }
    if (empty($tekst)) {
        $tekstErr = "Content is required";
        $isValid = false;
    }
    if (empty($kategorija)) {
        $kategorijaErr = "Category is required";
        $isValid = false;
    }

    // Insert data into the database
    if ($isValid) {
        $query = "INSERT INTO Vijesti (naslov, sazetak, tekst, kategorija, arhiva) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt, "ssssi", $naslov, $sazetak, $tekst, $kategorija, $arhiva);
        if (mysqli_stmt_execute($stmt)) {
            $successMessage = "Article successfully added!";
        } else {
            $errorMessage = "Error: " . mysqli_error($dbc);
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News Article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="unos.php">Add News</a></li>
                <li><a href="administrator.php">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Add News Article</h1>

        <?php if ($successMessage): ?>
            <p class="success"><?php echo $successMessage; ?></p>
        <?php endif; ?>

        <?php if ($errorMessage): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>

        <form action="unos.php" method="post">
            <label for="naslov">Title:</label>
            <input type="text" id="naslov" name="naslov" value="<?php echo htmlspecialchars($naslov); ?>">
            <span class="error"><?php echo $naslovErr; ?></span>
            <br>

            <label for="sazetak">Summary:</label>
            <textarea id="sazetak" name="sazetak"><?php echo htmlspecialchars($sazetak); ?></textarea>
            <span class="error"><?php echo $sazetakErr; ?></span>
            <br>

            <label for="tekst">Content:</label>
            <textarea id="tekst" name="tekst"><?php echo htmlspecialchars($tekst); ?></textarea>
            <span class="error"><?php echo $tekstErr; ?></span>
            <br>

            <label for="kategorija">Category:</label>
            <input type="text" id="kategorija" name="kategorija" value="<?php echo htmlspecialchars($kategorija); ?>">
            <span class="error"><?php echo $kategorijaErr; ?></span>
            <br>

            <label for="arhiva">Archive:</label>
            <input type="checkbox" id="arhiva" name="arhiva" <?php echo isset($_POST['arhiva']) ? 'checked' : ''; ?>>
            <br>

            <input type="submit" value="Submit">
        </form>
    </main>

    <footer>
        <p>&copy; 2023 News Website. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
mysqli_close($dbc); // Close the database connection
?>
