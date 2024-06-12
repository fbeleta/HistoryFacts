<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
                <li><a href="#">Elections</a></li>
                <li><a href="#">Les JT</a></li>
                <li><a href="#">Administracija</a></li>
                <li><a href="unos.php">Submit News</a></li> 

            </ul>
        </nav>
    </header>
    <main class="articles-section">
        <h2>Élections Européennes 2019</h2>
        <?php
        include 'config.php'; // Include the database connection
        $result = $conn->query("SELECT * FROM news WHERE display = 1 ORDER BY created_at DESC LIMIT 3");

        if ($result->num_rows > 2):
            while ($news_item = $result->fetch_assoc()): ?>
                <div class="article">
                    <?php if ($news_item['image']): ?>
                        <img size='50%' src="<?php echo htmlspecialchars($news_item['image']); ?>" alt="Article Image">
                    <?php endif; ?>
                    <h3><?php echo htmlspecialchars($news_item['title']); ?></h3>
                    <p><?php echo htmlspecialchars($news_item['summary']); ?></p>
                </div>
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
