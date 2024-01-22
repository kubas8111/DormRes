<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="register page">
    <meta name="keywords" content="logowanie">
    <meta name="author" content="Jakub Swies">
    <link rel="stylesheet" type="text/css" href="public/css/style_register.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form action="register" method="post">
                <h2>REJESTRACJA</h2>
                <div class="message">
                    <?php if(isset($message)) {
                        echo $message;
                    }
                    ?>
                </div>
                <input name="email" type="email" placeholder="Email" required>
                <input name="password" type="password" placeholder="Hasło" required>
                <input name="name" type="text" placeholder="Imię" required>
                <input name="surname" type="text" placeholder="Nazwisko" required>
                <input name="telephone" type="tel" placeholder="Telefon" required>
                <input name="studentCard" type="number" placeholder="Numer karty studenta" required>
                <button>REGISTER</button>
                
            </form>
            <form>
                <div class="registration">
                    <input type="submit" id="loginPage" formaction="loginPage" value="Masz już konto? Zaloguj się">
                </div>
            </form>
        </div>
    </div>
</body>