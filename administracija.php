
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracija</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="logo.png" alt="Logo"></a>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php">Kategorija</a></li>
                <li><a href="#">Les JT</a></li>
                <li><a href="administracija.php">Administracija</a></li>
                <li><a href="unos.php">Submit News</a></li> 
            </ul>
        </nav>
    </header>
    <main class="articles-section">
        <?php
        include 'config.php';
        $result = $conn->query("SELECT * FROM news WHERE archive = 0 ORDER BY created_at DESC LIMIT 3");

        if ($result->num_rows > 0):
            while ($news_item = $result->fetch_assoc()): ?>
                <form action="update.php" method="POST" class="article">
                    <input type="hidden" name="id" value="<?php echo $news_item['id']; ?>">
                    <label for="title">Title:</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($news_item['title']); ?>"><br>
                    <label for="summary">Summary:</label>
                    <textarea name="summary"><?php echo htmlspecialchars($news_item['summary']); ?></textarea><br>
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete">Delete</button>
                </form>
            <?php endwhile;
        else: ?>
            <p>No news articles found.</p>
        <?php endif; ?>
    </main>
    <footer>
        <p>Author: Filip Beleta</p>
        <p>Contact: filip.beleta@gmail.com</p>
        <p>&copy; 2024</p>
    </footer>
</body>
</html>
