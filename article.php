<?php
session_start();
include 'config.php'; // Include the database connection

if (!isset($_GET['id'])) {
    echo "Article not found.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Article not found.";
    exit;
}

$news_item = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news_item['title']); ?></title>
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
                <li><a href="unos.php">Submit News</a></li>
                <li><a href="#">Elections</a></li>
                <li><a href="#">Les JT</a></li>
                <li><a href="#">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <article>
            <h1><?php echo htmlspecialchars($news_item['title']); ?></h1>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($news_item['category']); ?></p>
            <p><strong>Display:</strong> <?php echo htmlspecialchars($news_item['display']); ?></p>
            <?php if ($news_item['image']): ?>
                <img src="<?php echo htmlspecialchars($news_item['image']); ?>" alt="Article Image">
            <?php endif; ?>
            <p><?php echo nl2br(htmlspecialchars($news_item['summary'])); ?></p>
            <p><?php echo nl2br(htmlspecialchars($news_item['content'])); ?></p>
        </article>
    </main>
    <footer>
        <p>Author: Filip Beleta</p>
        <p>Contact: filip.beleta@gmail.com</p>
        <p>&copy; 2024</p>
    </footer>
</body>
</html>
