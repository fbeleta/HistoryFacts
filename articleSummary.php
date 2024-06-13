<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<main class="articles-section">
        <h2>Élections Européennes 2019</h2>
        <?php
        include 'config.php'; // Include the database connection
        $result = $conn->query("SELECT * FROM news WHERE archive = 0 ORDER BY created_at DESC LIMIT 3");

        if ($result->num_rows > 0):
            while ($news_item = $result->fetch_assoc()): ?>
                <div class="article">
                    <?php if ($news_item['image']): ?>
                        <a href="article.php?id=<?php echo urlencode($news_item['id']); ?>">
                            <img src="./uploads/<?php echo htmlspecialchars($news_item['image']); ?>" alt="Article Image">
                        </a>
                    <?php endif; ?>
                    <h3>
                        <a href="article.php?id=<?php echo urlencode($news_item['id']); ?>">
                            <?php echo htmlspecialchars($news_item['title']); ?>
                        </a>
                    </h3>
                    <p><?php echo htmlspecialchars($news_item['summary']); ?></p>
                </div>
            <?php endwhile;
        else: ?>
            <p>No news articles found.</p>
        <?php endif; ?>
    </main>