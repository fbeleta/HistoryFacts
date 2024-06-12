<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit News</title>
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
        <h2>Submit News</h2>
        <form name="newsForm" action="skripta.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="summary">Summary:</label>
            <textarea id="summary" name="summary" rows="4" required></textarea><br><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" required></textarea><br><br>

            <label for="category">Category:</label>
            <select id="category" name="category">
                <option value="Politics">Politics</option>
                <option value="Economy">Economy</option>
                <option value="Culture">Culture</option>
                <option value="Sports">Sports</option>
                <option value="Technology">Technology</option>
            </select><br><br>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*"><br><br>

            <label for="display">Display this news:</label>
            <input type="checkbox" id="display" name="display"><br><br>

            <button type="submit">Submit</button>
        </form>
    </main>
    <footer>
        <p>Author: Filip Beleta</p>
        <p>Contact: filip.beleta@gmail.com</p>
        <p>&copy; 2024</p>
    </footer>
</body>
</html>
