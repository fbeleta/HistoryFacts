<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit News</title>
    <link rel="stylesheet" href="style.css">
    <script>
function validateForm() {
    var title = document.getElementById("title").value.trim();
    var summary = document.getElementById("summary").value.trim();
    var content = document.getElementById("content").value.trim();
    var image = document.getElementById("image").value.trim();  // For file inputs, you may need additional validation

    var isValid = true;

    // Reset any previous error styles and messages
    document.getElementById("title").style.border = "";
    document.getElementById("titleError").innerHTML = "";
    document.getElementById("summary").style.border = "";
    document.getElementById("summaryError").innerHTML = "";
    document.getElementById("content").style.border = "";
    document.getElementById("contentError").innerHTML = "";
    document.getElementById("image").style.border = "";
    document.getElementById("imageError").innerHTML = "";

    // Check each field and apply error style and message if empty
    if (title === "") {
        document.getElementById("title").style.border = "1px solid red";
        document.getElementById("titleError").innerHTML = "Please enter a title.";
        document.getElementById("titleError").style.fontSize = "12px";
        document.getElementById("titleError").style.color = "red";
        isValid = false;
    }
    if (summary === "") {
        document.getElementById("summary").style.border = "1px solid red";
        document.getElementById("summaryError").innerHTML = "Please enter a summary.";
        document.getElementById("summaryError").style.fontSize = "12px";
        document.getElementById("summaryError").style.color = "red";
        isValid = false;
    }
    if (content === "") {
        document.getElementById("content").style.border = "1px solid red";
        document.getElementById("contentError").innerHTML = "Please enter the content.";
        document.getElementById("contentError").style.fontSize = "12px";
        document.getElementById("contentError").style.color = "red";
        isValid = false;
    }
    if (image === "") {
        document.getElementById("image").style.border = "1px solid red";
        document.getElementById("imageError").innerHTML = "Please select an image.";
        document.getElementById("imageError").style.fontSize = "12px";
        document.getElementById("imageError").style.color = "red";
        isValid = false;
    }

    return isValid;
}

document.getElementById("gumb").onclick = function (event) {
var slanje_forme=true;
slanje_forme=validateForm();
if (slanje_forme!=true) event.preventDefault();
}
</script>

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
                <li><a href="kategorija.php">Kategorija</a></li>
                <li><a href="#">Les JT</a></li>
                <li><a href="administracija.php">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Submit News</h2>
        <form name="newsForm" action="skripta.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" >
            <span id="titleError" class="error"></span><br><br>

            <label for="summary">Summary:</label>
            <textarea id="summary" name="summary" rows="4" shown=true ></textarea>
            <span id="summaryError" class="error"></span><br><br>

            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="10" ></textarea>
    <span id="contentError" class="error-message"></span><br><br>

            <label for="category">Category:</label>
            <select id="category" name="category" >
                <option value="Svijet">Svijet</option>
                <option value="Europa">Europa</option>
                <option value="Azija">Azija</option>
                <option value="Južna Amerika">Južna Amerika</option>
                <option value="Sjeverna Amerika">Sjeverna Amerika</option>
            </select><br><br>
    <span id="categoryError" class="error-message"></span><br>

            <label for="image">Upload Image:</label>
            <input type="file" id="image" name="image" accept="image/*" >
    <span id="imageError" class="error"></span><br>

            <label for="archive">Archive this news:</label>
            <input type="checkbox" id="archive" name="archive"><br>

            <button type="submit" >Submit</button>
        </form>
    </main>
    <footer>
        <p>Author: Filip Beleta</p>
        <p>Contact: filip.beleta@gmail.com</p>
        <p>&copy; 2024</p>
    </footer>
</body>
</html>
