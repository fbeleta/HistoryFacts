<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateLoginForm() {
            var isValid = true;
            var username = document.forms["loginForm"]["username"];
            var password = document.forms["loginForm"]["password"];
            var errorElements = document.getElementsByClassName('error');
            
            while(errorElements[0]) {
                errorElements[0].parentNode.removeChild(errorElements[0]);
            }

            if (username.value == "") {
                isValid = false;
                var error = document.createElement('div');
                error.className = 'error';
                error.innerText = 'Korisničko ime je obavezno.';
                username.classList.add('input-error');
                username.parentNode.insertBefore(error, username.nextSibling);
            } else {
                username.classList.remove('input-error');
            }

            if (password.value == "") {
                isValid = false;
                var error = document.createElement('div');
                error.className = 'error';
                error.innerText = 'Lozinka je obavezna.';
                password.classList.add('input-error');
                password.parentNode.insertBefore(error, password.nextSibling);
            } else {
                password.classList.remove('input-error');
            }

            return isValid;
        }
    </script>
</head>
<body>
    <header>
        <?php 
            include('header.php')
        ?>
    </header>
    <main>
        <form name="loginForm" action="login.php" onsubmit="return validateLoginForm()" method="post">
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username">
            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password">
            <button type="submit">Prijavi se</button>
        </form>
    </main>
    <footer>
       <?php include('footer.php')?>
    </footer>
</body>
</html>
