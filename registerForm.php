<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var isValid = true;
            var username = document.forms["registrationForm"]["username"];
            var email = document.forms["registrationForm"]["email"];
            var password = document.forms["registrationForm"]["password"];
            var confirmPassword = document.forms["registrationForm"]["confirmPassword"];
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

            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value == "" || !emailPattern.test(email.value)) {
                isValid = false;
                var error = document.createElement('div');
                error.className = 'error';
                error.innerText = 'Unesite ispravnu email adresu.';
                email.classList.add('input-error');
                email.parentNode.insertBefore(error, email.nextSibling);
            } else {
                email.classList.remove('input-error');
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

            if (confirmPassword.value == "" || password.value != confirmPassword.value) {
                isValid = false;
                var error = document.createElement('div');
                error.className = 'error';
                error.innerText = 'Lozinke se ne podudaraju.';
                confirmPassword.classList.add('input-error');
                confirmPassword.parentNode.insertBefore(error, confirmPassword.nextSibling);
            } else {
                confirmPassword.classList.remove('input-error');
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
        <form name="registrationForm" action="register.php" onsubmit="return validateForm()" method="post">
            <label for="username">Korisničko ime:</label>
            <input type="text" id="username" name="username">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email">
            <label for="password">Lozinka:</label>
            <input type="password" id="password" name="password">
            <label for="confirmPassword">Potvrdi lozinku:</label>
            <input type="password" id="confirmPassword" name="confirmPassword"><br><br>
            <button type="submit">Registriraj se</button>
        </form>
    </main>
    <footer>
    <?php 
            include('footer.php')
        ?>
    </footer>
</body>
</html>
