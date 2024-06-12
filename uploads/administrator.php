<?php
include 'connect.php'; // Include the database connection

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query = "DELETE FROM Vijesti WHERE id = ?";
    $stmt = mysqli_prepare($dbc, $query);
    mysqli_stmt_bind_param($stmt, "i", $delete_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: administrator.php");
}

// Fetch all articles from the database
$query = "SELECT * FROM Vijesti";
$result = mysqli_query($dbc, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator</title>
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
        <h1>Administrator Page</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Summary</th>
                    <th>Content</th>
                    <th>Category</th>
                    <th>Archived</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['datum']; ?></td>
                    <td><?php echo $row['naslov']; ?></td>
                    <td><?php echo $row['sazetak']; ?></td>
                    <td><?php echo $row['tekst']; ?></td>
                    <td><?php echo $row['kategorija']; ?></td>
                    <td><?php echo $row['arhiva'] ? 'Yes' : 'No'; ?></td>
                    <td>
                        <a href="administrator.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2023 News Website. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
mysqli_close($dbc); // Close the database connection
?>
